const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
   content: ['./**/*.{php,html,css}'],
   theme: {
      colors: {
         black: colors.black,
         white: colors.white,
         neutral: colors.neutral,
         gray: colors.gray,
         green: colors.green,
         transparent: colors.transparent,
         slate: colors.slate,
      },
      extend: {
         colors: {
            green: {
               500: '#3A7B4C',
            },
         },
      },
   },
   plugins: [],
}
