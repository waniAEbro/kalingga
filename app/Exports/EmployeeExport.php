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

    protected $employee, $bulan;

    public function __construct($employee, $bulan)
    {
        $this->employee = $employee;
        $this->bulan = $bulan;
    }

    public function view(): View
    {
        return view(
            "presence.excel",
            [
                "employee" => $this->employee,
                "bulan" => $this->bulan,
            ]
        );
    }

    public function styles(Worksheet $sheet)
    {
        return [
            "A1" => [
                "font" => ["bold" => true],
                "alignment" => ["horizontal" => "center"],
            ],
            "A3:A4" => [
                "font" => ["bold" => true],
            ],
            // Style the first row as bold text.
            6    => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $column_d = $event->sheet->getDelegate()->rangeToArray("D6:D" . $event->sheet->getDelegate()->getHighestRow());

                foreach ($column_d as $rowIndex => $row) {
                    $cellCoordinate = 'A' . ($rowIndex + 6) . ":" . "D" . ($rowIndex + 6); // +2 because rows are 1-based not 0-based
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
