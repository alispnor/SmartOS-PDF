<?php

namespace App\Services\Pdf;

use App\Contracts\PdfGenerator;
use Barryvdh\Snappy\Facades\SnappyPdf; // Use o Facade
use Barryvdh\Snappy\PdfWrapper;
use Illuminate\Support\Facades\Log;

class SnappyPdfGenerator implements PdfGenerator
{
    public function generate(string $htmlContent, array $options = []): PdfWrapper
    {
        $defaultOptions = config('snappy.pdf.options');
        $mergedOptions = array_merge($defaultOptions, $options);

        $pdf = SnappyPdf::loadHTML($htmlContent);

        foreach ($mergedOptions as $key => $value) {
            try {
                $pdf->setOption($key, $value);
            } catch (\InvalidArgumentException $e) {
                Log::warning("SnappyPdfGenerator: Opção inválida passada para Snappy: {$key}. Erro: {$e->getMessage()}");
            }
        }

        Log::debug('SnappyPdfGenerator: Opções finais passadas para o PDF:', $pdf->getOptions());

        try {
            return $pdf;
        } catch (\Exception $e) {
            Log::error('SnappyPdfGenerator: Erro ao gerar PDF com wkhtmltopdf.', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'options_sent' => $mergedOptions
            ]);
            throw $e;
        }
    }
}