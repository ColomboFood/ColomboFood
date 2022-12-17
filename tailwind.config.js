const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['DinPro', 'sans'],
                serif: ['RoxboroughCF', 'serif'],
            },
            colors: {
                primary: {// scarlet
                    "50": "#FFCABE",
                    "100": "#FFA995",
                    "200": "#FF876C",
                    "300": "#FF6644",
                    "400": "#FF441B",
                    "500": "#F12C00",
                    "600": "#C62602",
                    "700": "#9C1F03",
                    "800": "#731804",
                    "900": "#4B1003"
                },
                secondary: {// froly
                    '50': '#FFFFFF',
                    '100': '#FFFFFF',
                    '200': '#FEEBEB',
                    '300': '#FBC5C6',
                    '400': '#F99EA1',
                    '500': '#F6787C',
                    '600': '#F24349',
                    '700': '#EE1017',
                    '800': '#B90C12',
                    '900': '#85090D'
                },
                neutral: {// botticelli
                    "50": "#DCE4EE",
                    "100": "#C1CFE0",
                    "200": "#A8BAD1",
                    "300": "#8FA5C1",
                    "400": "#7790B0",
                    "500": "#607C9E",
                    "600": "#526883",
                    "700": "#445468",
                    "800": "#36404E",
                    "900": "#262D35"
                },
                gray: { // black-haze
                    "50": "#E9EBEB",
                    "100": "#D4D7D7",
                    "200": "#C1C2C2",
                    "300": "#ADADAD",
                    "400": "#989898",
                    "500": "#848484",
                    "600": "#707070",
                    "700": "#5B5B5B",
                    "800": "#474747",
                    "900": "#323232"
                },
                danger: colors.rose,
                success: colors.green,
                warning: {// bleach-white
                    "50": "#FEEDD7",
                    "100": "#FCDBB0",
                    "200": "#FAC98A",
                    "300": "#F6B764",
                    "400": "#F2A440",
                    "500": "#ED921C",
                    "600": "#CD7C13",
                    "700": "#A66511",
                    "800": "#804F0F",
                    "900": "#5A380C"
                },
            },
            animation: {
                shine: "shine 1s",
            },
            keyframes: {
                shine: {
                    "100%": { left: "125%" },
                },
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('daisyui'),
    ],

    daisyui: {
        logs: false,
        themes: [
            "bumblebee",
        ],
    },
};
