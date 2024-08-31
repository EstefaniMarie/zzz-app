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
            'symptoms.*' => 'string',
        ]);

        // Obtener los síntomas del input y asegurar que sea un array
        $symptoms = $request->input('symptoms', []);

        // Ruta al script de Python
        $scriptPath = base_path('resources/views/sintomas/sintomas.py');

        // Ruta completa del ejecutable de Python (ajústala según tu instalación)
        $pythonPath = 'C:\Users\Estefani Rosales\AppData\Local\Programs\Python\Python312\python.exe';

        // Crear un comando para ejecutar Python y pasar los síntomas como argumentos
        $command = array_merge([$pythonPath, $scriptPath], (array) $symptoms);

        // Crear y ejecutar el proceso
        $process = new Process($command);
        $process->run();

        // Capturar la salida de error y la salida estándar
        $errorOutput = $process->getErrorOutput();
        $output = $process->getOutput();

        // Manejar errores durante la ejecución del proceso
        if (!$process->isSuccessful()) {
            return response()->json(['error' => 'Error al ejecutar el script de diagnóstico.', 'detalle' => $errorOutput], 500);
        }

        // Decodificar la salida JSON del script de Python
        $result = json_decode($output, true);

        // Verificar si la salida contiene 'resultado'
        if (!isset($result['resultado'])) {
            return response()->json(['error' => 'Salida inválida del script de diagnóstico.'], 500);
        }

        $resultado = $result['resultado'];

        // Devolver el resultado como JSON
        return response()->json(['resultado' => $resultado]);
    }
}
