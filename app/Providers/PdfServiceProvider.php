<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\PdfGenerator; // Importe a interface
use App\Services\Pdf\SnappyPdfGenerator; // Importe a implementação concreta


class PdfServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Vincula a interface PdfGenerator à sua implementação SnappyPdfGenerator
        // Isso diz ao Laravel: "Quando alguém pedir uma PdfGenerator, dê uma SnappyPdfGenerator"
        $this->app->bind(PdfGenerator::class, SnappyPdfGenerator::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
