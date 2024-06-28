<?php

namespace App\Exports;

use App\Models\EquipementDemo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EquipementDemoExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return EquipementDemo::all();
    }

    public function headings(): array
    {
        return [
            'Code',
            'Designation',
            'Modèle',
            'Marque',
            'Numéro Série',
            'Modalité',
            'Garantie',
            'Date entrée'
        ];
    }
}
