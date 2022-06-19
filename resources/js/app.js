// Libreria JS para subir imagenes al servidor
// Documentación: https://docs.dropzone.dev/
import Dropzone from "dropzone";

// Si está utilizando una versión anterior a Dropzone 6.0.0,
// entonces necesita deshabilitar el comportamiento de detección automática aquí:
Dropzone.autoDiscover = false;


// Función para subir imagenes al servidor
// 1er Parametro: Elemento HTML que contiene el formulario
// 2do Parametro: Objeto con la configuración
const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false
});

// Evento que se ejecuta cuando esta en proceso la subida de la imagen
// dropzone.on("sending", function(file, xhr, formData) {
//     console.log(formData);
// });

// Evento que se ejecuta cuando se subió la imagen de manera correcta
dropzone.on("success", function (file, response) {
    // Cuando se suba la imagen correctamente, se agrega el nombre de la imagen al input invisible del formulario de Alta de Publicación
    document.querySelector('[name="imagen"]').value = response.imagen;
});

// Evento que se ejecuta cuando se subió la imagen de manera incorrecta
// dropzone.on("error", function (file, message) {
//     console.log(message);
// });

// Evento que se ejecuta cuando se elimina la imagen
dropzone.on("removedfile", function () {
    console.log('Archivo Eliminado');
});
