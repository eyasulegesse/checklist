import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
        spacing: {
            appBigSpace: ["40px"],
            appMiddeumSpace: ["30px"],
            appSmallSize: ["20px"],
            appExtrasmall: ["10px"],
        },
        colors: {
            appfirstColor: ["#164863"],
            appSecondColor: ["#427D9D"],
            appWhiteColor: ["#fff"],
        },
    },

    plugins: [forms, typography],
};
