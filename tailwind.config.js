/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.html",
    "./js/*.js",
    "./src/Views/**/*.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Albert Sans', '"Open Sans"', 'Raleway', 'sans-serif'],
      }
    },
  },
  plugins: [
    // require ('@tailwindcss/typography'),
    // require ('@tailwindcss/forms'),
  ],
}
