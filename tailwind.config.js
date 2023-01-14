/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./*.html",
        "./js/*.js",
        "./app/**/*.*",
        "./config/theme.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            }
        },
    },
    plugins: [
        //require('tw-elements/dist/plugin')
    ],
}
