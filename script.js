const inputCliente = document.getElementById('lblCli');
const inputProducto = document.getElementById('lblEma'); // ID del campo producto
const inputCantidad = document.getElementById('cantidad');
const inputPrecio = document.getElementById('precio');
const inputTotal = document.getElementById('inputTotal');
const divResultado = document.getElementById('resultado');
const btnRegistrar = document.getElementById('btnRegistrar');
const btnCalcular = document.getElementById('btnCalcular');
const btnEliminarUltimo = document.getElementById('btnEliminarUltimo');
const btnEliminarTodo = document.getElementById('btnEliminarTodo');

btnCalcular.addEventListener('click', () => {
    const cantRaw = document.getElementById('cantidad').value.trim();
    const precRaw = document.getElementById('precio').value.trim();
    const campoTotal = document.getElementById('inputTotal');

    if (cantRaw === "" || precRaw === "") {
        alert("Los campos no pueden estar vacíos.");
        return;
    }

    const cant = parseInt(cantRaw);
    const prec = parseInt(precRaw);

    if (cant < 0 || prec < 0) {
        alert("No se permiten números negativos.");
        campoTotal.value = ""; 
        return;
    }

    const total = cant * prec;
    campoTotal.value = total;
});


btnRegistrar.addEventListener('click', async (e) => {
    e.preventDefault();

    // Verificamos que los elementos existan antes de leer su valor
    const nombreCliente = inputCliente.value.trim();
    const valorCantidad = inputCantidad.value.trim();

    if (nombreCliente === "" || valorCantidad === "") {
        divResultado.textContent = "Error: El nombre del Cliente y la Cantidad son obligatorios.";
        divResultado.style.color = "red";
        return; 
    }

    // Creamos el objeto con los datos capturados en ese momento
    const datosVenta = {
        cliente: nombreCliente,
        producto: inputProducto.value.trim(),
        cantidad: valorCantidad,
        precio: inputPrecio.value,
        total: inputTotal.value
    };

    try {
        const respuesta = await fetch('registrar.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datosVenta)
        });

        // Verificamos si la respuesta es OK antes de convertir a JSON
        if (!respuesta.ok) throw new Error("Error en el servidor");

        const resultado = await respuesta.json();

        if (resultado.mensaje) {
            divResultado.textContent = "Venta registrada con éxito: " + nombreCliente;
            divResultado.style.color = "green";
            document.querySelector('form').reset();
        } else {
            throw new Error(resultado.error);
        }

    } catch (error) {
        console.error(error);
        divResultado.textContent = "Error: " + error.message;
        divResultado.style.color = "red";
    }
});

async function ejecutarEliminacion(tipoAccion) {
    if (tipoAccion === "eliminar_todo" && !confirm("¿Estás seguro de borrar TODA la base de datos?")) {
        return; // Cancela si el usuario no confirma
    }

    try {
        const respuesta = await fetch('eliminar.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ accion: tipoAccion })
        });

        const resultado = await respuesta.json();
        
        if (resultado.mensaje) {
            divResultado.textContent = resultado.mensaje;
            divResultado.style.color = "blue";
        } else {
            throw new Error(resultado.error);
        }
    } catch (error) {
        divResultado.textContent = "Error: " + error.message;
        divResultado.style.color = "red";
    }
}

// Eventos para los botones
btnEliminarUltimo.addEventListener('click', () => ejecutarEliminacion("eliminar_ultimo"));
btnEliminarTodo.addEventListener('click', () => ejecutarEliminacion("eliminar_todo"));