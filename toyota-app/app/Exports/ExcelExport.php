<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ExcelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */


    
    public function headings(): array
    {
            return [
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
            ];
    }
    public function collection()
    {
        return User::all();
    }
}
