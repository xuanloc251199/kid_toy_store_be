<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = User::with('role')->get(); // Tải thông tin vai trò
        return response()->json($users);
    }

    // Hiển thị thông tin
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    // Cập nhật người dùng
    public function update(Request $request)
    {
        $user = $request->user(); // Lấy thông tin người dùng hiện tại

        // Xác thực dữ liệu
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8',
            'role_id' => 'nullable|exists:roles,id',
            'number_phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'avatar' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Cập nhật thông tin người dùng
        $user->update($request->only('name', 'email', 'role_id', 'number_phone', 'address', 'avatar'));
    
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }
    
        return response()->json($user, 200);
    }


    // Xóa người dùng
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
