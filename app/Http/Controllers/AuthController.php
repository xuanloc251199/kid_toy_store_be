<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // API Đăng ký
    public function register(Request $request)
    {
        // Xác thực yêu cầu
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'number_phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'avatar' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'number_phone' => $request->number_phone,
            'address' => $request->address,
            'avatar' => $request->avatar,
        ]);

        // Tạo token cho người dùng
        $token = $user->createToken('auth_token')->plainTextToken;

        // Trả về token và thông tin người dùng
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 201);
    }

    // API Đăng nhập
    public function login(Request $request)
    {
        // Xác thực yêu cầu
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Kiểm tra email và mật khẩu
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Thông tin đăng nhập không chính xác'
            ], 401);
        }

        // Tạo token nếu thông tin đăng nhập hợp lệ
        $token = $user->createToken('auth_token')->plainTextToken;

        // Trả về token và thông tin người dùng
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }

    // API Đăng xuất
    public function logout(Request $request)
    {
        // Xóa token hiện tại
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Đăng xuất thành công'
        ], 200);
    }
}
