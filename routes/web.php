<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('setup', function () {
    $data = [
        'email' => 'admin@gmail.com',
        'password' => 'password',
    ];

    if (!Auth::attempt($data)) {
        $user = new User();
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->name = "admin user";

        $user->save();

        if (Auth::attempt($data)) {
            $user = Auth::user();
            $adminToken = $user->createToken('adminToken', ['create', 'update', 'delete']);
            $updateToken = $user->createToken('updateToken', ['create', 'update']);
            $basicToken = $user->createToken('basicToken');

            return [
                'admin' => $adminToken->plainTextToken,
                'update' => $updateToken->plainTextToken,
                'basic' => $basicToken->plainTextToken,
            ];
        }
    }
});
