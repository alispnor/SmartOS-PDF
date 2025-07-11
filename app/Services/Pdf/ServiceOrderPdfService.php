<?php

namespace App\Services\Pdf;

use App\Contracts\PdfGenerator;
use App\Models\ServiceOrder;
use Illuminate\Support\Facades\View;
use Barryvdh\Snappy\PdfWrapper; // Importe o tipo de retorno esperado da interface
use Illuminate\Support\Facades\Log; // Importe o Log

class ServiceOrderPdfService
{
    protected PdfGenerator $pdfGenerator;

    /**
     * Construtor do serviço.
     * Injeta a implementação de PdfGenerator (ex: SnappyPdfGenerator) via Inversão de Dependência.
     *
     * @param PdfGenerator $pdfGenerator
     */
    public function __construct(PdfGenerator $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    /**
     * Gera o PDF de uma Ordem de Serviço.
     *
     * @param ServiceOrder $order A instância da Ordem de Serviço.
     * @return PdfWrapper A instância do wrapper de PDF para manipulação (inline, download, save).
     */
    public function generateServiceOrderPdf(ServiceOrder $order): PdfWrapper
    {
        // 1. Carregar Dados Relacionados
        // Garante que os relacionamentos necessários estejam carregados para a view.
        $order->load(['aircraftParts', 'serviceItems']);

        // 2. Preparar os Dados para a View
       
        $data = [
            'serviceOrder'  => $order,
            'aircraftParts' => $order->aircraftParts->groupBy('type'),
            'serviceItems'  => $order->serviceItems->sortBy('item_number'), // Garante que os itens estejam na ordem correta
        ];

        // 3. Renderizar os Templates Blade
        // Transforma o template principal (corpo do PDF) em HTML.
        $htmlContent = View::make('pdf.service-order', $data)->render();
          // Geração dos HTMLs de cabeçalho e rodapé
        $headerHtml = $this->getHeaderHtml($order);
        // $headerHtml = View::make('pdf.partials.header_test')->render();
        $footerHtml = $this->getFooterHtml($order);
        //  // Log para ver o conteúdo do HTML gerado para cabeçalho/rodapé
        // Log::debug('ServiceOrderPdfService: HTML do Cabeçalho Gerado:', ['html' => $headerHtml]);
        // Log::debug('ServiceOrderPdfService: HTML do Rodapé Gerado:', ['html' => $footerHtml]);

        // 4. Configurar Opções do wkhtmltopdf
        $options = [
            'print-media-type'       => true,
            'enable-local-file-access' => true,
            'encoding'               => 'UTF-8',
            'no-stop-slow-scripts'   => true,
            'enable-javascript'      => true,
            'header-html'            => $headerHtml,
            'footer-html'            => $footerHtml,
            'margin-top'               => 40, // em mm (4.5cm) - DEVE SER MAIOR QUE A ALTURA REAL DO SEU HEADER HTML
            'margin-bottom'            => 35, // em mm (3.0cm) - DEVE SER MAIOR QUE A ALTURA REAL DO SEU FOOTER HTML
            'margin-left'              => 10, // 1cm
            'margin-right'             => 10, // 1cm
            'header-spacing'         => 5,
            'footer-spacing'         => 5,
            'footer-center'            => '[page] - [topage]',
        ];

        // 5. Delegar a Geração do PDF
        return $this->pdfGenerator->generate($htmlContent, $options);
    }

    /**
     * Retorna o HTML renderizado do template do cabeçalho do PDF.
     *
     * @param ServiceOrder $order
     * @return string
     */
    protected function getHeaderHtml(ServiceOrder $order): string
    {
        return View::make('pdf.partials.header', ['serviceOrder' => $order])->render();
    }

    /**
     * Retorna o HTML renderizado do template do rodapé do PDF.
     *
     * @param ServiceOrder $order
     * @return string
     */
    protected function getFooterHtml(ServiceOrder $order): string
    {
        return View::make('pdf.partials.footer', ['serviceOrder' => $order])->render();
    }
}