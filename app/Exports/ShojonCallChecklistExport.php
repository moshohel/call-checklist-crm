<?php

namespace App\Exports;

use App\Models\CallChecklistForShojon;
use http\Env\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use \Illuminate\Support\Collection;

class ShojonCallChecklistExport implements FromCollection, WithHeadings
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
        //return CallChecklistForShojon::select('agent', 'created_at', 'customer_sec','call_started',  'call_ended','phone_number', 'caller_name', 'sex','age','occupation', 'socio_economic_status', 'location', 'hearing_source', 'is_recordable', 'call_type', 'caller', 'service', 'pre_mood_rating', 'main_reason_for_calling', 'secondary_reason_for_calling', 'mental_illness_diagnosis', 'suicidal_risk', 'post_mood_rating', 'call_effectivenes', 'client_referral', 'ref_client_name','ref_age', 'ref_therapy_reason','ref_phone_number','ref_preferred_time','ref_emergency_number','ref_financial_affort','ref_therapist_preference', 'caller_description')
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
            'Socio Economic Status',
            'Location',
            'Hearing Source',
            'Is Recordable',
            'Call Type',
            'Caller',
            'Service',
            'Mood Rating (Pre)',
            'Main Reason',
            'Secondary Reason',
            'Mental Illness',
            'Suicidal Risk',
            'Mood Rating (Post)',
            'Call Effectiveness',
            'Client Referral',
            'Ref. Name',
            'Ref. Age',
            'Ref. Therapy Person',
            'Ref. Prefered Number',
            'Ref. Prefered Time',
            'Ref. Emergency Number',
            'Ref. Financial affort',
            'Ref. Therapist Preference',
           /* 'Financial Affotdability',*/
            'Caller Descriprion'
        ];
    }
}
