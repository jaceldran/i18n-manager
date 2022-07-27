/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.html",
    "./js/*.js",
    // "./src/Views/**/*.php",
    "./app/**/*.*",
    "./config/theme.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Roboto', 'sans-serif'],
      }
    },
  },
  plugins: [
    //require('tw-elements/dist/plugin')
  ],
}
