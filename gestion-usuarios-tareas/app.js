// MINIPROYECTO JAVASCRIPT

// ------INTEGRANTES--------
// * JUAN DIEGO ALBARRACIN HIDALGO *



// Array inicial de usuarios con sus resepectivas tareas
let usuarios = [
    {
        id: 1,
        nombre: "Juan",
        tareas: [
            { descripcion: "Estudiar JavaScript", estado: "pendiente", fecha: "2025-06-08" },
            { descripcion: "Realizar Miniproyecto", estado: "completada", fecha: "2025-06-07" }
        ]
    },
    {
        id: 2,
        nombre: "Carlos",
        tareas: [
            { descripcion: "Comprar utiles para el semestre", estado: "pendiente", fecha: "2025-06-09" }
        ] //Como se nos dio en el ejemplo, contiene su id, nombre, tareas y descripcion
    }
];

// Con esta función mostramos el menú de la aplicacion
function mostrarMenu() {
    console.log("\n=== Gestión de Usuarios y Tareas ===");
    console.log("1. Ver usuarios existentes");
    console.log("2. Agregar nuevo usuario");
    console.log("3. Ver tareas de un usuario");
    console.log("4. Agregar nueva tarea a un usuario");
    console.log("5. Marcar tarea como completada");
    console.log("6. Eliminar una tarea");
    console.log("7. Salir del programa");
}

// Listamos todos los usuarios
function listarUsuarios() {
    // Usamos el bucle for para iterar el array
    for (let i = 0; i < usuarios.length; i++) {
        console.log(`ID: ${usuarios[i].id}, Nombre: ${usuarios[i].nombre}`);
    }
}

// Agregamos un nuevo usuario
function agregarUsuario() {
    let nombre = prompt("Escriba el nombre del nuevo usuario:");
    
    // Validamos con if
    if (nombre && nombre.trim() !== "") {
        let nuevoId = usuarios.length + 1;
        usuarios.push({
            id: nuevoId,
            nombre: nombre.trim(),
            tareas: []
        });
        console.log(`Usuario ${nombre} agregado correctamente!`);
    } else {
        console.log("Error: El nombre no puede estar vacío.");
    } // Si el array esta vacio, no se muestra nada
}

// Buscamos un usuario por ID
function buscarUsuarioPorId(id) {
    // Usamos for...of para buscar
    for (let usuario of usuarios) {
        if (usuario.id === id) {
            return usuario;
        }
    }
    return null;
}

// Con esta función vemos tareas de un usuario
function verTareasUsuario() {
    let id = parseInt(prompt("Ingrese el ID del usuario:"));
    let usuario = buscarUsuarioPorId(id);
    
    // Usamos for in para mostrar propiedades del objeto usuario
    if (usuario) {
        console.log("\nInformación del usuario:");
        for (let prop in usuario) {
            if (prop !== "tareas") {
                console.log(`${prop}: ${usuario[prop]}`);
            }
        }
        
        console.log("\nTareas:");
        if (usuario.tareas.length === 0) {
            console.log("No hay tareas asignadas.");
        } else {
            usuario.tareas.forEach((tarea, index) => {
                console.log(`${index + 1}. ${tarea.descripcion} - ${tarea.estado} (${tarea.fecha || 'Sin fecha'})`);
            });
        }
    } else {
        console.log("Usuario no encontrado.");
    }
}

// Agregamos una nueva tarea
function agregarTarea() {
    let id = parseInt(prompt("Ingrese el ID del usuario:"));
    let usuario = buscarUsuarioPorId(id);
    
    if (usuario) {
        let descripcion = prompt("Ingrese la descripción de la tarea:");
        if (descripcion && descripcion.trim() !== "") {
            usuario.tareas.push({
                descripcion: descripcion.trim(),
                estado: "pendiente",
                fecha: new Date().toISOString().split('T')[0]
            });
            console.log("Tarea agregada correctamente!");
        } else {
            console.log("Error: La descripción no puede estar vacía.");
        }
    } else {
        console.log("Usuario no encontrado."); // Entradas no numericas generan NaN
    }
}

// Con esta función marcamos una tarea como completada
function marcarTareaCompletada() {
    let id = parseInt(prompt("Ingrese el ID del usuario:"));
    let usuario = buscarUsuarioPorId(id);
    
    if (usuario && usuario.tareas.length > 0) {
        verTareasUsuario(id);
        let indice = parseInt(prompt("Ingrese el número de la tarea a marcar como completada:")) - 1;
        
        // Usamos while para validar el índice
        while (indice < 0 || indice >= usuario.tareas.length || isNaN(indice)) {
            console.log("Índice inválido.");
            indice = parseInt(prompt("Ingrese un número válido de tarea:")) - 1;
        }
        
        usuario.tareas[indice].estado = "completada";
        console.log("Tarea marcada como completada!");
    } else {
        console.log("Usuario no encontrado o no tiene tareas.");
    }
}

// Eliminamos tareas
function eliminarTarea() {
    let id = parseInt(prompt("Ingrese el ID del usuario:"));
    let usuario = buscarUsuarioPorId(id);
    
    if (usuario && usuario.tareas.length > 0) {
        verTareasUsuario(id);
        let indice = parseInt(prompt("Ingrese el número de la tarea a eliminar:")) - 1;
        
        if (indice >= 0 && indice < usuario.tareas.length) {
            let tareaEliminada = usuario.tareas.splice(indice, 1);
            console.log(`Tarea "${tareaEliminada[0].descripcion}" eliminada.`);
        } else {
            console.log("Índice inválido.");
        }
    } else {
        console.log("Usuario no encontrado o no tiene tareas.");
    }
}

// Función principal con nuestro menú interactivo
function iniciarPrograma() {
    let opcion;
    
    // Usamos do while para el menú principal
    do {
        mostrarMenu();
        opcion = prompt("Seleccione una opción (1-7):");
        
        // Un switch para manejar las opciones
        switch (opcion) {
            case "1":
                listarUsuarios();
                break;
            case "2":
                agregarUsuario();
                break;
            case "3":
                verTareasUsuario();
                break;
            case "4":
                agregarTarea();
                break;
            case "5":
                marcarTareaCompletada();
                break;
            case "6":
                eliminarTarea();
                break;
            case "7":
                console.log("¡Hasta luego!");
                break;
            default:
                console.log("Opción no válida. Intente otra vez.");
        }
    } while (opcion !== "7");
}

// Iniciamos el programa
iniciarPrograma();