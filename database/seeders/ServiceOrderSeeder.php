<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceOrder;
use Carbon\Carbon; // Para trabalhar com datas

class ServiceOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function run(): void
    {
        ServiceOrder::create([
            'os_number'                 => '03372/25', // OS #03372/25
            'aircraft_registration'     => 'PP-JCA', // PP-JCA
            'start_date'                => Carbon::createFromFormat('d/m/Y', '09/06/2025')->format('Y-m-d'), // Data de Início: 09/06/2025
            'end_date'                  => Carbon::createFromFormat('d/m/Y', '20/06/2025')->format('Y-m-d'), // Término Previsto: 20/06/2025
            'document_reference'        => 'F.TEC.015.REV03', // F.TEC.015.REV03
            'document_date'             => Carbon::createFromFormat('d/m/Y', '15/07/2024')->format('Y-m-d'), // 15/07/2024
            'declaration_text'          => 'Declaro para os fins de direito, que os serviços de manutenção acima discriminados, foram executados de acordo com os dados técnicos aprovados pelas autoridades aeronáuticas aplicáveis e são aeronavegáveis sob as condições estipuladas no Certificado de Aeronavegabilidade.', // Conteúdo da Declaração de Aeronavegabilidade
            'responsible_inspector_signature' => 'Assinatura do Inspetor Responsável', // Assinatura do Inspetor Responsável
            'sdco'                      => 'SDCO', // SDCO
            'company_name'              => 'MTX Aviation Manutenção De Aeronaves Ltda', // MTX Aviation Manutenção De Aeronaves Ltda
            'company_location'          => 'Sorocaba/SP', // Sorocaba/SP
            'company_anac_code'         => 'COM 201306-41/ANAC', // COM 201306-41/ANAC
            'company_com_number'        => 'COM 201306-41', // COM 201306-41
        ]);
    }
}
