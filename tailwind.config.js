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
                gray: {// outer-space
                    "50": "#E5EFF4",
                    "100": "#CADDE6",
                    "200": "#AFCBD8",
                    "300": "#95B9C9",
                    "400": "#7CA6BA",
                    "500": "#6493A9",
                    "600": "#547D91",
                    "700": "#476675",
                    "800": "#394F5A",
                    "900": "#2A3940"
                },
                danger: colors.rose,
                success: colors.green,
                warning: colors.amber,
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
