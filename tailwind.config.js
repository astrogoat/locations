module.exports = {
    mode: 'jit',
    prefix: 'locations-',
    purge: {
        content: [
            './resources/**/*.blade.php',
            './resources/**/*.js',
        ],
    },
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
        },
    },
    plugins: [
        // require('@tailwindcss/aspect-ratio'),
    ],
}
