import daisyui from 'daisyui'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      backgroundImage: {
        guest: "url('http://localhost:8000/guest.jpg')",
        default: "url('http://localhost:8000/default.png')",
      },
    },
  },
  plugins: [daisyui],
  daisyui: {
    themes: [
      {
        theme: {
          primary: '#ee6c9b',
          secondary: '#090b10',
          accent: '#37cdbe',
          neutral: '#3d4451',
          'base-100': '#313338',
        },
      },
    ],
  },
}
