<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function index(Request $request)
    {
        return Inertia::render('Main/SuperAdmin/Account/Users/Users', [
            'users' => DB::table('users')
                ->join('role_user', 'role_user.user_id', '=', 'users' . '.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->join('prodi', 'prodi.id_prodi', '=', 'users.prodi')
                ->select([
                    'users.id', 'users.name',
                    'users.email', 'roles.name as role_name',
                    'roles.id as role_id', 'prodi.nama_prodi', 'prodi.id_prodi'
                ])
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('users.name', 'like', "%{$search}%")
                        ->OrWhere('users.email', 'like', "%{$search}%")
                        ->OrWhere('roles.name', 'like', "%{$search}%");
                })
                ->paginate(10),
            'filters' => $request->only(["search"]),
            'role' => Role::select('id', 'name')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Main/SuperAdmin/Account/Users/FormAdd', [
            'roles' => Role::select("id", "name")
                ->where('id', '!=', '1')
                ->get(),
            'prodis' => Prodi::select('id_prodi', 'kode_prodi', 'nama_prodi')->get()
        ]);
    }

    public function store(Request $request)
    {
        // Validate
        $validatedData = $request->validate([
            "name" => "required",
            'email' => "required|email",
            'password' => "required",
            'role' => "required",
            'prodi' => "required",
        ]);


        // Save
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'prodi' => $request->input('prodi'),
        ]);

        $role = $request->input('role');
        $role = Role::where('id', $role)->first();
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
            'user' => DB::table('users')
                ->join('role_user', 'role_user.user_id', '=', 'users' . '.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->join('prodi', 'prodi.id_prodi', '=', 'users.prodi')
                ->select([
                    'users.id', 'users.name',
                    'users.email', 'roles.name as role_name',
                    'roles.id as role_id', 'prodi.nama_prodi', 'prodi.id_prodi'
                ])
                ->where('users.id', '=', $id)
                ->first(),
            'roles' => Role::select("id", "name")
                ->where('id', '!=', '1')
                ->get(),
            'prodis' => Prodi::select('id_prodi', 'kode_prodi', 'nama_prodi')->get()
        ]);
    }

    public function update(Request $request, $id)
    {
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
            'role' => "required",
            'prodi' => "required",
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
        $user->prodi = $request->input('prodi');

        $role = $request->input('role');
        $role = Role::where('id', $role)->first();
        $user->roles()->sync($role);

        // Save Update
        $user->save();

        // Redirect
        return to_route('user.index')->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Updated Success"
        ]);
    }

    public function destroy($id)
    {
        // Check If user exist
        $user = User::findOrFail($id);

        // Delete
        $user->delete();

        // Redirect
        return redirect()->back()->with("msg", [
            "type" => "success", // success | error | warning | info | question
            "text" => "Deleted Success"
        ]);
    }
}
