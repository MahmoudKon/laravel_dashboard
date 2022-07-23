<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithMapping, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::with('department:id,title', 'aggregator', 'behalf')->get();
    }

    public function map($user): array
    {
        return [
            $user->finger_print_id,
            $user->name,
            $user->email,
            $user->behalf->name ?? '',
            $user->aggregator->title ?? '',
            $user->department->title ?? '',
            $user->annual_credit,
            $user->salary_per_monthly,
            $user->insurance_deduction,
        ];
    }

    public function headings(): array
    {
        return ["Finger ID", "Name", "Email", "Behalf", "Aggregator", "Department", "Annual Credit", "Salary", "Insurance Deduction"];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'italic' => true, 'size' => 11],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => 'thin',
                        'color' => ['argb' => '666666'],
                    ],
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;
                $sheet->getStyle('A1:I1')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 5, 'color' => ['rgb' => 'cccccc'],]);
                $sheet->getDelegate()->getRowDimension(1)->setRowHeight(40);
            },
        ];
    }
}
