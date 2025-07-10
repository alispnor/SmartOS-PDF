<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use App\Services\Pdf\ServiceOrderPdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceOrderController extends Controller
{
    protected $serviceOrderPdfService;

    public function __construct(ServiceOrderPdfService $serviceOrderPdfService)
    {
        $this->serviceOrderPdfService = $serviceOrderPdfService;
        Log::info('ServiceOrderController: Construtor chamado.');
    }

    public function generatePdf(ServiceOrder $serviceOrder)
    {
        // Logar que a requisição chegou a este método
        Log::info('ServiceOrderController: Método generatePdf chamado.', [
            'serviceOrderId' => $serviceOrder->id,
            'osNumber' => $serviceOrder->os_number
        ]);
        try {
            // Isso retornará uma instância de PdfWrapper do Snappy
            $pdf = $this->serviceOrderPdfService->generateServiceOrderPdf($serviceOrder);

            // Para exibir o PDF no navegador:
            return $pdf->inline('os-' . $serviceOrder->os_number . '.pdf');

            // Para fazer o download direto:
            // return $pdf->download('os-' . $serviceOrder->os_number . '.pdf');

            // Para salvar em um arquivo:
            // $pdf->save(storage_path('app/public/os/' . $serviceOrder->os_number . '.pdf'));
            // return response()->json(['message' => 'PDF gerado com sucesso!']);
        } catch (\Exception $e) {
            // Logar qualquer erro que ocorra durante a geração do PDF
            Log::error('ServiceOrderController: Erro ao gerar PDF.', [
                'serviceOrderId' => $serviceOrder->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString() // Para detalhes completos do erro
            ]);
            // Você pode retornar uma mensagem de erro amigável ao usuário
            return response('Erro interno ao gerar o PDF.', 500);
        }
    }
    public function generatePdfTest($id)
    {
        Log::info("Chegou em generatePdfTest com ID: " . $id);
        // Tente buscar a ServiceOrder manualmente para ver se o problema é o modelo
        $serviceOrder = ServiceOrder::find($id);

        if (!$serviceOrder) {
            Log::warning("ServiceOrder com ID {$id} não encontrada.");
            return response('Ordem de Serviço não encontrada.', 404);
        }

        Log::info("ServiceOrder encontrada: " . $serviceOrder->os_number);
        // Remova o código de geração de PDF por enquanto, apenas para testar o log
        return 'OK: ServiceOrder com ID ' . $id . ' encontrada.';
    }
}
