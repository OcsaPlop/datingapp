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
        login:
          "url('https://i.pximg.net/img-original/img/2020/09/10/21/38/10/84283947_p0.jpg')",
      },
    },
  },
  plugins: [daisyui],
  daisyui: {
    themes: [
      {
        theme: {
          primary: '#ee6c9b',
          secondary: '#f6d860',
          accent: '#37cdbe',
          neutral: '#3d4451',
          'base-100': '#313338',
        },
      },
    ],
  },
}
