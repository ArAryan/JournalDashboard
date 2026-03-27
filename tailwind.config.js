/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.php",
    "./templates/**/*.php",
    "./src/ts/**/*.ts"
  ],
  theme: {
    extend: {
      fontFamily: {
        'roboto': ['"Roboto Flex"', 'sans-serif'],
      },
      colors: {
        'journal-primary': '#1e293b',   // Minimalist slate
        'journal-secondary': '#4f46e5', // Clinical indigo
        'journal-accent': '#0ea5e9',    // Scholarly sky
      },
    },
  },
  plugins: [],
}
