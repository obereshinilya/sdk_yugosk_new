<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Sved_avar_Export implements FromView, WithStyles, ShouldAutoSize
{
    private $title, $data;

    public function __construct($title, $data)
    {
        $this->title = $title;
        $this->data = $data;
    }

    public function view(): View
    {
        return view('web.docs.reports.excel_forms.excel_sved_avar', [
            'data' => $this->data,
            'title' => $this->title
        ]);
    }

    public function styles(Worksheet $sheet)
    {

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],


        ];
        $styleArray2 = [
            'font' => [
                'size'=>20
            ]
        ];

        $sheet->getStyle('A1')->applyFromArray($styleArray2);

        $sheet->getStyle('A1:N2')->applyFromArray($styleArray);
//        $sheet->getStyle('A2:AH3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('D9D9D9D9');;
        $sheet->getRowDimension('2')->setRowHeight(50);
        $sheet->getStyle('N2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('F7CAAC');
        $sheet->getRowDimension('1')->setRowHeight(50);

    }
}
