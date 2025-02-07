/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/js/**/*.{html,js,jsx,ts,tsx}", // Tailwind will look for class names in React files
    "./resources/views/**/*.blade.php", // Include Blade files
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

