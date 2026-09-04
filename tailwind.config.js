import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['"Source Serif 4"', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                navy: {
                    DEFAULT: '#13294B',
                    dark: '#0B1B33',
                },
                sky: {
                    DEFAULT: '#2D6CDF',
                    light: '#EAF1FD',
                },
                ink: '#101828',
                muted: '#5B6B82',
            },
        },
    },

    plugins: [forms],
};