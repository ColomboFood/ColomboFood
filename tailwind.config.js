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
                    "400": "#FF441B",
                    "500": "#F12C00",
                    "600": "#C62602",
                    "900": "#4B1003"
                },
                secondary: {// froly
                    "50": "#FCC3C5",
                    "400": "#FA9DA0",
                    "500": "#F6787C",//
                    "600": "#F25459",
                    "900": "#B6151A",
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
