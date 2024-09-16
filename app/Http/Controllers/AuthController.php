<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	public function login(Request $request)
	{
		// Validasi
		$request->validate([
			'email' => 'required|email',
			'password' => 'required',
		]);

		// Cek email ada atau tidak
		$user = User::where('email', $request->email)->first();

		// Validasi email & password
		if (! $user || ! Hash::check($request->password, $user->password)) {
			throw ValidationException::withMessages([
				'email' => ['The provided credentials are incorrect.'],
			]);
		}

		// dikirimkan token
		return $user->createToken('apikeylogin')->plainTextToken;
	}

	public function logout(Request $request)
	{
		// delete token yang di akses
		$request->user()->currentAccessToken()->delete();
	}

	public function logToken()
	{
		// Menampilkan data user yang login
		return response()->json(Auth()->user());
	}
}
