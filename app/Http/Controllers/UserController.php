<?php

namespace App\Http\Controllers;

use Faker\Core\Number;
use Hash;
use App\Models\User;
use App\Models\Personas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    function editUser(Request $request) {
        $errorMessages = [
            'nombres.required' => 'El campo nombres es requerido',
            'nombres.regex' => 'El campo nombres no puede contener numeros o caracteres especiales',
            'apellidos.required' => 'El campo apellido es requerido',
            'apellidos.regex' => 'El campo apellido no puede contener numeros o caracteres especiales',
            'cedula.required' => 'El campo cédula es requerido',
            'cedula.regex' => 'El campo cédula solo puede contener números',
            'cedula.min' => 'El número de cedula no es valido (muy pequeno)',
            'cedula.max' => 'El número de cedula no es valido (muy grande)',
            'email.required' => 'El campo email es requerido',
            'email.regex' => 'Email no válido',
            'idRol.required' => 'Debe seleccionar al menos un rol'
        ];

        try {
            $request->validate([
                'nombres' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]*$/'],
                'apellidos' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]*$/'],
                'cedula' => ['required', 'integer','min:1000000', 'max:99999999'],
                'email' => ['required', 'string', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
                'idRol' => ['required']
            ],$errorMessages);

            $user = User::where('idPersona', $request->idPersona)->first();
            $persona = Personas::where('id', $request->idPersona)->first();

            $user->fill($request->all());
            $persona->fill($request->all());

            $persona->save();
            $user->save();


            return redirect()->route('usuarios')->with(
                'success', 'Usuario '.$request->nombres.' '.$request->apellidos.' actualizado éxitosamente'
            );

        } catch(\Illuminate\Validation\ValidationException $ve){
            // dd($ve);
            return redirect()->back()->withErrors([
                'error' => $ve->getMessage()
            ]); 
        } 
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
