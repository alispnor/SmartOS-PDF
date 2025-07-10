<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ordem de Serviço #{{ $serviceOrder->os_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 9pt;
            line-height: 1.2;
        }

        /* Define margens padrão para todas as páginas no conteúdo principal */
        /* O header-html e footer-html ocuparão o espaço das margens superior e inferior */
        @page {
           margin: 0;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px; /* Espaçamento entre tabelas/seções */
        }
        th, td {
            border: 1px solid #000;
            padding: 3px 5px; /* Ajuste o padding para replicar o layout */
            text-align: left;
            vertical-align: top; /* Crucial para o conteúdo dinâmico e manter o layout */
        }
        th {
            background-color: #f0f0f0;
        }

        /* Títulos de seção com borda conforme o PDF */
        h2 {
            font-size: 11pt;
            margin-top: 15px;
            margin-bottom: 5px;
            text-align: center;
            border: 1px solid #000;
            padding: 2px 0;
            text-transform: uppercase;
        }

        /* Regras de quebra de página para elementos importantes */
        .no-break {
            page-break-inside: avoid; /* Garante que tabelas ou blocos importantes não sejam quebrados no meio */
        }

        /* Estilo para cada item de serviço individual para controle de quebra */
        .service-item-block {
            page-break-inside: avoid;
            margin-bottom: 5px; /* Espaçamento entre os itens de serviço */
            padding-bottom: 2px; /* Pequeno padding para garantir quebra limpa */
        }
        .service-item-block strong {
            display: inline-block; /* Para o número do item, seguido da descrição */
            min-width: 20px; /* Alinhar números de itens */
        }

        /* Estilos específicos para a tabela de dados da aeronave (baseado no PDF) */
        .aircraft-data-table td:nth-child(1) { width: 18%; } /* AIRFRAME, LEFT ENGINE etc. */
        .aircraft-data-table td:nth-child(2) { width: 52%; } /* Conteúdo principal (Modelo, Fabricante, SN, etc.) */
        .aircraft-data-table td:nth-child(3) { width: 30%; } /* Última coluna (Ano de Fabricação, CSO) */
    </style>
</head>
<body>
    <div class="content-wrapper">
        <h2>DADOS DA AERONAVE</h2>
        <section class="no-break">
            <table class="aircraft-data-table">
                <tbody>
                    @php
                        $aircraftTypes = [
                            'AIRFRAME', 'LEFT_ENGINE', 'RIGHT_ENGINE',
                            'LEFT_PROPELLER', 'RIGHT_PROPELLER'
                        ];
                    @endphp
                    @foreach($aircraftTypes as $type)
                        @php
                            $part = $aircraftParts->get($type)?->first();
                        @endphp
                        <tr>
                            <td rowspan="2">{{ str_replace('_', ' ', $type) }}</td>
                            <td>
                                @if($part)
                                    Modelo: {{ $part->model ?? 'N/A' }}<br>
                                    Fabricante: {{ $part->manufacturer ?? 'N/A' }}<br>
                                    SN: {{ $part->sn ?? 'N/A' }}<br>
                                    CSN: {{ $part->csn ?? 'N/A' }}<br>
                                    TSO: {{ $part->tso ?? 'N/A' }}<br>
                                    TSN: {{ $part->tsn ?? 'N/A' }}<br>
                                    Revisão: Manual:{{ $part->revision_manual ?? 'N/A' }} / Revision: {{ $part->revision_pn ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($part)
                                    Ano de Fabricação: {{ $part->manufacture_year ?? 'N/A' }}<br>
                                    CSO: {{ $part->cso ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border-top: none;"></td> </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <h2>RESUMO DE ITENS EXECUTADOS</h2>
        <section>
            @foreach($serviceItems as $item)
                <div class="service-item-block">
                    <strong>{{ $item->item_number }}</strong> {{ $item->description }}<br>
                    @if(!empty($item->interval) || !empty($item->hours) || !empty($item->cycles))
                        Intervalo: {{ $item->interval ?? 'N/A' }} | Horas: {{ $item->hours ?? 'N/A' }} | Ciclos: {{ $item->cycles ?? 'N/A' }}<br>
                    @endif
                    Equipe: {{ $item->team }}
                </div>
            @endforeach
        </section>

        <h2 style="margin-top: 30px;">DECLARAÇÃO DE AERONAVEGABILIDADE</h2>
        <section class="no-break">
            <p>Declaro para os fins de direito, que os serviços de manutenção acima discriminados, foram executados de acordo com os dados técnicos aprovados pelas autoridades aeronáuticas aplicáveis e são aeronavegáveis sob as condições estipuladas no Certificado de Aeronavegabilidade.</p>
            <div style="margin-top: 50px;">
                <p>Assinatura do Inspetor Responsável: ____________________________</p>
                <p style="margin-top: 10px;">SDCO: ____________________________</p>
            </div>
        </section>
    </div>
</body>
</html>