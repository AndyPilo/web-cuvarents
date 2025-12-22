/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "class", // ✅ habilita dark: con clase .dark en <html>
  content: [
    "./*.php", // index.php, etc.
    "./includes/**/*.php", // includes: header, navbar, footer...
    "./src/views/**/*.php", // todas las views
    "./src/controllers/**/*.php",
    "./src/models/**/*.php",
    "./api/**/*.php",
    "./assets/js/**/*.js",
    "./*.html", // por si tienes alguno suelto
  ],
  theme: {
    extend: {
      keyframes: {
        fadeInUp: {
          "0%": { opacity: "0", transform: "translateY(30px)" },
          "100%": { opacity: "1", transform: "translateY(0)" },
        },
        searchMove: {
          "0%": { transform: "translate(0,0) rotate(0deg)" },
          "30%": { transform: "translate(8px,-8px) rotate(8deg)" },
          "60%": { transform: "translate(-8px,8px) rotate(-8deg)" },
          "100%": { transform: "translate(0,0) rotate(0deg)" },
        },
      },
      animation: {
        fadeInUp: "fadeInUp 0.5s ease both",
        searchMove: "searchMove 2.2s ease-in-out infinite",
      },
    },
  },
  plugins: [],
};
