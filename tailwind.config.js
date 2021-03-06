module.exports = {
  // En "content:" se definen los archivos que se van a escanear para generar el CSS de Tailwind
  content: [
      "./resources/**/*.blade.php", // Hace referencia a todos los archivos blade que se encuentren en la carpeta resource
      "./resources/**/*.js", // Hace referencia a todos los archivos js que se encuentren en la carpeta resource
      "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
    ],
  theme: {
    extend: {},
  },
  plugins: [],
}
