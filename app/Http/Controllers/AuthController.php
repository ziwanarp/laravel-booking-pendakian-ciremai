<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'username' => 'required|unique:users|min:5',
            'email' => 'required|unique:users',
            'alamat' => 'required|min:5',
            'role' => 'required',
            'jenis_kelamin' => 'required',
            'jenis_identitas' => 'required',
            'no_identitas' => 'required|min:10',
            'no_hp' => 'required|min:10',
            'foto_identitas' => 'required|file|image|max:1024',
            'password' => 'required|min:5',
        ];

        $validatedData = $request->validate($rules);

        //simpan foto di storage
        $validatedData['foto_identitas'] = $request->file('foto_identitas')->store('user-fotoidentitas', 'public');

        //encrypt password
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
