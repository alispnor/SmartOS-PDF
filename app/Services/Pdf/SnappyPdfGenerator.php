<?php

namespace App\Services\Pdf; // <--- VERIFIQUE ESTE NAMESPACE

use App\Contracts\PdfGenerator;
use Barryvdh\Snappy\Facades\SnappyPdf; // Ou injete Barryvdh\Snappy\PdfWrapper
use Barryvdh\Snappy\PdfWrapper; // Certifique-se de importar o PdfWrapper
use Illuminate\Support\Facades\Log; // Importe o Log

class SnappyPdfGenerator implements PdfGenerator
{
    public function generate(string $htmlContent, array $options = []): PdfWrapper
    {
        $defaultOptions = config('snappy.pdf.options');
        $mergedOptions = array_merge($defaultOptions, $options);

        $pdf = SnappyPdf::loadHTML($htmlContent);

        // Adicione as opções, mas cuidado para não passar opções desconhecidas
        foreach ($mergedOptions as $key => $value) {
            // Certifique-se de que 'tmp' ou 'keep-temp' não estão mais aqui
            // E que as opções são válidas para o Snappy ou wkhtmltopdf
            try {
                $pdf->setOption($key, $value);
            } catch (\InvalidArgumentException $e) {
                Log::warning("SnappyPdfGenerator: Opção inválida passada para Snappy: {$key}. Erro: {$e->getMessage()}");
            }
        }

        // --- Adicionar Logging do Comando Final ---
        // Este é um hack para depurar, pois não há um método público para obter o comando completo facilmente.
        // Você pode precisar ir para o vendor/knplabs/knp-snappy/src/Knp/Snappy/AbstractGenerator.php
        // e adicionar um log lá no método 'execute' ou 'get  Output'.

        // ALTERNATIVA DE DEBUG (mais fácil): Logar as opções que serão passadas
        Log::debug('SnappyPdfGenerator: Opções finais passadas para o PDF:', $mergedOptions);

        try {
            // Se 'keep-temp' está no config/snappy.php, ele deve funcionar.
            // Se ainda não vê os temp files, o problema pode estar na construção do PdfWrapper
            // ou como o wkhtmltopdf lida com os temporários em si.

            // Para forçar a geração de um arquivo de debug para o cabeçalho/rodapé
            // O wkhtmltopdf os cria como temporários de qualquer forma para o comando
            // principal. O problema é que eles podem ser apagados ou não criados se o wkhtmltopdf falhar.

            return $pdf;
        } catch (\Exception $e) {
            Log::error('SnappyPdfGenerator: Erro ao gerar PDF com wkhtmltopdf.', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'options_sent' => $mergedOptions
            ]);
            throw $e; // Relança a exceção para que o controlador a capture
        }
    }
}