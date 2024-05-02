/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "node_modules/preline/dist/*.js",
  ],
  darkMode: 'class', // Esta linea habilita el modo oscuro
  theme: {
    extend: {},
  },
  plugins: [
    require("preline/plugin")
  ],
}
