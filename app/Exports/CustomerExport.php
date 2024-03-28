<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomerExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return Customer::select('customer_name', 'customer_company_name', 'customer_mail', 'customer_city', 'customer_address', 'customer_phone', 'customer_phone_home')->get();
    }

    public function headings(): array
    {
        return [
            'müşteri Adı',
            'şirket Adı',
            'müşteri e-posta',
            'müşteri ili',
            'müşteri adresi',
            'müşteri telefonu',
            'müşteri telefonu (2)'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFFFFDD0' // Krem
                ],
            ],
        ]);

        // Veritabanından müşteri verilerini al
        $customers = Customer::select('customer_name', 'customer_company_name', 'customer_mail', 'customer_city', 'customer_address', 'customer_phone', 'customer_phone_home', 'customer_status')->get();

        // Her bir müşteri için dön ve koşullu renklendirmeyi uygula
        foreach ($customers as $index => $customer) {
            $row = $index + 2; // Başlık satırını atladığımızdan emin olmak için 2'ye ekleyin

            $color = 'FF00FF00'; // Varsayılan renk

            // Müşteri durumuna göre renk değiştir
            if ($customer->customer_status == 1) {
                $color = 'FF888888'; //Gri
            } elseif ($customer->customer_status == 2) {
                $color = 'FF00FF00'; // Yeşil
            } elseif ($customer->customer_status == 3) {
                $color = 'FFFF0000'; // Kırmızı
            } elseif ($customer->customer_status == 4) {
                $color = 'FFFFFF00'; // Sarı
            }

            // Belirtilen hücre aralığına renk uygula
            $sheet->getStyle("A$row:G$row")->applyFromArray([
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => $color,
                    ],
                ],
            ]);
        }
    }

    public function sheets(): array
    {
        $sheets = [];
        $statuses = Customer::distinct()->pluck('customer_status')->toArray();

        foreach ($statuses as $status) {
            $customers = Customer::where('customer_status', $status)
                ->select('customer_name', 'customer_company_name', 'customer_mail', 'customer_city', 'customer_address', 'customer_phone', 'customer_phone_home')
                ->get();
            $sheet = new Sheet("Durum_$status");

            $headerRow = ['müşteri Adı', 'şirket Adı', 'müşteri e-posta', 'müşteri ili', 'müşteri adresi', 'müşteri telefonu', 'müşteri telefonu(2)'];
            $sheet->setAll([$headerRow]);

            $sheet->getStyle('A1:G1')->applyFromArray([
                'font' => [
                    'bold' => true,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => 'FFFFFDD0' // Krem
                    ],
                ],
            ]);

            foreach ($customers as $index => $customer) {
                $row = $index + 2;
                $color = 'FF00FF00';

                if ($customer->customer_status == 1) {
                    $color = 'FF888888'; // Gri
                } elseif ($customer->customer_status == 2) {
                    $color = 'FF00FF00'; // Yeşil
                } elseif ($customer->customer_status == 3) {
                    $color = 'FFFF0000'; // Kırmızı
                } elseif ($customer->customer_status == 4) {
                    $color = 'FFFFFF00'; // Sarı
                }

                $sheet->getStyle("A$row:G$row")->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => $color,
                        ],
                    ],
                ]);
            }
            $sheets[] = $sheet;
        }
        return $sheets;
    }
}
