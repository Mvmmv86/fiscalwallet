import defaultTheme from 'tailwindcss/defaultTheme';

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
            },
            colors: {
                primary: {
                    50: '#FAF5FF',
                    100: '#F3E8FF',
                    200: '#E9D5FF',
                    300: '#D8B4FE',
                    400: '#C084FC',
                    500: '#A855F7',
                    600: '#9333EA',
                    700: '#7C3AED',
                    800: '#6B21A8',
                    900: '#581C87',
                },
                success: {
                    50: '#F0FDF4',
                    100: '#DCFCE7',
                    200: '#BBF7D0',
                    300: '#86EFAC',
                    400: '#4ADE80',
                    500: '#22C55E',
                    600: '#16A34A',
                    700: '#15803D',
                    800: '#166534',
                    900: '#14532D',
                },
                danger: {
                    50: '#FEF2F2',
                    100: '#FEE2E2',
                    200: '#FECACA',
                    300: '#FCA5A5',
                    400: '#F87171',
                    500: '#EF4444',
                    600: '#DC2626',
                    700: '#B91C1C',
                    800: '#991B1B',
                    900: '#7F1D1D',
                },
                warning: {
                    50: '#FFFBEB',
                    100: '#FEF3C7',
                    200: '#FDE68A',
                    300: '#FCD34D',
                    400: '#FBBF24',
                    500: '#F59E0B',
                    600: '#D97706',
                    700: '#B45309',
                    800: '#92400E',
                    900: '#78350F',
                },
                surface: '#FFFFFF',
                background: '#F8F8FA',
                border: '#DDD8E1',
                sidebar: {
                    bg: '#F8F8FA',
                    hover: '#F3E8FF',
                    active: '#9333EA',
                },
            },
            fontSize: {
                'display': ['32px', { lineHeight: '1.2', fontWeight: '700' }],
                'h1': ['24px', { lineHeight: '1.3', fontWeight: '600' }],
                'h2': ['20px', { lineHeight: '1.4', fontWeight: '600' }],
                'h3': ['18px', { lineHeight: '1.4', fontWeight: '600' }],
                'body-lg': ['16px', { lineHeight: '1.5', fontWeight: '400' }],
                'body': ['14px', { lineHeight: '1.5', fontWeight: '400' }],
                'body-sm': ['12px', { lineHeight: '1.5', fontWeight: '400' }],
                'caption': ['11px', { lineHeight: '1.4', fontWeight: '500' }],
            },
            spacing: {
                '4.5': '18px',
                '13': '52px',
                '15': '60px',
                '18': '72px',
                '22': '88px',
            },
            borderRadius: {
                'sm': '4px',
                'DEFAULT': '8px',
                'md': '12px',
                'lg': '16px',
                'xl': '24px',
            },
            boxShadow: {
                'card': '0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06)',
                'elevated': '0 4px 6px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06)',
                'modal': '0 20px 25px rgba(0, 0, 0, 0.15), 0 10px 10px rgba(0, 0, 0, 0.04)',
            },
            width: {
                'sidebar': '240px',
            },
            height: {
                'header': '64px',
            },
            maxWidth: {
                'content': '1440px',
            },
        },
    },

    plugins: [],
};
