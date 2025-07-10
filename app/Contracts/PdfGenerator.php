<?php
namespace App\Contracts;

use Barryvdh\Snappy\PdfWrapper; // Se você retornar a instância do wrapper

interface PdfGenerator
{
    public function generate(string $htmlContent, array $options = []): PdfWrapper;
}