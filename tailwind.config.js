const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['depot-new-web', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
          'white': '#F5F5F5',
          'blue': '#1697B7',
          'lightblue': '#30C3CD',
          'orange': '#E8804C',
          'lightorange': '#E8804C',
        }
    },

    plugins: [require('@tailwindcss/forms')],
};
