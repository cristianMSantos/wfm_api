<?php
/**
 * Controller responsavel pela autenticação.
 *
 *
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use function PHPUnit\Framework\isEmpty;

class AuthController extends Controller
{


    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'reset']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
         /**
         * Encripta a senha no padrão MD5.
         * Compara com a senha encriptada no banco de dados
         * Compara as senhas
         * Gera o token
         *
         *
         */

        $senha =  md5($request->input('loginPassword'));

        if (is_null($request->input('loginPassword')) || is_null($request->input('loginMatricula'))) {
            return response()->json(['error' => 'Senha ou Login nao informados'], 404);
        }

        if (!$token = Auth::attempt(['matricula' => $request->input('loginMatricula'),'password' => $senha, 'ic_ativo' => 1])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // Verifica quando o usuário for incluir senha padrão para resetar a senha:
        if ($token = Auth::attempt(['matricula' => $request->input('loginMatricula'),'password' => $senha, 'ic_ativo' => 1])) {
            if ($request->input('loginPassword') == 'plansul123') {
                return response()->json(['error' => 'Reset Password'], 403);
            }
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = auth('api')->user()->getUser();
        return response()->json($user);
    }

    /**
     * Update User Login Password.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $senha =  md5($request->input('loginPassword'));
        $matricula = $request->input('loginMatricula');

        $user = new User();
        return $user->resetPassword($matricula, $senha);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
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
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }


}
