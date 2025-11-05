import forms from '@tailwindcss/forms'; // <-- Import plugin

/** @type {import('tailwindcss').Config} */
export default {
    // INI DIA KUNCINYA:
    darkMode: 'class',

    content: [
        // Path ini penting agar Tailwind memindai semua file Blade Anda
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],

    theme: {
        extend: {
            // Font retro Anda akan kita tambahkan di sini nanti
        },
    },

    plugins: [
        forms, // <-- Gunakan plugin yang di-import
    ],
};