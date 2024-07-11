<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::
            join('personas', 'idPersona','personas.id')
            ->select('idPersona','personas.cedula', 'personas.nombres')
            ->get();

        // dd($data);
        return view('users.index', ['usuarios' => $data]);
    }

    function userDetails($idPersona){
        $userDetails = User::
        join('personas', 'idPersona','personas.id')
        ->select('email', 'idRol', 'idPersona','personas.cedula', 'personas.nombres', 'personas.apellidos')
        ->where('idPersona', $idPersona)
        ->get();

        return response()->json($userDetails);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'dni' => ['required', 'string', 'max:255'],
                'role' => 'required',
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => 'required|same:password_confirmation',
            ]);
            $user = User::create([
                'name' => $request->name,
                'dni' => $request->dni,
                'phone' => $request->phone,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole($request->role);
            // dd($user);
        } catch (\Throwable $th) {
            // dd($th);
        }

        return Redirect::route('users');
    }
}
