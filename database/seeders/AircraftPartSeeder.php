<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceOrder;
use App\Models\AircraftPart;

class AircraftPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $serviceOrder = ServiceOrder::where('os_number', '03372/25')->first();

        if ($serviceOrder) {
            // AIRFRAME
            AircraftPart::create([
                'service_order_id'   => $serviceOrder->id,
                'type'               => 'AIRFRAME',
                'model'              => 'F90',
                'manufacturer'       => 'BEECH',
                'sn'                 => 'LA-107',
                'csn'                => '10353',
                'tso'                => 'N/A',
                'tsn'                => '9442.7',
                'revision_manual'    => 'CO',
                'revision_pn'        => 'M.M./PN:109-590010-19',
                'manufacture_year'   => '1981',
                'cso'                => 'N/A',
            ]);

            // LEFT ENGINE
            AircraftPart::create([
                'service_order_id'   => $serviceOrder->id,
                'type'               => 'LEFT_ENGINE',
                'model'              => 'PT6A-135',
                'manufacturer'       => 'PRATT & WHITNEY CANADA',
                'sn'                 => 'PCE-92264',
                'csn'                => '10350',
                'tso'                => '2412',
                'tsn'                => '9442.7',
                'revision_manual'    => '49',
                'revision_pn'        => 'M.M./PN:3043512',
                'manufacture_year'   => null,
                'cso'                => '2126',
            ]);

            // RIGHT ENGINE
            AircraftPart::create([
                'service_order_id'   => $serviceOrder->id,
                'type'               => 'RIGHT_ENGINE',
                'model'              => 'PT6A-135',
                'manufacturer'       => 'PRATT & WHITNEY CANADA',
                'sn'                 => 'PCE-92269',
                'csn'                => '10350',
                'tso'                => '2412',
                'tsn'                => '9442.7',
                'revision_manual'    => '49',
                'revision_pn'        => 'M.M./PN:3043512',
                'manufacture_year'   => null,
                'cso'                => '2126',
            ]);

            // LEFT PROPELLER
            AircraftPart::create([
                'service_order_id'   => $serviceOrder->id,
                'type'               => 'LEFT_PROPELLER',
                'model'              => 'HC-B4TN-3B',
                'manufacturer'       => 'HARTZELL',
                'sn'                 => 'EAA-1533',
                'csn'                => 'N/A',
                'tso'                => '75.7',
                'tsn'                => '4275.6',
                'revision_manual'    => '22',
                'revision_pn'        => 'P.O.M. / PN:139 (61-00-39)', // Corrigido: Removido [cite_start] interno
                'manufacture_year'   => null,
                'cso'                => 'N/A',
            ]);

            // RIGHT PROPELLER
            AircraftPart::create([
                'service_order_id'   => $serviceOrder->id,
                'type'               => 'RIGHT_PROPELLER',
                'model'              => 'HC-B4TN-3B',
                'manufacturer'       => 'HARTZELL',
                'sn'                 => 'EAA-1553',
                'csn'                => 'N/A',
                'tso'                => '359.4',
                'tsn'                => '4275.6',
                'revision_manual'    => '22',
                'revision_pn'        => 'P.O.M./PN:139 (61-00-39)',
                'manufacture_year'   => null,
                'cso'                => 'N/A',
            ]);

            // Exemplo de como você lidaria com partes extras, se necessário:
            // AircraftPart::create([
            //     'service_order_id'   => $serviceOrder->id,
            //     'type'               => 'EXTRA_PART_EXAMPLE',
            //     'model'              => 'Modelo X',
            //     'manufacturer'       => 'Fabricante Y',
            //     'sn'                 => 'SN-XYZ',
            //     'tso'                => '100',
            //     'tsn'                => '500',
            // ]);
        }
    }
}
