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
            border: 1px solid #adadad;
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
            margin-top: -10px;
             height: 30px;
            margin-bottom: 5px;
            text-align: center;
            padding: 20px 0;
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
    
        .aircraft-data-table{
               border: 1px solid #adadad;
        }
        
        /* Estilos específicos para a tabela de dados da aeronave (baseado no PDF) */
        .aircraft-data-table td:nth-child(1) { width: 20%; } /* AIRFRAME, LEFT ENGINE etc. */
        .aircraft-data-table td:nth-child(2) { width: 54%; border: none;} /* Conteúdo principal (Modelo, Fabricante, SN, etc.) */
        .aircraft-data-table td:nth-child(3) { width: 30%; border: none; } /* Última coluna (Ano de Fabricação, CSO) */
        
        .aircraft-data-table-end {
            border: none;
            height: 50px;
            width: 100%;
            
        }
        .aircraft-data-table-end td:nth-child(1) {   border: none; text-align: center; padding-top:20px; } 
        .aircraft-data-table-end td:nth-child(2) {   border: none; text-align: center; padding-top:20px;} 

        .aircraft-itensa-table{
            border: 1px solid #adadad;
            width: 100%;
        }

         .aircraft-data-table td:nth-child(1) { width: 10%; } 
        .aircraft-data-table td:nth-child(2) { width: 90%; border: none;}
        
         .header-seconde-table{
            width: 100%;
            border-collapse: collapse; /* Remove espaçamento entre células */
            border: none; /* Borda externa do cabeçalho, se houver no original */
            box-sizing: border-box;
            padding: 10px; /* Remover padding aqui, o padding será nas células */
            font-size: 14pt;
            font-weight: bold;
        }
        .header-seconde-table td:nth-child(1) {   border: none; text-align: center; padding-top:20px; } 
        .header-seconde-table td:nth-child(2) {   border: none; text-align: center; padding-top:20px;} 
        </style>
</head>
<body>
    <div class="content-wrapper">
        <!-- <h2>DADOS DA AERONAVE</h2> -->
        <section class="no-break">
         <table class="header-seconde-table">
            <tbody>
                <tr>
                   <td >
                       OS #{{ $serviceOrder->os_number }}
                   </td>
                   <td >
                       {{ $serviceOrder->aircraft_registration }}
                   </td>
               </tr>
         </body>
        </table>
    </section>
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
                            <td rowspan="2"><strong>{{ str_replace('_', ' ', $type) }}</strong></td>
                            <td>
                                @if($part)
                                    <strong>Modelo:</strong> {{ $part->model ?? 'N/A' }}<br>
                                    <strong>Fabricante: </strong>{{ $part->manufacturer ?? 'N/A' }}<br>
                                    <strong>SN:</strong> {{ $part->sn ?? 'N/A' }}<br>
                                   <strong> CSN: </strong>{{ $part->csn ?? 'N/A' }}<br>
                                    <strong>TSO:</strong> {{ $part->tso ?? 'N/A' }}<br>
                                    <strong>TSN: </strong>{{ $part->tsn ?? 'N/A' }}<br>
                                    <strong>Revisão:</strong> Manual:{{ $part->revision_manual ?? 'N/A' }} / Revision: {{ $part->revision_pn ?? 'N/A' }}
                                @else
                                   <strong> N/A</strong>
                                @endif
                            </td>
                            <td>
                                @if($part)
                                    <strong>Ano de Fabricação: </strong>{{ $part->manufacture_year ?? 'N/A' }}<br>
                                   <strong> CSO: </strong>{{ $part->cso ?? 'N/A' }}
                                @else
                                    <strong>N/A</strong>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border-top: none;"></td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </section>
            <section class="no-break">
            <table class="aircraft-data-table-end">
            <tr>
                   <td >
                          <strong>Data de Início:</strong> {{ \Carbon\Carbon::parse($serviceOrder->start_date)->format('d/m/Y') }}
                   </td>
                   <td >
                        <strong>Término Previsto:</strong> {{ \Carbon\Carbon::parse($serviceOrder->end_date)->format('d/m/Y') }}
                   </td>
               </tr>
        </table>
        </section>

        <h2>RESUMO DE ITENS EXECUTADOS</h2>
        <section>
            <table class="aircraft-itensa-table">
                 <tbody>
            @foreach($serviceItems as $item)
            <tr>
                <td>
                    <strong>{{ $item->item_number }}</strong>
                </td>
                <td>
                    <div class="service-item-block">
                         <strong>{{ $item->description }}</strong><br>
                        @if(!empty($item->interval) || !empty($item->hours) || !empty($item->cycles))
                            <strong>Intervalo:</strong> {{ $item->interval ?? 'N/A' }} | <strong>Horas:</strong> {{ $item->hours ?? 'N/A' }} | <strong>Ciclos:</strong> {{ $item->cycles ?? 'N/A' }}<br>
                        @endif
                        <strong>Equipe:</strong> {{ $item->team }}
                    </div>
                </td>
                    </tr>
            @endforeach
            </tbody>
            </table>
        </section>

        <h2 style="margin-top: 30px; ">DECLARAÇÃO DE AERONAVEGABILIDADE</h2>
        <section class="no-break">
            <p>Declaro para os fins de direito, que os serviços de manutenção acima discriminados, foram executados de acordo com os dados técnicos aprovados pelas autoridades aeronáuticas aplicáveis e são aeronavegáveis sob as condições estipuladas no Certificado de Aeronavegabilidade.</p>
            <div style="margin-top: 50px;">
                <p>Assinatura do Inspetor Responsável: ____________________________</p>
                <p style="margin-top: 30px;">SDCO: ____________________________</p>
            </div>
        </section>
    </div>
</body>
</html>