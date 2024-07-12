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
            ->select('idPersona','personas.cedula', 'personas.nombres', 'Status')
            ->get();

        // dd($data);
        return view('users.index', ['usuarios' => $data]);
    }

    function userDetails($idPersona){
        $userDetails = User::
        join('personas', 'idPersona','personas.id')
        ->select('email', 'idRol', 'idPersona','personas.cedula', 'personas.nombres', 'personas.apellidos', 'Status')
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
                'email' => ['required', 'string' , 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
                'idRol' => 'required'
            ],$errorMessages);

            $user = User::where('idPersona', $request->idPersona)->first();
            $persona = Personas::where('id', $request->idPersona)->first();

            // dd($persona);

            $user->email = $request->email;
            $user->idRol = $request->idRol;
            $user->Status = $request->Status;
            
            $persona->nombres = $request->nombres;
            $persona->apellidos = $request->apellidos;
            $persona->cedula = $request->cedula;

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
                'idGenero' => 'required',
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'string', 'max:8'],
                'numero_telefono' => ['required', 'string', 'regex:/^\d{2}[1-6]{2}\d{7}$/'],
                'fecha_nacimiento' => ['required', 'date']
            ],[
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
                'idRol.required' => 'Debe seleccionar un rol',
                'idGenero.required' => 'Debe seleccionar un genero',
                'password.max' => 'La contraseña no puede superar los 8 caracteres',
                'password.required' => 'Debes ingresar una contraseña',
                'numero_telefono.regex' => 'Formato telefónico no valido',
                'numero_telefono.required' => 'Debes ingresar un número telefónico',
                'fecha_nacimiento.required' => 'Ingrese la fecha de nacimiento del usuario',
                'fecha_nacimiento.date' => 'Formato de fecha no valido'
            ]);

            // Busca si persona existe o no en la base de datos. Si existe, trae sus datos; si no existe, lo crea
            $persona = Personas::firstOrCreate([
                'nombres' => $request->nombres,
                'cedula' => $request->cedula,
                'apellidos' => $request->apellidos,
                'idGenero' => $request->idGenero,
                'numero_telefono' => $request->numero_telefono,
                'fecha_nacimiento' => $request->fecha_nacimiento
            ]);

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'idRol' => $request->idRol,
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
