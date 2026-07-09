import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                beige: {
                    50: '#fdfcf9',
                    100: '#f9f5eb',
                    150: '#f4edd9',
                    200: '#ece0c4',
                    300: '#dcc8a8',
                    400: '#c9ad85',
                    500: '#b8925d',
                    600: '#9e7647',
                    650: '#8a6240',
                    700: '#5c4033',
                    750: '#4a3429',
                    800: '#3e2b22',
                    850: '#2f2019',
                    900: '#241813',
                },
            },

            boxShadow: {
                'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.06), 0 10px 20px -5px rgba(0, 0, 0, 0.03)',
                'soft-lg': '0 5px 30px -8px rgba(0, 0, 0, 0.08), 0 15px 30px -8px rgba(0, 0, 0, 0.04)',
                'inner-soft': 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.04)',
                'premium': '0 1px 3px rgba(0,0,0,0.02), 0 8px 32px -8px rgba(90,64,51,0.08)',
                'premium-lg': '0 1px 3px rgba(0,0,0,0.02), 0 16px 48px -12px rgba(90,64,51,0.12)',
            },

            animation: {
                'fade-in': 'fadeIn 0.5s ease-out',
                'fade-in-up': 'fadeInUp 0.5s ease-out',
                'slide-down': 'slideDown 0.3s ease-out',
            },

            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(12px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideDown: {
                    '0%': { opacity: '0', transform: 'translateY(-8px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
        },
    },

    plugins: [forms],
};
