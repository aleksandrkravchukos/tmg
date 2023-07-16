<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function home(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('home');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('users');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->userService->createUser($request);
    }

    /**
     * Get all users data.
     */
    public function getUsers(): array
    {
        $users = User::all();
        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'make' => '<div id="' . $user->id . '" class="buttonUpdate openModal">Update</div>
                           <div id="' . $user->id . '" class="buttonDelete deleteModal">Delete</div>',
            ];
        }

        return $data;
    }

    /**
     * Get user data by id.
     *
     * @param $id
     * @return User
     */
    public function data($id): User
    {
        return $this->userService->getUserById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): bool
    {
        $id = $request->id;
        /** @var User $user */
        $user = User::query()->where('id', $id)->first();
        return $this->userService->update($request, $user);
    }

    /**
     * Delete user by id.
     *
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->userService->deleteUser($id);
    }
}
