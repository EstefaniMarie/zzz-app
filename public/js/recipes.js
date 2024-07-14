function agregarListeners() {
    const generarPDFButtons = document.querySelectorAll('.pdfRecipe');
    generarPDFButtons.forEach(button => {
        button.addEventListener('click', function() {
            const paciente = button.getAttribute('data-recipe-paciente');
            const cedula = button.getAttribute('data-recipe-cedula');
            const edad = button.getAttribute('data-recipe-edad');
            const nombre = button.getAttribute('data-recipe-nombre');
            const presentacion = button.getAttribute('data-recipe-presentacion');
            const fecha = button.getAttribute('data-recipe-fecha');
            let indicaciones = button.getAttribute('data-recipe-indicaciones');

            indicaciones = indicaciones?.replace(/\n/g, '<br>');
    
            const ventanaImpresion = window.open('', '_blank');

            ventanaImpresion.document.write('<!DOCTYPE html>');
            ventanaImpresion.document.write('<html><head><title>Receta Médica</title></head><body style="width: 100%; height: 100%; margin: 20px; display: flex;">');
            ventanaImpresion.document.write('<div style="width: 50%; position: relative;">');
            ventanaImpresion.document.write(`
            <div style="display: flex; justify-content: space-between;">
                <div style="float: left;">
                <p style="margin-bottom: 0; margin-top: 0; font-style: italic;">OFICINA DE GESTIÓN HUMANA</p>
                <p style="margin-bottom: 0; margin-top: 0; font-style: italic;">CENTRO MÉDICO ASISTENCIAL</p>
                <p style="margin-bottom: 0; margin-top: 0; font-style: italic;">DR. JOSÉ GREGORIO HERNÁNDEZ</p>
                </div>
                <div style="width: 35%; background-color: #0E528E; padding: 15px; border-bottom-left-radius: 20%; margin-right:50px;">
                <p style="margin-bottom: 0; margin-top: 0; font-size: 24px; font-weight: bold; text-align: center; color:white; text-transform: uppercase;"></p>
                </div>
            </div>
            `);
            ventanaImpresion.document.write(`
            <div style="display: flex; justify-content: space-between;">
                <p style="margin-bottom: 0; font-size: 20px; margin-left:50px;"><strong>Fecha: ${fecha} </strong> </p>
            </div>
            `);
            ventanaImpresion.document.write('<div style="clear: both;"></div>');
            ventanaImpresion.document.write(`<h3 style="text-align:center; font-size: 30px;">Récipe Médico</h3>`);
            ventanaImpresion.document.write(`<p style="font-family:Arial, sans-serif; font-size: 25px; margin-left:20px; margin-right:20px; text-align:center;">Nombre y Apellido: ${paciente} </p>`);
            ventanaImpresion.document.write(`<p style="font-size: 21px; margin-left:20px; margin-right:20px; text-align:center;">Cédula de Identidad: ${cedula} </p>`);
            ventanaImpresion.document.write(`<p style="font-size: 21px; margin-left:20px; margin-right:20px; text-align:center;">Edad: ${edad} años</p>`);
            ventanaImpresion.document.write(`<p style="font-size: 16px; margin-left:20px; margin-right:20px;">Medicamento: ${nombre}</p>`);
            ventanaImpresion.document.write(`<p style="font-size: 16px; margin-left:20px; margin-right:20px;">Presentación: ${presentacion} </p>`);
            ventanaImpresion.document.write(`
                <div style="position: absolute; top:42rem; left: 20px; width: 190px; height: 40px; background-color: #0E528E; border-top-right-radius: 40%;"></div>
            `);
            ventanaImpresion.document.write(`
                <img src="/images/gobierno.png" alt="Gobierno Logo" style="position: absolute; bottom: 10px; right: 50px; width: 150px; height: 50px; top:42rem;">
            `);
            ventanaImpresion.document.write('</div>');
            ventanaImpresion.document.write('<div style="width: 50%; float: right; position: relative;">');
            ventanaImpresion.document.write(`
            <div style="display: flex; justify-content: space-between;">
                <div style="float: left;">
                <p style="margin-bottom: 0; margin-top: 0; font-style: italic;">OFICINA DE GESTIÓN HUMANA</p>
                <p style="margin-bottom: 0; margin-top: 0; font-style: italic;">CENTRO MÉDICO ASISTENCIAL</p>
                <p style="margin-bottom: 0; margin-top: 0; font-style: italic;">DR. JOSÉ GREGORIO HERNÁNDEZ</p>
                </div>
                <div style="width: 35%; background-color: #0E528E; padding: 15px; border-bottom-left-radius: 20%; margin-right:50px;">
                <p style="margin-bottom: 0; margin-top: 0; font-size: 24px; font-weight: bold; text-align: center; color:white; text-transform: uppercase;"></p>
                </div>
            </div>
            `);
            ventanaImpresion.document.write(`
            <div style="display: flex; justify-content: space-between;">
                <p style="margin-bottom: 0; font-size: 20px; margin-left:50px;"><strong>Fecha: ${fecha} </strong> </p>
            </div>
            `);
            ventanaImpresion.document.write('<div style="clear: both;"></div>');
            ventanaImpresion.document.write(`<h3 style="text-align:center; font-size: 30px;">Indicaciones Médicas</h3>`);
            ventanaImpresion.document.write(`<p style="font-family:Arial, sans-serif; font-size: 25px; margin-left:20px; margin-right:20px; text-align:center;">Nombre y Apellido: ${paciente} </p>`);
            ventanaImpresion.document.write(`<p style="font-size: 21px; margin-left:20px; text-align:center; margin-right:20px;">Cédula de Identidad: ${cedula} </p>`);
            ventanaImpresion.document.write(`<p style="font-size: 21px; margin-left:20px; margin-right:20px; text-align:center;">Edad: ${edad} años</p>`);
            ventanaImpresion.document.write(`<p style="font-size: 16px; margin-left:20px; margin-right:20px;">Medicamento: ${nombre}</p>`);
            ventanaImpresion.document.write('<p style="font-size: 16px; margin-left:20px; margin-right:20px;">Indicaciones</p>');
        ventanaImpresion.document.write(`<p style="font-size: 16px; margin-left:20px; margin-right:20px; text-align:justify">${indicaciones}</p>`);
            ventanaImpresion.document.write(`
                <div style="position: absolute; top:42rem; left: 20px; width: 190px; height: 40px; background-color: #0E528E; border-top-right-radius: 40%;"></div>
            `);
            ventanaImpresion.document.write(`
                <img src="/images/gobierno.png" alt="Gobierno Logo" style="position: absolute; bottom: 10px; right: 50px; width: 150px; height: 50px; top:42rem;">
            `);
            ventanaImpresion.document.write('</div>');
            ventanaImpresion.document.write('</div>');
            ventanaImpresion.document.write('</body></html>');

            ventanaImpresion.document.close();

            ventanaImpresion.onload = function() {
                ventanaImpresion.print();
            };
        });
    });
}
agregarListeners();