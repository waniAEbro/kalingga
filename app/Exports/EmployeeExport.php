<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeeExport implements FromView, ShouldAutoSize, WithStyles, WithEvents
{

    protected $employee;

    public function __construct($employee)
    {
        $this->employee = $employee;
    }

    public function view(): View
    {
        return view(
            "employee.excel",
            [
                "employee" => $this->employee
            ]
        );
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $column_d = $event->sheet->getDelegate()->rangeToArray("D2:D" . $event->sheet->getDelegate()->getHighestRow());

                foreach ($column_d as $rowIndex => $row) {
                    $cellCoordinate = 'A' . ($rowIndex + 2) . ":" . "D" . ($rowIndex + 2); // +2 because rows are 1-based not 0-based
                    $cellValue = $row[0];

                    if ($cellValue == "Telat") {
                        $event->getDelegate()->getStyle($cellCoordinate)->applyFromArray([
                            'fill' => [
                                'fillType'   => Fill::FILL_SOLID,
                                'startColor' => ['argb' => Color::COLOR_RED]
                            ],
                        ]);
                    } elseif ($cellValue == "Pulang Cepat") {
                        $event->getDelegate()->getStyle($cellCoordinate)->applyFromArray([
                            'fill' => [
                                'fillType'   => Fill::FILL_SOLID,
                                'startColor' => ['argb' => Color::COLOR_YELLOW]
                            ],
                        ]);
                    } elseif ($cellValue == "Belum Absen Pulang") {
                        $event->getDelegate()->getStyle($cellCoordinate)->applyFromArray([
                            'fill' => [
                                'fillType'   => Fill::FILL_SOLID,
                                'startColor' => ['argb' => Color::COLOR_MAGENTA]
                            ],
                        ]);
                    } elseif ($cellValue == "Tepat Waktu") {
                        $event->getDelegate()->getStyle($cellCoordinate)->applyFromArray([
                            'fill' => [
                                'fillType'   => Fill::FILL_SOLID,
                                'startColor' => ['argb' => Color::COLOR_GREEN]
                            ],
                        ]);
                    }
                }
            },
        ];
    }
}
