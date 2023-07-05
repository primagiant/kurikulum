<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function index(Request $request)
    {
        return Inertia::render('Main/SuperAdmin/Account/Users/Users', [
            'users' => User::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->OrWhere('email', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
                ]),
            'filters' => $request->only(["search"]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Main/SuperAdmin/Account/Users/FormAdd');
    }

    public function store(Request $request)
    {
        // Validate
        $validatedData = $request->validate([
            "name" => "required",
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
            ]
        ]);

        // Save
        $user = User::create($validatedData);
        $role = Role::where('name', 'koor_prodi')->first();
        $user->roles()->attach($role);

        // Redirect
        return to_route('user.index')->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Created Success"
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('Main/SuperAdmin/Account/Users/FormEdit', [
            'user' => User::select('name', 'email', 'id')->find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            // Check If user exist
            $user = User::findOrFail($id);

            // Validate
            $request->validate([
                "name" => "required",
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore($id),
                ],
            ]);

            // Check if the password input is empty
            if (empty($request->input('password'))) {
                // If empty, use the existing password
                $password = $user->password;
            } else {
                // If not empty, hash the new password
                $password = bcrypt($request->input('password'));
            }

            // Update
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $password;

            // Save Update
            $user->save();

            // Redirect
            return to_route('user.index')->with("msg", [
                "type" => "success", // success | error | warning | info | question
                "text" => "Updated Success"
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            // Check If user exist
            $user = User::findOrFail($id);

            // Delete
            $user->delete();

            // Redirect
            return to_route('user.index')->with("msg", [
                "type" => "success", // success | error | warning | info | question
                "text" => "Deleted Success"
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
