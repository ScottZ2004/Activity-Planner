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
            'darker-white': 'rgba(220,220,220,0.96)',
            'blue': '#1697B7',
            'lightblue': '#30C3CD',
            'orange': '#E8804C',
            'lightorange': '#E8804C',
            'red': '#FF0000'
        }
    },

    plugins: [require('@tailwindcss/forms')],
};
