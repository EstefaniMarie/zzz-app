<?php

namespace App\Http\Controllers;

use App\Models\Sync;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Personas;
use App\Models\Empleados;
use App\Models\Pacientes;
use App\Models\Medicos;

class RespaldoController extends Controller
{
    public function index(){
        $backups = Sync::get();

        return view('respaldo.index', ['syncs' => $backups]);
    }

    public function generarBackup(Request $request ) {
        $ruta = $request->input('ruta');
        $filename = \Str::slug(basename($ruta));
        $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
        // dd(Storage::exists('backups/MinAguasBackup_2024-07-31_19-30-402024-07-31-13-30-41.zip'));
        if(!Storage::exists($ruta)){
            return response()->json(['error' => 'El archivo no existe'], 404);
        }

        return Storage::download($ruta, $filename, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="'.$filenameWithoutExtension,]);
    }

    public function sincronizacionCSV(Request $request) {
        $archivoCsv = $request->file('archivo_csv');
        $rutaArchivo = $archivoCsv->storeAs('csv', 'importacion.csv');

        $datosCsv = array();
        if (($gestor = fopen(storage_path('app/' . $rutaArchivo), 'r')) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                $datosCsv[] = $datos;
            }
            fclose($gestor);
        }

        // Procesa los datos del CSV y verifica si existen en las tablas
        foreach ($datosCsv as $dato) {
            // Verifica si la persona existe en la tabla Personas
            $personaExiste = Personas::where('cedula', $dato[0])->exists();
            if (!$personaExiste) {
                // Inserta la persona en la tabla Personas
                $persona = Personas::create([
                    'nombres' => $dato[1],
                    'apellidos' => $dato[2],
                    'fecha_nacimiento' => $dato[3],
                    'cedula' => $dato[0],
                    'numero_telefono' => $dato[4],
                    'idGenero' => $dato[5]
                ]);
            } else {
                $persona = Personas::where('cedula', $dato[0])->first();
            }

            // Verifica si el paciente existe en la tabla pacientes
            $pacienteExiste = Pacientes::where('idPersona', $persona->id)->exists();
            if (!$pacienteExiste) {
                // Inserta el paciente en la tabla pacientes
                $paciente = Pacientes::create(['idPersona' => $persona->id]);
            } else {
                $paciente = Pacientes::where('idPersona', $persona->id)->first();
            }

            // Verifica si el empleado existe en la tabla Empleados
            $empleadoExiste = Empleados::where('idPacientes', $paciente->id)->exists();
            if (!$empleadoExiste) {
                // Inserta el empleado en la tabla Empleados
                Empleados::create([
                    'idPacientes' => $paciente->id,
                    'nombre_unidad' => $dato[6],
                    'codigoTrabajador' => $dato[7]
                ]);
            }
        }

        $medicoExiste = Medicos::where('idUsuario', $persona->id)->exists();
        if (!$medicoExiste) {
            // Inserta el médico en la tabla Médicos
            Medicos::create([
                'idUsuario' => $persona->id,
                'colegiatura' => $dato[8],
                'diasDisponibles' => $dato[9],
                'horasDisponibles' => $dato[10]
            ]);
        }

        return redirect()->json(['success' => 'Importación exitosa']);
    }
}
