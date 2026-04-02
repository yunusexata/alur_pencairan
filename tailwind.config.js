/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    corePlugins: {
        preflight: false, // ⭐ prevent Bootstrap conflict
    },

    darkMode: "class",

    theme: {
        extend: {
            colors: {
                primary: "#2563EB",
                "primary-dark": "#1d4ed8",
                "primary-light": "#3b82f6",
                "background-light": "#F3F4F6",
                "background-dark": "#0f172a",
                "surface-light": "#FFFFFF",
                "surface-dark": "#1e293b",
                "text-primary-light": "#111827",
                "text-primary-dark": "#F9FAFB",
                "text-secondary-light": "#6B7280",
                "text-secondary-dark": "#9CA3AF",
                "accent-green": "#10B981",
                "accent-red": "#EF4444",
            },

            fontFamily: {
                sans: ["Inter", "sans-serif"],
                display: ["Inter", "sans-serif"],
            },

            borderRadius: {
                DEFAULT: "0.5rem",
                xl: "1rem",
                "2xl": "1.5rem",
            },

            boxShadow: {
                soft: "0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03)",
                glow: "0 0 15px rgba(37,99,235,0.3)",
            },
        },
    },

    plugins: [],
};