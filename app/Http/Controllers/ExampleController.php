<?php

namespace App\Http\Controllers;

use App\DataTables\ExampleDataTable;
use App\Exports\StudentExport;
use App\Models\Example;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExampleController extends Controller
{
    public function examplestore(Request $request)
    {
        Example::create([
            'name' => $request->name,
            'hobbie' => implode(',', $request->hobbie)
        ]);
    }
    public function example(ExampleDataTable $ExampleDataTable)
    {

        return $ExampleDataTable->render('Example.example');
    }

    public function exampleedit($id)
    {
        $data = Example::find($id);
        $hobbie = explode(',', $data->hobbie);
        return view('Example.exampleedit', compact('data', 'hobbie'));
    }
    public function get_student_data()
    {
        return Excel::download(new StudentExport, 'students.xlsx');
    }
    public function formexample()
    {
        return view('Example.formexample');
      
    }
}
