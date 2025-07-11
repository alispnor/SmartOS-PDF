<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; font-size: 8pt; }

        /* Container da tabela principal do cabeçalho */
        .header-main-table {
            width: 100%;
            border-collapse: collapse; /* Remove espaçamento entre células */
            border: 1px solid #adadad; /* Borda externa do cabeçalho, se houver no original */
            box-sizing: border-box;
            padding: 0; /* Remover padding aqui, o padding será nas células */
           
        }
       

        .header-main-table td {
            border: 1px solid #adadad; /* Bordas internas das células */
            padding: 5px; /* Padding interno das células */
            vertical-align: top; /* Alinha o conteúdo ao topo da célula */
        }

        /* Linha Superior */
        .header-top-row-td {
            height: 80px; /* Altura fixa para a linha superior, ajuste conforme o PDF original */
        }

        .header-top-row-td .col-logo {
            width: 20%; /* Largura para o logo */
            text-align: left;
        }

        .header-top-row-td .col-center-info {
            width: 55%; /* Largura para info da empresa */
            text-align: center;
            font-size: 11pt;
            font-weight: bold;
        }
          .header-top-row-td .col-center-info-title {
             text-align: center;
            font-size: 14pt;
            font-weight: bold;
        }
         .header-top-row-td .col-center-info-sub-title {
            text-align: center;
            font-size: 11pt;
        }

        .header-top-row-td .col-right-info {
            width: 25%; /* Largura para referência/datas */
            text-align: right;
            font-size: 11pt;
            line-height: 1.2; /* Espaçamento entre linhas */
        }

        /* Imagem do Logo */
        .col-logo img {
            height: 70px; /* Aumentado para 70px para o logo maior */
            display: block;
            margin: 0; /* Remove margens extras */
        }

        /* Linha Inferior */
        .header-bottom-row-td {
            height: 30px; /* Altura fixa para a linha inferior, ajuste conforme o PDF original */
        }
        .header-bottom-row-td .col-os-number {
            width: 50%;
            text-align: left;
            
        }
        .header-bottom-row-td .col-aircraft-reg {
            width: 50%;
            text-align: right;
            font-size: 14pt;
            font-weight: bold;
        }

        /* Outros estilos para parágrafos no cabeçalho */
        .header-main-table p {
            margin: 0; /* Remove margens padrão dos parágrafos */
        }

        /* Espaçador para páginas subsequentes (será controlado pelo JS) */
        .spacer {
            height: 1cm; /* Altura do espaçador */
            background-color: transparent;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <table class="header-main-table">
            <tr>
                <td class="header-top-row-td col-logo">
                    <img src="file://{{ public_path('images/mtx_logo.png') }}" alt="MTX Aviation Logo">
                </td>
                <td class="header-top-row-td col-center-info">
                    <p class="col-center-info-title">MTX Aviation Manutenção De Aeronaves Ltda</p>
                    <p class="col-center-info-sub-title">Sorocaba/SP COM 201306-41/ANAC</p>
                </td>
                <td class="header-top-row-td col-right-info">
                    <p>{{ $serviceOrder->document_reference }}</p>
                    <p>{{ \Carbon\Carbon::parse($serviceOrder->document_date)->format('d/m/Y') }}</p>
                </td>
            </tr>
           
        </table>

        </div>

    <div id="subsequent-page-spacer" class="spacer" style="display: none;"></div>

    <script>
        // O JavaScript para controlar a visibilidade da tabela principal do cabeçalho por página
        var fullHeaderTable = document.querySelector('.header-main-table'); // Seleciona a tabela
        var spacer = document.getElementById('subsequent-page-spacer');

        if (fullHeaderTable && spacer) {
            if (typeof page !== 'undefined' && page > 1) {
                // Páginas subsequentes: esconde a tabela do cabeçalho, mostra o espaçador
                fullHeaderTable.style.display = 'none';
                spacer.style.display = 'block';
            } else {
                // Primeira página: mostra a tabela do cabeçalho, esconde o espaçador
                fullHeaderTable.style.display = 'table'; // Exibe como tabela
                spacer.style.display = 'none';
            }
        }
    </script>
</body>
</html>