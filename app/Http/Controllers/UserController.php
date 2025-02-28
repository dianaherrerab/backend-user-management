<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


/**
 * @OA\Tag(name="Usuarios", description="Endpoints para gestionar usuarios")
 */
class UserController extends Controller
{
    /**
     * Obtener todos los usuarios con paginación y filtros avanzados.
     *
     * @OA\Get(
     *     path="/users",
     *     summary="Listar usuarios",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Buscar por nombre o email",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="Lista de usuarios"),
     *     @OA\Response(response=401, description="No autorizado")
     * )
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereRaw("MATCH(name, email) AGAINST(? IN BOOLEAN MODE)", [$search]);
        }

        if ($request->has('created_at')) {
            $query->whereDate('created_at', $request->input('created_at'));
        }

        return response()->json($query->paginate(10));
    }

    /**
     * Registrar un nuevo usuario.
     *
     * @OA\Post(
     *     path="/users",
     *     summary="Crear usuario",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","phone","password"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Usuario creado exitosamente")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        Activity::create([
            'user_id' => auth()->id(),
            'action' => "Creó el usuario {$user->name}",
        ]);

        return response()->json($user, 201);
    }

    /**
     * Mostrar un usuario específico.
     *
     * @OA\Get(
     *     path="/users/{id}",
     *     summary="Obtener usuario por ID",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Datos del usuario"),
     *     @OA\Response(response=404, description="Usuario no encontrado")
     * )
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($user);
    }

    /**
     * Actualizar datos de un usuario.
     *
     * @OA\Put(
     *     path="/users/{id}",
     *     summary="Actualizar usuario",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="phone", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Usuario actualizado"),
     *     @OA\Response(response=404, description="Usuario no encontrado")
     * )
     */

     public function update(Request $request, $id)
     {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->update($request->only(['name', 'phone']));

        Activity::create([
            'user_id' => auth()->id(),
            'action' => "Actualizó el usuario {$user->name}",
        ]);

        return response()->json($user);
     }


     /**
     * Eliminar un usuario.
     *
     * @OA\Delete(
     *     path="/users/{id}",
     *     summary="Eliminar usuario",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Usuario eliminado"),
     *     @OA\Response(response=404, description="Usuario no encontrado")
     * )
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        Activity::create([
            'user_id' => auth()->id(),
            'action' => "Eliminó el usuario {$user->name}",
        ]);

        return response()->json(['message' => 'Usuario eliminado']);
    }


     /**
     * @OA\Get(
     *     path="/statistics",
     *     summary="Obtener estadísticas de usuarios",
     *     description="Devuelve estadísticas de usuarios, incluyendo registros en los últimos 30 días, número de acciones por usuario y los usuarios más activos.",
     *     tags={"Estadísticas"},
     *     security={{ "bearerAuth":{} }},
     *     @OA\Response(
     *         response=200,
     *         description="Datos de estadísticas obtenidos correctamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="usersLast30Days", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="date", type="string", format="date"),
     *                 @OA\Property(property="count", type="integer")
     *             )),
     *             @OA\Property(property="actionsPerUser", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="actions", type="integer")
     *             )),
     *             @OA\Property(property="mostActiveUsers", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="activity_count", type="integer")
     *             ))
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autorizado. Se requiere un token válido."
     *     )
     * )
     */
    public function statistics()
    {
        // 1. Cantidad de usuarios registrados en los últimos 30 días
        $usersLast30Days = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->where('created_at', '>=', Carbon::now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

        // 2. Número de acciones realizadas por usuario
        $actionsPerUser = Activity::select('users.name', DB::raw('COUNT(activities.id) as actions'))
        ->join('users', 'activities.user_id', '=', 'users.id')
        ->groupBy('users.name')
        ->orderByDesc('actions')
        ->get();

        // 3. Usuarios más activos en la plataforma
        $mostActiveUsers = Activity::select('users.name', DB::raw('COUNT(activities.id) as activity_count'))
        ->join('users', 'activities.user_id', '=', 'users.id')
        ->groupBy('users.name')
        ->orderByDesc('activity_count')
        ->limit(5)
        ->get();

        return response()->json([
            'usersLast30Days' => $usersLast30Days,
            'actionsPerUser' => $actionsPerUser,
            'mostActiveUsers' => $mostActiveUsers,
        ]);
    }

}
