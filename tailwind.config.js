/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                base: "#064E3B",
                tolol: "#FACC15",
            },
        },
    },
    plugins: [require("daisyui")],
};
