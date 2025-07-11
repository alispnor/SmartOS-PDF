<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        /* Estilos CSS para o rodapé */
        body { margin: 0; padding: 0; }
        .footer-container {
            width: 100%;
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 8pt;
            border-top: 1px solid #ccc;
            padding-top: 5px;
            padding-bottom: 5px;
            box-sizing: border-box;
            padding-left: 1cm;
            padding-right: 1cm;
        }
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .float-left { float: left; }
        .float-right { float: right; }
    </style>
</head>
<body>
    <div class="footer-container">
        <div class="footer-content">
            <span class="float-left">{{ $serviceOrder->document_reference }}</span>
            <span class="float-right">Página <span class="page"></span> de <span class="topage"></span></span>
        </div>
    </div>
    </body>
</html>