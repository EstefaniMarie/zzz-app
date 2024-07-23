<?php

namespace App\Http\Controllers;

use App\Models\Consultas;
use App\Models\MedicosConConsultas;
use App\Models\Pacientes;
use App\Models\Citas;
use App\Models\Medicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CitasController extends Controller
{
    public function color_rand()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public function index()
    {
        $medicos = Medicos::with('usuario.persona')->get();
        $pacientes = Pacientes::with('personas')->get();
        $consultas = Consultas::with('cita.persona.paciente.persona')->get();

        $eventos = [];
        $medicoColores = [];

        // Asignar colores aleatorios a cada médico
        foreach ($medicos as $medico) {
            $cedulaMedico = $medico->usuario->persona->cedula;
            $color = $this->color_rand();
            $medicoColores[$cedulaMedico] = $color;
        }

        foreach ($consultas as $consulta) {
            if ($consulta->cita) {
                $start = new \DateTime($consulta->start_date, new \DateTimeZone('America/Caracas'));
                $end = new \DateTime($consulta->end_date, new \DateTimeZone('America/Caracas'));
                $medicoId = $consulta->cita->cedulaMedico;
                $color = $medicoColores[$medicoId] ?? '#FFF';
                $cedulaPaciente = $consulta->cita->paciente->cedula;

                $evento = [
                    'title' => $consulta->cita->paciente->nombres . ' ' . $consulta->cita->paciente->apellidos,
                    'start' => $start->format(\DateTime::ISO8601),
                    'end' => $end->format(\DateTime::ISO8601),
                    'medicoId' => $medicoId,
                    'backgroundColor' => $color,
                    'cedulaPaciente' => $cedulaPaciente,
                ];
                $eventos[] = $evento;
            }
        }

        return view('citas.index', compact('eventos', 'medicos', 'pacientes'));
    }

    public function getEspecialidadesPorMedico($idMedico)
    {
        $medico = Medicos::findOrFail($idMedico);
        $especialidades = $medico->especialidades()->get();
        return response()->json($especialidades);
    }

    public function getMedicoDisponibilidad(Request $request)
    {
        $medicoId = $request->id;
        $medico = Medicos::find($medicoId);
        if (!$medico) {
            return response()->json(['error' => 'Médico no encontrado'], 404);
        }
        $diasDisponibles = explode(',', $medico->diasDisponibles);
        $diasDisponibles = array_map('intval', $diasDisponibles);
        return response()->json(['diasDisponibles' => $diasDisponibles]);
    }
    public function getHorasDisponibles($medicoId)
    {
        try {
            $horasDisponibles = DB::table('medicos')->where('id', $medicoId)->value('horasdisponibles');
            if ($horasDisponibles) {
                $horasArray = array_map('intval', array_map('trim', explode(',', $horasDisponibles)));
                $horasFormato = [
                    1 => '8:00 am',
                    2 => '9:00 am',
                    3 => '10:00 am',
                    4 => '11:00 am',
                    5 => '12:00 pm',
                    6 => '01:00 pm',
                    7 => '02:00 pm',
                    8 => '03:00 pm'
                ];
                $horasArray = array_filter($horasArray, function ($hora) use ($horasFormato) {
                    return isset($horasFormato[$hora]);
                });
                sort($horasArray);
                $horasDisponibles = array_map(function ($hora) use ($horasFormato) {
                    return $horasFormato[$hora];
                }, $horasArray);
                return response()->json([
                    'horasDisponibles' => $horasDisponibles
                ]);
            } else {
                return response()->json(['message' => 'No hay horas disponibles para el medico'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ha ocurrido un error'], 500);
        }
    }

    public function storeCitas(Request $request)
    {
        $validatedData = $request->validate([
            'idPaciente' => ['required', 'exists:pacientes,id'],
            'idMedico' => ['required', 'exists:medicos,id'],
            'fecha' => ['required', 'date'],
            'hora' => ['required', 'integer', 'between:1,8'],
        ]);

        $horasFormato = [
            1 => '08:00:00',
            2 => '09:00:00',
            3 => '10:00:00',
            4 => '11:00:00',
            5 => '12:00:00',
            6 => '13:00:00',
            7 => '14:00:00',
            8 => '15:00:00'
        ];

        $fecha = $validatedData['fecha'];
        $hora = $validatedData['hora'];
        $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $fecha . ' ' . $horasFormato[$hora])->toDateTimeString();
        $endDate = Carbon::parse($startDate)->addHour()->toDateTimeString();

        $citaExistente = MedicosConConsultas::where('idMedico', $validatedData['idMedico'])
            ->where('disponibilidad', false)
            ->whereHas('consulta', function ($query) use ($startDate, $endDate) {
                $query->where(function ($query) use ($startDate, $endDate) {
                    $query->where('start_date', '<', $endDate)
                        ->where('end_date', '>', $startDate);
                });
            })
            ->exists();

        if ($citaExistente) {
            return redirect()->back()->withErrors(['error' => 'La hora seleccionada no está disponible.']);
        }

        try {
            $paciente = Pacientes::find($validatedData['idPaciente']);
            $cedulaPaciente = $paciente->personas->cedula;

            $medico = Medicos::find($validatedData['idMedico']);
            $cedulaMedico = $medico->usuario->persona->cedula;

            $citas = Citas::create([
                'cedulaPaciente' => $cedulaPaciente,
                'cedulaMedico' => $cedulaMedico,
            ]);

            $consultas = Consultas::create([
                'idCita' => $citas->id,
                'start_date' => $startDate,
                'end_date' => $endDate
            ]);

            MedicosConConsultas::create([
                'idMedico' => $validatedData['idMedico'],
                'idConsulta' => $consultas->id,
                'disponibilidad' => false
            ]);

            return redirect()->back()->with('success', 'Cita registrada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al registrar la cita.']);
        }
    }

}
