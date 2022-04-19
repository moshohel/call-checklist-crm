<?php

namespace App\Exports;

use App\Models\CallChecklistForKpr;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KprCallChecklistExport implements FromCollection, WithHeadings
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       // return CallChecklistForKpr::select('agent', 'created_at', 'customer_sec','call_started',  'call_ended', 'phone_number', 'caller_name', 'sex','age','occupation','location', 'call_type', 'caller', 'risk_level', 'main_reason_for_calling', 'secondary_reason_for_calling', 'caller_experience', 'caller_description')
        //->get();
        return new Collection($this->data);
    }

    public function headings() :array
    {
        return [
            'Volunteer Id',
            'Date',
            'Talk Time',
            'Time Call Started',
            'Time Call Ended',
            'Phone No',
            'Caller Name',
            'Sex',
            'Age',
            'Occupation',
            'Location',
            'Call Type',
            'Caller',
            'Risk Level',
            'Main Reason',
            'Secondary Reason',
            'Caller Experience',
            'Caller Descriprion'
        ];
    }
}
