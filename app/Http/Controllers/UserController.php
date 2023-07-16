<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('users');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return User::query()
            ->create(
                [
                    'name' => $request->user_name,
                    'email' => $request->user_email,
                    'phone' => $request->user_phone,
                    'password' => Hash::make($request->user_password),
                ]
            );
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
     * @param Request $request
     * @return User
     */
    public function data($id, Request $request): User
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): bool
    {
        $id = $request->id;
        $user = User::query()->where('id', $id)->first();
        $updated = false;

        if ($user) {
            $user->name = $request->user_name;
            $user->email = $request->user_email;
            $user->password = Hash::make($request->user_password);
            $user->save();
            $updated = true;
        }

        return $updated;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return User::query()->where('id', $id)->delete();
    }
}
