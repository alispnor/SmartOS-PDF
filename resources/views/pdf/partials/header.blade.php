<div style="width: 100%; font-family: Arial, sans-serif; font-size: 8pt; box-sizing: border-box; padding: 0 1cm;">
    <div id="full-header-content" style="
        display: flex; /* Mantém flex para o layout interno */
        justify-content: space-between;
        align-items: flex-end;
        padding-top: 10px;
        padding-bottom: 5px;
        border-bottom: 1px solid #000;
        margin-bottom: 5px;
        height: auto; /* Deixa a altura se ajustar ao conteúdo */
        overflow: visible; /* Garante que nada seja cortado */
        /* Removido position: absolute para evitar conflitos de fluxo, se você o tinha */
    ">
        <div style="text-align: center; font-family: Arial, sans-serif; font-size: 10pt; background-color: #f0f0f0; padding: 5px; border-bottom: 1px solid black;">
            <img src="file:///home/ali/Projetos/SmartOS-PDF/public/images/mtx_logo.png" alt="MTX Aviation Logo" style="height: 30px; display: block; margin: 0 auto 5px auto;">
            <p style="margin: 0;">MTX Aviation - Ordem de Serviço #{{ $serviceOrder->os_number }}</p>
            <p style="margin: 0; font-size: 8pt;">Documento Ref: {{ $serviceOrder->document_reference }}</p>
        </div>
        <div style="width: 45%; text-align: right;">
            <p style="margin: 0; font-size: 14pt; font-weight: bold;">OS #{{ $serviceOrder->os_number }}</p>
            <p style="margin: 0;">{{ $serviceOrder->document_reference }}</p>
            <p style="margin: 0;">{{ \Carbon\Carbon::parse($serviceOrder->document_date)->format('d/m/Y') }}</p>
            <p style="margin: 0; margin-top: 5px;">PP-JCA</p>
            <p style="margin: 0;">Data de Início: {{ \Carbon\Carbon::parse($serviceOrder->start_date)->format('d/m/Y') }}</p>
            <p style="margin: 0;">Término Previsto: {{ \Carbon\Carbon::parse($serviceOrder->end_date)->format('d/m/Y') }}</p>
        </div>
    </div>

    <div id="subsequent-page-spacer" style="height: 1cm; background-color: transparent;"></div>

    <script>
        var fullHeader = document.getElementById('full-header-content');
        var spacer = document.getElementById('subsequent-page-spacer');

        if (fullHeader && spacer) {
            if (typeof page !== 'undefined' && page > 1) {
                // Se for uma página subsequente: esconde o cabeçalho completo, mostra o espaçador
                fullHeader.style.display = 'none';
                spacer.style.display = 'block'; // Usar 'block' para o espaçador é mais seguro
            } else {
                // Se for a primeira página: mostra o cabeçalho completo, esconde o espaçador
                fullHeader.style.display = 'flex';
                spacer.style.display = 'none';
            }
        }
    </script>
</div>