<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function get(User $user)
    {
        $test = [];
        $i = 0;
        foreach ([1, 2] as $row) {
            $test[] = [
                'id' => $i + 1,
                'name' => 'Oleksandr' . $i,
                'email' => 'aleksandr.kravchuk.os@gmail.com',
                'phone' => '+380664784973',
                'make' => '<div class="buttonUpdate">Update</div><div class="buttonDelete">Delete</div>'
            ];
            $i++;
        }

        return $test;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
