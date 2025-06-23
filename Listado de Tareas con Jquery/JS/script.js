        $(document).ready(function() {
            // Evento submit para agregar las tareas
            $("#formulario").submit(function(event) {
                event.preventDefault();
                let tareaTexto = $("#tareaInput").val().trim();
                if (tareaTexto !== "") {
                    // Agregar tarea a la lista
                    $("#listaTareas").append(
                        '<div class="tarea">' +
                            '<span>' + tareaTexto + '</span>' +
                            '<button class="editar">Editar</button>' +
                            '<button class="eliminar">Eliminar</button>' +
                        '</div>'
                    );
                    $("#tareaInput").val(""); // Limpiar el input
                    // Mostrar mensaje con un fadeIn
                    $("#mensaje").fadeIn(500).delay(2000).fadeOut(400);
                }
            });

            /* Damos click a una tarea para marcarla como completada, con la ayuda de nuestr
             CSS se tachara con un color diferente del texto*/
            $(document).on("click", ".tarea span", function() {
                $(this).toggleClass("completada");
            });

            /*Agregamos un evento click para eliminar tareas individualmente
            como se nos pide */
            $(document).on("click", ".eliminar", function() {
                $(this).parent(".tarea").remove();
            });

            // Editamos las tareas
            $(document).on("click", ".editar", function() {
                let tareaSpan = $(this).siblings("span");
                let textoActual = tareaSpan.text();
                // Reemplazar el span que teniamos por input y boton de actualizar
                tareaSpan.replaceWith(
                    '<input type="text" class="editarInput" value="' + textoActual + '">' +
                    '<button class="actualizar">Actualizar</button>'
                );
                $(this).hide(); // Ocultamos el boton editar
            });

            // Actualizamos las tareas individualmente con un evento click
            $(document).on("click", ".actualizar", function() {
                let nuevoTexto = $(this).siblings(".editarInput").val().trim();
                if (nuevoTexto !== "") {
                    let tareaDiv = $(this).parent(".tarea");
                    // Reemplazar el input y boton actualizar por span
                    $(this).siblings(".editarInput").replaceWith('<span>' + nuevoTexto + '</span>');
                    $(this).siblings(".editar").show(); // Mostrar botón editar
                    $(this).remove(); // Eliminar botón actualizar
                    // Mantenemos clase completada si es que ya existia
                    if (tareaDiv.find("span").hasClass("completada")) {
                        tareaDiv.find("span").addClass("completada");
                    }
                }
            });

            // Vaciamos la lista con un evento de doble click
            $("#vaciarLista").dblclick(function() {
                $("#listaTareas").empty();
            });
        });