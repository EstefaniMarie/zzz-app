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
            <form id="sintomasForm">
                @csrf
                <input type="hidden" name="idConsulta" value="{{ $consulta->id }}">
                <div class="modal-body px-3 py-2">
                    <fieldset class="form-group">
                        <label for="name" style="color:black;">Nombre y Apellido del Paciente</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $persona->nombres }} {{ $persona->apellidos }}">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="sintomas">Seleccione los síntomas:</label><br>
                        <select class="symptoms" id="symptoms" name="symptoms[]" multiple style="width: 29.3rem;">
                            @foreach($symptoms as $symptom)
                                <option value="{{ $symptom }}">{{ $symptom }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-secondary mt-2">Diagnosticar</button>
                    </fieldset>
                    <input type="text" id="resultado" name="resultado" value="Diagnóstico Posible" style="width: 29.3rem;">
                    <fieldset class="mt-2 form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" name="descripcion"></textarea>
                    </fieldset>
                    <button type="button" class="btn btn-primary" id="guardarSintomasBtn">Guardar</button>
                    <h5 class="mt-2" id="mensaje"></h5>
                </div>
            </form>
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
        const form = $('#sintomasForm');
        const guardarSintomasBtn = $('#guardarSintomasBtn');
        const resultadoInput = $('#resultado');

        const translations = {
            "Fungal infection": "Micosis",
            "Allergy": "Alergia",
            "GERD": "Reflujo gastroesofágico",
            "Chronic cholestasis": "Colestasis crónica",
            "Drug Reaction": "Reacción a los medicamentos",
            "Peptic ulcer diseae": "Enfermedad ulcerosa péptica",
            "AIDS": "SIDA",
            "Diabetes": "Diabetes",
            "Gastroenteritis": "Gastroenteritis",
            "Bronchial Asthma": "Asma bronquial",
            "Hypertension": "Hipertensión",
            "Migraine": "Migraña",
            "Cervical spondylosis": "Espondilosis cervical",
            "Paralysis (brain hemorrhage)": "Parálisis (hemorragia cerebral)",
            "Jaundice": "Ictericia",
            "Malaria": "Malaria",
            "Chicken pox": "Varicela",
            "Dengue": "Dengue",
            "Typhoid": "Tifoidea",
            "hepatitis A": "Hepatitis A",
            "Hepatitis B": "Hepatitis B",
            "Hepatitis C": "Hepatitis C",
            "Hepatitis D": "Hepatitis D",
            "Hepatitis E": "Hepatitis E",
            "Alcoholic hepatitis": "Hepatitis alcohólica",
            "Tuberculosis": "Tuberculosis",
            "Common Cold": "Resfriado común",
            "Pneumonia": "Neumonía",
            "Dimorphic hemmorhoids(piles)": "Hemorroides dimórficas",
            "Heart attack": "Infarto de miocardio",
            "Varicose veins": "Varices",
            "Hypothyroidism": "Hipotiroidismo",
            "Hyperthyroidism": "Hipertiroidismo",
            "Hypoglycemia": "Hipoglucemia",
            "Osteoarthristis": "Osteoartritis",
            "Arthritis": "Artritis",
            "(vertigo) Paroymsal  Positional Vertigo": "Vértigo posicional paroxístico",
            "Acne": "Acne",
            "Urinary tract infection": "Infección del tracto urinario",
            "Psoriasis": "Soriasis",
            "Impetigo": "Impétigo",
        };

        form.submit(function (event) {
            event.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url: '{{ route('prediccion') }}',
                type: 'POST',
                data: formData,
                success: function (response) {
                    resultadoInput.val(translations[response.resultado] || response.resultado); // Actualizar el valor del input
                    guardarSintomasBtn.show();
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    resultadoInput.text('Error al obtener el resultado.');
                }
            });
        });

        guardarSintomasBtn.click(function () {
            const selectedSymptoms = $('.symptoms option:selected');
            const formData = new FormData(form[0]);
            formData.append('action', 'guardar-sintomas');

            $.ajax({
                url: '{{ route('guardar') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#mensaje').text('Registro guardado con éxito');
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    $('#mensaje').text('Error al guardar el registro.');
                }
            });
        });
    });
</script>
