<?php

namespace App\Exports;

use App\Models\SojonTier2;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ShojonTierTowExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function __construct(String $from=null ,String $to=null)
    {
        $this->from=$from;
        $this->to=$to;
    }
    public function view(): View
    {
        return view('Export.tierTwo_report', [
            'report' => SojonTier2::select()->where('date','>=',$this->from)
             ->where('date','<=',$this->to)->get()
        ]);
    }
}
