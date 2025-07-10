<div style="width: 100%; text-align: center; font-family: Arial, sans-serif; font-size: 8pt; border-top: 1px solid #ccc; padding-top: 5px; padding-bottom: 5px; box-sizing: border-box; padding-left: 1cm; padding-right: 1cm;">
    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
        <span style="float: left;">{{ $serviceOrder->document_reference }}</span>
        <div style="text-align: center; font-family: Arial, sans-serif; font-size: 8pt; border-top: 1px solid black; padding: 5px; background-color: #f0f0f0;">
            Página <span class="page"></span> de <span class="topage"></span>
        </div>
    </div>
    <script>
        // O wkhtmltopdf substitui automaticamente os spans com classes 'page' e 'topage'
        // Não é necessário JavaScript adicional aqui para funcionalidade básica.
    </script>
</div>