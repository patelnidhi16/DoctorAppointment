<?php

namespace App\Exports;

use App\Models\Example;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct()
    {
        
    }
    public function collection()
    {
        return Example::get(['id','name','hobbie']);
    }

    public function headings(): array
    {
        return ["id", "name", "hobbie"];
    }
}
