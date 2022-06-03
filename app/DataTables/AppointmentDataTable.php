<?php

namespace App\DataTables;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AppointmentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($user) {
                $result = '';
                $result .= "<button dataid='$user->id' class='rounded delete btn btn-danger mr-2 ' style='height:40px'>Delete</button>";
                $result .= "<button data-target='#createapointment' data-toggle='modal' dataid=' $user->id ' class='rounded edit btn btn-success mr-2' data-backdrop='static' data-keyboard='false'style='height:40px' >Edit</button>";

                return $result;
            })

            ->rawColumns(['image', 'action'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Appointment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Appointment $model, Request $request)
    {
        $doctor = $request->doctor;
        $name = Doctor::where('name', $doctor)->get()->toArray();

        $date = Appointment::where('date', $request->date)->get('date')->toArray();
        if ($name && $date) {
            return $model->where('doctor_id',  $name[0]['id'])->where('date', $date[0]['date']);
        } elseif ($name) {
            return $model->where('doctor_id',  $name[0]['id']);
        } elseif ($date) {

            return $model->where('date', $date[0]['date']);
        } else {
            return $model->newQuery();
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('appointment-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('mobile'),
            Column::make('doctor_id'),
            Column::make('date'),
            Column::make('start_time'),
            Column::make('end_time'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Appointment_' . date('YmdHis');
    }
}
