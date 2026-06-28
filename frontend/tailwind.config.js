/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './index.html',
    './src/**/*.{vue,js}',
  ],
  safelist: [
    'bg-brand-dark',
    'bg-brand-darkest',
    'bg-brand-medium',
    'bg-brand-light',
    'bg-brand-gray',
    'text-brand-dark',
    'text-brand-darkest',
    'text-brand-medium',
    'text-brand-light',
    'text-brand-gray',
    'border-brand-dark',
    'border-brand-medium',
    'border-brand-light',
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          darkest: '#16425B',
          dark:    '#2F6690',
          medium:  '#3A7CA5',
          light:   '#81C3D7',
          gray:    '#D9DCD6',
        },
      },
      fontFamily: {
        heading: ['Playfair Display', 'serif'],
        body:    ['DM Sans', 'sans-serif'],
      },
    },
  },
  plugins: [],
}