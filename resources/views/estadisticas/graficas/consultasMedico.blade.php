<div id="MedicoConsulta">
    <select name="selectMedicos" id="selectMedicos">
        @foreach ($medicos as $medico)
            <option value="{{$medico->cedula}}">{{$medico->nombres.' '.$medico->apellidos.' - '.$medico->cedula}}</option>
        @endforeach
    </select>
    <canvas id="grafica-consultas" width="400" height="200"></canvas>
</div>
