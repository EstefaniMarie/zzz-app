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
                'email' => ['required', 'string', 'unique:'.User::class , 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
                'idRol' => 'required'
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
    public function createUser(Request $request)
    {
        try {
            $request->validate([
                'nombres' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]*$/'],
                'apellidos' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]*$/'],
                'cedula' => ['required', 'string', 'max:255'],
                'idRol' => 'required',
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'string', 'max:8'],
                'numero_telefono' => ['required', 'string', 'regex:/^\d{3}-\d{6}$/'],
                'fecha_nacimiento' => ['required', 'date']
            ]);

            $persona = Personas::create([
                'nombres' => $request->nombres,
                'cedula' => $request->cedula,
                'apellidos' => $request->apellidos,
                'numero_telefono' => $request->numero_telefono,
                'fecha_nacimiento' => $request->fecha_nacimiento
            ])->get();

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'idRole' => $request->idRol,
                'idPersona' => $persona->id
            ]);
            $user->assignRole($request->role);
            
            return redirect()->route('usuarios')->with('success', 'Usuario creado exitosamente: '.$request->nombres.' '.$request->apellidos.' '.$request->cedula);
        } catch (\Exception $e) {
            return redirect()->route('usuarios')->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }
    
}
