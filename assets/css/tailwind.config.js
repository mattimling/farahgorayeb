/** @type {import('tailwindcss').Config} */

const node = '../../build/node_modules/';
const defaultTheme = require(node + 'tailwindcss/defaultTheme')

// Gap - 160 / 80 / 40 / 20

module.exports = {
	content: [
		'./../assets/css/**/*',
		'./../*.php',
		'./../components/**/*.php',
		'./../pages/**/*.php',
		'./../functions/**/*.php',
		'./../assets/js/**/*.js',
		'!./../assets/css/style.css',
	],
	theme: {
		screens: {
			'xs': '420px',
			...defaultTheme.screens,
			'3xl': '1921px'
		},
		extend: {
			fontFamily: {
				'm': ['m', 'sans-serif'],
				'b': ['b', 'sans-serif'],
			},
			height: {
				// screen: ['100vh', '100svh'],
			},
			minHeight: {
				// screen: ['100vh', '100svh'],
			},
		},
		colors: {
			transparent: 'transparent',
			'black': '#000',
			'white': '#FFF9F3',
			'peach': '#F9D2C2',
			'peachDark': '#F0BBA4',
		},
	},
	plugins: [
	],
}