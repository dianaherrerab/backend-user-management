<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


/**
 * @OA\Info(
 *      title="API de Gestión de Usuarios",
 *      version="1.0.0",
 *      description="Documentación de la API para la gestión de usuarios con autenticación JWT.",
 * )
 *
 * @OA\Server(
 *      url="http://127.0.0.1:8000/api",
 *      description="Servidor de Desarrollo"
 * )
 */
class AuthController extends Controller
{
    /**
     * Registro de usuario
     *
     * @OA\Post(
     *     path="/register",
     *     summary="Registrar un nuevo usuario",
     *     tags={"Autenticación"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","phone","password"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *             @OA\Property(property="phone", type="string", example="1234567890"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Usuario registrado exitosamente"),
     *     @OA\Response(response=400, description="Error en la solicitud")
     * )
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    /**
     * Inicio de sesión
     *
     * @OA\Post(
     *     path="/login",
     *     summary="Autenticar usuario",
     *     tags={"Autenticación"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Token de acceso"),
     *     @OA\Response(response=401, description="Credenciales inválidas")
     * )
     */

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }

    /**
     * Cerrar sesión
     *
     * @OA\Post(
     *     path="/logout",
     *     summary="Cerrar sesión",
     *     security={{"bearerAuth":{}}},
     *     tags={"Autenticación"},
     *     @OA\Response(response=200, description="Cierre de sesión exitoso")
     * )
     */

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully']);
    }

     /**
     * Obtener perfil del usuario autenticado
     *
     * @OA\Get(
     *     path="/profile",
     *     summary="Obtener perfil del usuario autenticado",
     *     security={{"bearerAuth":{}}},
     *     tags={"Autenticación"},
     *     @OA\Response(response=200, description="Perfil del usuario")
     * )
     */
    public function profile()
    {
        return response()->json(Auth::user());
    }
}
