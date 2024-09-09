<?php

namespace App\Http\Controllers;

use App\Models\ConsultasConSintomas;
use App\Models\Sintomas;
use App\Models\Personas;
use App\Models\Diagnosticos;
use App\Models\SintomaConDiagnostico;
use Illuminate\Http\Request;


class SintomasController extends Controller
{
    public function index()
    {
        $pacientes = Personas::whereHas('citas.consulta')->distinct()->get();
        return view('sintomas.index', compact('pacientes'));
    }

    public function detalles($cedula)
    {
        $persona = Personas::where('cedula', $cedula)->firstOrFail();
        $citas = $persona->citas()->has('consulta')->with('consulta.sintomas')->get();
        $file = base_path('resources/views/sintomas/sintomas.csv');
        $rows = array_map('str_getcsv', file($file));

        $header = array_shift($rows);
        $symptoms = [];

        foreach ($citas as $cita) {
            $consulta = $cita->consulta;
        }

        foreach ($rows as $row) {
            for ($i = 1; $i < count($row); $i++) {
                $symptom = trim($row[$i]);
                if (!empty($symptom) && !in_array($symptom, $symptoms)) {
                    $symptoms[$symptom] = $symptom;
                }
            }
        }

        return view('sintomas.detalles', compact('persona', 'consulta', 'symptoms'));
    }

    public function prediccion(Request $request)
    {
        $request->validate([
            'symptoms' => 'required|array',
        ]);

        $sintomas = $request->input('symptoms');
        $sintomasString = implode(', ', $sintomas);
        $scriptPath = base_path('resources/views/sintomas/sintomas.py');
        $command = escapeshellcmd("python \"$scriptPath\" \"$sintomasString\"");
        $output = shell_exec($command . " 2>&1");
        $resultado = json_decode($output, true);

        return response()->json([
            'resultado' => $resultado['resultado'] ?? 'Error al obtener el resultado'
        ]);
    }

    public function guardarSintomas(Request $request)
    {
        $consultaId = $request->input('idConsulta');
        $selectedSymptoms = $request->input('symptoms');
        $resultado = $request->input('resultado');
        $descripcion = $request->input('descripcion');

        $diagnostico = new Diagnosticos();
        $diagnostico->tipo = $resultado;
        $diagnostico->descripcion = $descripcion;
        $diagnostico->save();

        foreach ($selectedSymptoms as $symp) {
            $sintoma = Sintomas::firstOrCreate(['descripcion' => $symp]);
    
            SintomaConDiagnostico::create([
                'idSintoma' => $sintoma->id,
                'idDiagnostico' => $diagnostico->id,
            ]);
    
            ConsultasConSintomas::create([
                'idConsulta' => $consultaId,
                'idSintoma' => $sintoma->id,
            ]);
        }

        return response()->json(['mensaje' => 'Registro realizado con éxito']);
    }
}
