<div class="modal fade" id="addSintomas" tabindex="-1" role="dialog" aria-labelledby="addSintomasLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSintomasLabel">Añadir Síntomas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('prediccion') }}" method="POST">
                @csrf
                <div class="modal-body px-3 py-2">
                    <fieldset class="form-group">
                        <label for="name" style="color:black;">Nombre y Apellido del Paciente</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $persona->nombres }} {{ $persona->apellidos }}">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="sintomas">Seleccione los síntomas:</label><br>
                        <select class="symptoms" id="symptoms" name="symptoms[]" multiple>
                            @foreach($symptoms as $symptom)
                                <option value="{{ $symptom }}">{{ $symptom }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Diagnosticar</button>
                    </fieldset>
                    <div id="resultado"></div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function () {
        // Los síntomas desde el backend
        const symptoms = @json($symptoms);

        console.log('Symptoms:', symptoms);

        // Definir un objeto de traducciones
        const translations = {
            "abdominal_pain": "Dolor abdominal",
            "abnormal_menstruation": "Menstruación anormal",
            "acidity": "Acidez",
            "acute_liver_failure": "Insuficiencia hepática aguda",
            "altered_sensorium": "Sensorio alterado",
            "anxiety": "Ansiedad",
            "back_pain": "Dolor de espalda",
            "belly_pain": "Dolor de vientre",
            "blackheads": "Puntos negros",
            "bladder_discomfort": "Malestar de vejiga",
            "blister": "Ampolla",
            "blood_in_sputum": "Sangre en el esputo",
            "bloody_stool": "Taburete sangriento",
            "blurred_and_distorted_vision": "Visión borrosa y distorsionada",
            "breathlessness": "Falta de aliento",
            "brittle_nails": "Uñas quebradizas",
            "bruising": "Hematomas",
            "burning_micturition": "Micción ardiente",
            "chest_pain": "Dolor en el pecho",
            "chills": "Escalofríos",
            "cold_hands_and_feets": "Manos y pies fríos",
            "coma": "Coma",
            "congestion": "Congestión",
            "constipation": "Estreñimiento",
            "continuous_feel_of_urine": "Sensación continua de orina",
            "continuous_sneezing": "Estornudos continuos",
            "cough": "Tos",
            "cramps": "Calambre",
            "dark_urine": "Orina oscura",
            "dehydration": "Deshidración",
            "depression": "Depresión",
            "diarrhoea": "Diarrea",
            "dischromic _patches": "Parches discrómicos",
            "distention_of_abdomen": "Distensión abdominal",
            "dizziness": "Mareo",
            "drying_and_tingling_lips": "Labios secos y con hormigueo",
            "enlarged_thyroid": "Tiroides agrandada",
            "excessive_hunger": "Hambre excesiva",
            "extra_marital_contacts": "Contactos extramatrimoniales",
            "family_history": "Historia familiar",
            "fast_heart_rate": "Frecuencia cardíaca rápida",
            "fatigue": "Fatiga",
            "fluid_overload": "Sobrecarga de fluido",
            "foul_smell_of urine": "Mal olor a orina",
            "headache": "Dolor de cabeza",
            "high_fever": "Fiebre alta",
            "hip_joint_pain": "Dolor en la articulación de la cadera",
            "history_of_alcohol_consumption": "Historia del consumo de alcohol",
            "increased_appetite": "Aumento del apetito",
            "indigestion": "indigestión",
            "inflammatory_nails": "Uñas inflamatorias",
            "internal_itching": "Picazón interna",
            "irregular_sugar_level": "Nivel de azúcar irregular",
            "irritability": "Irritabilidad",
            "irritation_in_anus": "Irritación en el ano",
            "itching": "Picazón",
            "joint_pain": "Dolor en las articulaciones",
            "knee_pain": "Dolor de rodilla",
            "lack_of_concentration": "Falta de concentración",
            "lethargy": "Letargo",
            "loss_of_appetite": "Pérdida de apetito",
            "loss_of_balance": "Pérdida de equilibrio",
            "loss_of_smell": "Pérdida del olfato",
            "malaise": "Malestar",
            "mild_fever": "Fiebre leve",
            "mood_swings": "Cambios de humor",
            "movement_stiffness": "Rigidez del movimiento",
            "mucoid_sputum": "Esputo mucoide",
            "muscle_pain": "Dolor muscular",
            "muscle_wasting": "Pérdida de masa muscular",
            "muscle_weakness": "Debilidad muscular",
            "nausea": "Náuseas",
            "neck_pain": "Dolor de cuello",
            "nodal_skin_eruptions": "Erupciones nodales de la piel",
            "obesity": "Obesidad",
            "pain_behind_the_eyes": "Dolor detrás de los ojos",
            "pain_during_bowel_movements": "Dolor durante las deposiciones",
            "pain_in_anal_region": "Dolor en la región anal",
            "painful_walking": "Caminar doloroso",
            "palpitations": "Palpitaciones",
            "passage_of_gases": "Paso de gases",
            "patches_in_throat": "Parches en la garganta",
            "phlegm": "Flema",
            "polyuria": "Poliuria",
            "prominent_veins_on_calf": "Venas prominentes en la pantorrilla",
            "puffy_face_and_eyes": "Cara y ojos hinchados",
            "pus_filled_pimples": "Granos llenos de pus",
            "receiving_blood_transfusion": "Recibiendo transfusión de sangre",
            "receiving_unsterile_injections": "Recibiendo inyecciones no estériles",
            "red_sore_around_nose": "Llaga roja alrededor de la nariz",
            "red_spots_over_body": "Manchas rojas en el cuerpo",
            "redness_of_eyes": "Enrojecimiento de los ojos",
            "restlessness": "Inquietud",
            "runny_nose": "Rinorrea",
            "rusty_sputum": "Esputo oxidado",
            "scurring": "Corriendo",
            "shivering": "Temblando",
            "silver_like_dusting": "Polvo plateado",
            "sinus_pressure": "Presión sinusal",
            "skin_peeling": "Descamación de la piel",
            "skin_rash": "Erupción cutánea",
            "slurred_speech": "Habla arrastrada",
            "small_dents_in_nails": "Pequeñas abolladuras en las uñas",
            "spinning_movements": "Movimientos giratorios",
            "spotting_ urination": "Micción",
            "stiff_neck": "Rigidez de nuca",
            "stomach_bleeding": "Sangrado de estómago",
            "stomach_pain": "Dolor de estómago",
            "sunken_eyes": "Ojos hundidos",
            "sweating": "Transpiración",
            "swelled_lymph_nodes": "Ganglios linfáticos inflamados",
            "swelling_joints": "Articulaciones hinchadas",
            "swelling_of_stomach": "Hinchazón del estómago",
            "swollen_blood_vessels": "Vasos sanguíneos hinchados",
            "swollen_extremeties": "Extremidades hinchadas",
            "swollen_legs": "Piernas hinchadas",
            "throat_irritation": "Irritación de garganta",
            "toxic_look_(typhos)": "Tifos",
            "ulcers_on_tongue": "Úlceras en la lengua",
            "unsteadiness": "Inestabilidad",
            "visual_disturbances": "Perturbaciones visuales",
            "vomiting": "Vómitos",
            "watering_from_eyes": "Lagrimeo de los ojos",
            "weakness_in_limbs": "Debilidad en las extremidades",
            "weakness_of_one_body_side": "Debilidad de un lado del cuerpo",
            "weight_gain": "Aumento de peso",
            "weight_loss": "Pérdida de peso",
            "yellow_crust_ooze": "Lodo de corteza amarilla",
            "yellow_urine": "Orina amarilla",
            "yellowing_of_eyes": "Coloración amarillenta de los ojos",
            "yellowish_skin": "Piel amarillenta",
        };

        const $selectElement = $('.symptoms');

        // Agregar las opciones al select
        Object.entries(symptoms).forEach(([key, value]) => {
            let option = $('<option></option>').attr('value', key).text(value);
            $selectElement.append(option);
        });

        // Traducir las opciones
        $selectElement.find('option').each(function () {
            const originalText = $(this).text();
            if (translations[originalText]) {
                $(this).text(translations[originalText]);
            }
        });

        $selectElement.select2({
            placeholder: 'Seleccione uno o más síntomas',
            language: {
                noResults: function () {
                    return 'No se encontró ningún síntoma';
                }
            },
            allowClear: true
        });
    });
</script>


<script>
    $(document).ready(function () {

        $('#addSintomas form').submit(function (event) {
            event.preventDefault(); 

            var form = $(this);
            var formData = form.serialize(); 

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#resultado').text('Diágnostico posible: ' + response.resultado);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    $('#resultado').text('Error al obtener el resultado.');
                }
            });
        });
    });
</script>