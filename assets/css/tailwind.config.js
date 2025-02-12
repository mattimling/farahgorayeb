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
				'nr': ['nr', 'sans-serif'],
				'nri': ['nri', 'sans-serif'],
				'nh': ['nh', 'sans-serif'],
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
			'charcoal': '#0A1612',
			'gray1': '#C6C6C6', // Web
			'gray2': '#DCDCDC',
			'gray3': '#F8F7F7', // Light
			'white': '#fff',
			'gold': '#D6A159',
		},
	},
	plugins: [
	],
}