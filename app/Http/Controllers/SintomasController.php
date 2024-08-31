<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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
        $file = base_path('resources/views/sintomas/sintomas.csv');
        $rows = array_map('str_getcsv', file($file));

        $header = array_shift($rows);
        $symptoms = [];

        foreach ($rows as $row) {
            for ($i = 1; $i < count($row); $i++) {
                $symptom = trim($row[$i]);
                if (!empty($symptom) && !in_array($symptom, $symptoms)) {
                    $symptoms[$symptom] = $symptom;
                }
            }
        }

        return view('sintomas.detalles', compact('persona', 'symptoms'));
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
}
