<?php 

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller {
    private $client;

    public function __construct() {
        $this->client = \Laravel\Passport\Client::where('password_client', 1)->first();
    }

    public function register(Request $request) {

        $v = validator($request->only('email', 'name', 'password'), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($v->fails()) {
            return response()->json($v->errors()->all(), 400);
        }
        $data = request()->only('email','name','password');

        $user = \App\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $request->request->add([
            'grant_type'    => 'password',
            'client_id'     => $this->client->id,
            'client_secret' => $this->client->secret,
            'username'      => $data['email'],
            'password'      => $data['password'],
            'scope'         => null,
        ]);
        
        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        return \Route::dispatch($proxy);
    }

    public function login(Request $request) {
        $request->request->add([
            'grant_type' => 'password',
            'username' => $request->email,
            'password' => $request->password,
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'scope' => ''
        ]);

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        return \Route::dispatch($proxy);
    }
}