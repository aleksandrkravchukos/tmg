<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Mockery\Exception;

class UserService
{
    private function validateUpdateRequest(Request $request): void
    {
        $request->validate(
            [
                'id' => 'required|exists:users,id',
                'user_name' => 'required|string',
                'user_email' => ['required', 'email', Rule::unique('email')->ignore($request->id)],
                'user_phone' => 'nullable|string',
                'user_password' => 'required|string|min:8',
            ]
        );
    }

    public function updateUserData(Request $request, User $user): bool
    {
        try {
            $this->validateUpdateRequest($request);
        } catch (Exception $e) {
            return $e->validator->errors()->all();
        }
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->phone = $request->user_phone;
        $user->password = Hash::make($request->user_password);
        $user->save();

        return true;
    }

    public function getUserById($id)
    {
        return User::find($id);
    }
}
