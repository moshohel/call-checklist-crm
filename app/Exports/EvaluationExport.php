<?php

namespace App\Exports;

use App\Models\Evaluation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EvaluationExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // dd(Evaluation::all());
        $data = Evaluation::all();
        dd($data);
        return $data;
    }

    public function headings(): array
    {
        return [
            'Serial Number',
            'Name',
            'Counselor name',
            'Duration Call',
            'Date',
            'Rating Score',
            'Recommendation',
            'Assessment',
            'Observation',

        ];
    }
}
