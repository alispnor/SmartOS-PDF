<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceOrder;
use App\Models\ServiceOrderItem;

class ServiceOrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
 public function run(): void
    {
        $serviceOrder = ServiceOrder::where('os_number', '03372/25')->first();

        if ($serviceOrder) {
            ServiceOrderItem::create([
                'service_order_id' => $serviceOrder->id,
                'item_number'      => 1,
                'description'      => 'EFETUAR SUBSTITUIÇÃO DO TRANSMISSOR DE PRESSÃO DE OLEO LADO DIREITO',
                'team'             => 'André Segato inspector | Thiago Paulucci Dos Santos - inspector',
                'interval'         => null,
                'hours'            => null,
                'cycles'           => null,
            ]);

            ServiceOrderItem::create([
                'service_order_id' => $serviceOrder->id,
                'item_number'      => 2,
                'description'      => 'EFETUAR SUBSTITUIÇÃO PNEU INTERNO DIREITO APRESENTANDO PERDA DE PRESSÃO',
                'team'             => 'André Segato - inspector | Thiago Paulucci Dos Santos - inspector',
                'interval'         => null,
                'hours'            => null,
                'cycles'           => null,
            ]);

            ServiceOrderItem::create([
                'service_order_id' => $serviceOrder->id,
                'item_number'      => 3,
                'description'      => 'AVALIAR JUNTAS DA TAMPA DA NACELE ESQUERDA',
                'team'             => 'André Segato inspector | Thiago Paulucci Dos Santos - inspector',
                'interval'         => null,
                'hours'            => null,
                'cycles'           => null,
            ]);

            ServiceOrderItem::create([
                'service_order_id' => $serviceOrder->id,
                'item_number'      => 4,
                'description'      => '(MSR) AIRFRAME > LUBRICATE ITEMS 6M',
                'team'             => 'André Segato inspector | Thiago Paulucci Dos Santos - inspector',
                'interval'         => '6M',
                'hours'            => 'N/A',
                'cycles'           => 'N/A',
            ]);

            ServiceOrderItem::create([
                'service_order_id' => $serviceOrder->id,
                'item_number'      => 5,
                'description'      => '(MSR) LEFT ENGINE > CHECK AGB INTERNAL SCAVENGE OIL PUMP INLET SCREEN',
                'team'             => 'André Segato - inspector | Thiago Paulucci Dos Santos - inspector',
                'interval'         => '6M',
                'hours'            => '200',
                'cycles'           => 'N/A',
            ]);

            ServiceOrderItem::create([
                'service_order_id' => $serviceOrder->id,
                'item_number'      => 6,
                'description'      => '(MSR) RIGHT ENGINE > CHECK AGB INTERNAL SCAVENGE OIL PUMP INLET SCREEN',
                'team'             => 'André Segato - inspector | Thiago Paulucci Dos Santos - inspector',
                'interval'         => '6M',
                'hours'            => '200',
                'cycles'           => 'N/A',
            ]);

            ServiceOrderItem::create([
                'service_order_id' => $serviceOrder->id,
                'item_number'      => 7,
                'description'      => 'TANQUE DA NACELLE LH DANIFICADO',
                'team'             => 'André Segato inspector | Thiago Paulucci Dos Santos inspector',
                'interval'         => null,
                'hours'            => null,
                'cycles'           => null,
            ]);

            ServiceOrderItem::create([
                'service_order_id' => $serviceOrder->id,
                'item_number'      => 8,
                'description'      => 'BARRAMENTO BUSTIE DIREITO POR VEZES ABRE',
                'team'             => 'Marcio Messias Silva inspector | Silvio Vicente mechanic',
                'interval'         => null,
                'hours'            => null,
                'cycles'           => null,
            ]);

            ServiceOrderItem::create([
                'service_order_id' => $serviceOrder->id,
                'item_number'      => 9,
                'description'      => 'AUDIOS AURAIS DO SISTEMA DE AVIONICS INOPERANTE',
                'team'             => 'Marcio Messias Silva - inspector | Silvio Vicente - mechanic',
                'interval'         => null,
                'hours'            => null,
                'cycles'           => null,
            ]);

            ServiceOrderItem::create([
                'service_order_id' => $serviceOrder->id,
                'item_number'      => 10,
                'description'      => 'EFETUAR SUBSTITUIÇÃO DE UMA PROBE DE COMBUSTIVEL LADO ESQUERDO',
                'team'             => 'André Segato inspector | Thiago Paulucci Dos Santos inspector',
                'interval'         => null,
                'hours'            => null,
                'cycles'           => null,
            ]);

            ServiceOrderItem::create([
                'service_order_id' => $serviceOrder->id,
                'item_number'      => 11,
                'description'      => 'EFETUAR SUBSTITUIÇÃO DE INDICADOR DE COMBUSTIVEL LH E AFERIÇÃO DO SISTEMA',
                'team'             => 'Marcio Messias Silva - inspector | Silvio Vicente mechanic',
                'interval'         => null,
                'hours'            => null,
                'cycles'           => null,
            ]);

            ServiceOrderItem::create([
                'service_order_id' => $serviceOrder->id,
                'item_number'      => 12,
                'description'      => 'VERIFICAR COMANDO DO TRIM QUANTO A INTEGRIDADE',
                'team'             => 'André Segato inspector | Thiago Paulucci Dos Santos - inspector',
                'interval'         => null,
                'hours'            => null,
                'cycles'           => null,
            ]);
        }
    }
}
