<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Mockery\Exception;

class UserService
{
    /**
     * Validator.
     *
     * @param Request $request
     */
    private function validateUpdateRequest(Request $request): void
    {
        $request->validate(
            [
                'name' => 'required|string',
                'email' => ['required', 'email', Rule::unique('users')->ignore($request->id)],
                'phone' => 'nullable|string',
                'password' => 'required|string|min:8',
            ]
        );
    }

    /**
     * Update user data.
     *
     * @param Request $request
     * @param User $user
     * @return bool
     */
    public function updateUserData(Request $request, User $user): bool
    {
        try {
            $this->validateUpdateRequest($request);
        } catch (Exception $e) {
            return $e->validator->errors()->all();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        return true;
    }

    /**
     * Create user.
     *
     * @param Request $request
     * @return Model|Builder
     */
    public function createUser(Request $request): Model|Builder
    {
        try {
            $this->validateUpdateRequest($request);
        } catch (Exception $e) {
            return $e->validator->errors()->all();
        }

        return User::query()
            ->create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                ]
            );
    }

    /**
     * Get userInstance by id.
     *
     * @param $id
     * @return User
     */
    public function getUserById($id): User
    {
        return User::find($id);
    }

    /**
     * Delete user by id.
     *
     * @param int $id
     * @return bool
     */
    public function deleteUser(int $id): bool
    {
        try {
            return User::query()->where('id', $id)->delete();
        } catch (\Exception $exception) {
        }
        return false;
    }
}
