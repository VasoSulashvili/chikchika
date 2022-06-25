/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./modules/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "nt-polar-0": "#2E3440",
                "nt-polar-1": "#3B4252",
                "nt-polar-2": "#434C5E",
                "nt-polar-3": "#4C566A",
                "nt-snow-0": "#FFFFFF",
                "nt-snow-1": "#D8DEE9",
                "nt-snow-2": "#E5E9F0",
                "nt-snow-3": "#ECEFF4",
                "nt-frost-0": "#8FBCBB",
                "nt-frost-1": "#88C0D0",
                "nt-frost-2": "#81A1C1",
                "nt-frost-3": "#5E81AC",
                "nt-aurora-0": "#BF616A",
                "nt-aurora-1": "#D08770",
                "nt-aurora-2": "#EBCB8B",
                "nt-aurora-3": "#A3BE8C",
                "nt-aurora-4": "#B48EAD",
            },
        },
    },
    plugins: [],
};
