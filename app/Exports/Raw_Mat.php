<?php


namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class Raw_Mat implements FromCollection
{
    public function collection()
    {

        return User::all();
    }
    public function headings()
    {
        return [
            '#',
            'User',
            'Date',
        ];
    }
}
