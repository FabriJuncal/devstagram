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
