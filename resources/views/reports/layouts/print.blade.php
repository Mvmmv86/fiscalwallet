@props(['title' => 'Relatório'])

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - Fiscal Wallet</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:200,400,500,600,700&display=swap" rel="stylesheet" />

    <style>
        /* Reset e Base */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --primary: #9333EA;
            --primary-light: #A855F7;
            --success: #22C55E;
            --success-light: #4ADE80;
            --danger: #EF4444;
            --warning: #F59E0B;
            --gray-50: #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-300: #D1D5DB;
            --gray-400: #9CA3AF;
            --gray-500: #6B7280;
            --gray-600: #4B5563;
            --gray-700: #374151;
            --gray-800: #1F2937;
            --gray-900: #111827;
            --border: #DDD8E1;
            --background: #F8F8FA;
        }

        html {
            font-size: 14px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--gray-900);
            background: white;
            line-height: 1.5;
        }

        /* Tamanho A4 para visualização na tela */
        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 0 auto;
            background: white;
            position: relative;
        }

        .page-content {
            min-height: calc(297mm - 40mm - 30mm); /* Altura total - margens - footer */
        }

        /* Utilitários de Tipografia */
        .text-xs { font-size: 0.75rem; line-height: 1rem; }
        .text-sm { font-size: 0.875rem; line-height: 1.25rem; }
        .text-base { font-size: 1rem; line-height: 1.5rem; }
        .text-lg { font-size: 1.125rem; line-height: 1.75rem; }
        .text-xl { font-size: 1.25rem; line-height: 1.75rem; }
        .text-2xl { font-size: 1.5rem; line-height: 2rem; }
        .text-3xl { font-size: 1.875rem; line-height: 2.25rem; }

        .font-normal { font-weight: 400; }
        .font-medium { font-weight: 500; }
        .font-semibold { font-weight: 600; }
        .font-bold { font-weight: 700; }

        .text-primary { color: var(--primary); }
        .text-success { color: var(--success); }
        .text-danger { color: var(--danger); }
        .text-warning { color: var(--warning); }
        .text-gray-400 { color: var(--gray-400); }
        .text-gray-500 { color: var(--gray-500); }
        .text-gray-600 { color: var(--gray-600); }
        .text-gray-700 { color: var(--gray-700); }
        .text-gray-900 { color: var(--gray-900); }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }

        .uppercase { text-transform: uppercase; }
        .tracking-wide { letter-spacing: 0.025em; }

        /* Utilitários de Layout */
        .flex { display: flex; }
        .inline-flex { display: inline-flex; }
        .grid { display: grid; }
        .block { display: block; }
        .inline-block { display: inline-block; }

        .flex-col { flex-direction: column; }
        .flex-row { flex-direction: row; }
        .items-center { align-items: center; }
        .items-start { align-items: flex-start; }
        .items-end { align-items: flex-end; }
        .justify-between { justify-content: space-between; }
        .justify-center { justify-content: center; }
        .justify-end { justify-content: flex-end; }

        .gap-1 { gap: 0.25rem; }
        .gap-2 { gap: 0.5rem; }
        .gap-3 { gap: 0.75rem; }
        .gap-4 { gap: 1rem; }
        .gap-6 { gap: 1.5rem; }
        .gap-8 { gap: 2rem; }

        .w-full { width: 100%; }
        .w-1\/2 { width: 50%; }
        .w-1\/3 { width: 33.333%; }
        .w-2\/3 { width: 66.666%; }
        .w-1\/4 { width: 25%; }
        .w-3\/4 { width: 75%; }

        /* Espaçamentos */
        .mt-1 { margin-top: 0.25rem; }
        .mt-2 { margin-top: 0.5rem; }
        .mt-3 { margin-top: 0.75rem; }
        .mt-4 { margin-top: 1rem; }
        .mt-6 { margin-top: 1.5rem; }
        .mt-8 { margin-top: 2rem; }
        .mb-1 { margin-bottom: 0.25rem; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-3 { margin-bottom: 0.75rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .mb-8 { margin-bottom: 2rem; }

        .p-2 { padding: 0.5rem; }
        .p-3 { padding: 0.75rem; }
        .p-4 { padding: 1rem; }
        .p-6 { padding: 1.5rem; }
        .px-2 { padding-left: 0.5rem; padding-right: 0.5rem; }
        .px-3 { padding-left: 0.75rem; padding-right: 0.75rem; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .py-1 { padding-top: 0.25rem; padding-bottom: 0.25rem; }
        .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
        .py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
        .py-4 { padding-top: 1rem; padding-bottom: 1rem; }

        /* Bordas e Cards */
        .border { border: 1px solid var(--border); }
        .border-t { border-top: 1px solid var(--border); }
        .border-b { border-bottom: 1px solid var(--border); }
        .border-gray-200 { border-color: var(--gray-200); }
        .rounded { border-radius: 0.25rem; }
        .rounded-lg { border-radius: 0.5rem; }
        .rounded-xl { border-radius: 0.75rem; }
        .rounded-full { border-radius: 9999px; }

        .bg-white { background-color: white; }
        .bg-gray-50 { background-color: var(--gray-50); }
        .bg-gray-100 { background-color: var(--gray-100); }
        .bg-primary { background-color: var(--primary); }
        .bg-primary-light { background-color: rgba(147, 51, 234, 0.1); }
        .bg-success { background-color: var(--success); }
        .bg-success-light { background-color: rgba(34, 197, 94, 0.1); }
        .bg-danger-light { background-color: rgba(239, 68, 68, 0.1); }
        .bg-warning-light { background-color: rgba(245, 158, 11, 0.1); }

        /* Tabelas */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }

        table th {
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--gray-500);
            background-color: var(--gray-50);
        }

        table td {
            font-size: 0.875rem;
            color: var(--gray-700);
        }

        table tbody tr:last-child td {
            border-bottom: none;
        }

        .table-striped tbody tr:nth-child(even) {
            background-color: var(--gray-50);
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-success {
            background-color: rgba(34, 197, 94, 0.1);
            color: #15803D;
        }

        .badge-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: #B91C1C;
        }

        .badge-warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: #B45309;
        }

        .badge-primary {
            background-color: rgba(147, 51, 234, 0.1);
            color: #7C3AED;
        }

        .badge-gray {
            background-color: var(--gray-100);
            color: var(--gray-600);
        }

        /* Cards de KPI */
        .kpi-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 1.25rem;
        }

        .kpi-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .kpi-label {
            font-size: 0.75rem;
            color: var(--gray-500);
            margin-top: 0.25rem;
        }

        /* Separador de seção */
        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary);
            display: inline-block;
        }

        /* Header do documento */
        .document-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .document-header .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .document-header .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--success));
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .document-header .logo-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .document-header .logo-text span {
            color: var(--primary);
        }

        .document-header .info {
            text-align: right;
        }

        /* Footer do documento */
        .document-footer {
            position: absolute;
            bottom: 20mm;
            left: 20mm;
            right: 20mm;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.75rem;
            color: var(--gray-500);
        }

        /* Quebra de página */
        .page-break {
            page-break-after: always;
        }

        .avoid-break {
            page-break-inside: avoid;
        }

        /* Estilos de impressão */
        @media print {
            @page {
                size: A4;
                margin: 0;
            }

            html, body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                padding: 15mm 20mm;
                width: 210mm;
                min-height: 297mm;
                page-break-after: always;
            }

            .page:last-child {
                page-break-after: auto;
            }

            .no-print {
                display: none !important;
            }

            .document-footer {
                bottom: 15mm;
                left: 20mm;
                right: 20mm;
            }

            /* Remove sombras e ajusta cores para impressão */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        /* Barra de ações (só aparece na tela) */
        .print-actions {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 0.75rem;
            z-index: 1000;
        }

        .print-actions button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-print {
            background: var(--primary);
            color: white;
        }

        .btn-print:hover {
            background: var(--primary-light);
        }

        .btn-back {
            background: white;
            color: var(--gray-700);
            border: 1px solid var(--border) !important;
        }

        .btn-back:hover {
            background: var(--gray-50);
        }

        @media print {
            .print-actions {
                display: none;
            }
        }

        /* Visualização no navegador */
        @media screen {
            body {
                background: var(--gray-100);
                padding: 2rem 0;
            }

            .page {
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                margin-bottom: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Barra de ações (só aparece na tela) -->
    <div class="print-actions no-print">
        <button type="button" class="btn-back" onclick="window.history.back()">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar
        </button>
        <button type="button" class="btn-print" onclick="window.print()">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Imprimir / Salvar PDF
        </button>
    </div>

    {{ $slot }}

    <script>
        // Função para formatar moeda
        function formatCurrency(value) {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(value);
        }

        // Função para formatar data
        function formatDate(date) {
            return new Intl.DateTimeFormat('pt-BR').format(new Date(date));
        }

        // Função para formatar número
        function formatNumber(value, decimals = 2) {
            return new Intl.NumberFormat('pt-BR', {
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            }).format(value);
        }
    </script>
</body>
</html>
