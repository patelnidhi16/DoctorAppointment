<?php

namespace App\DataTables;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DoctorDataTable extends DataTable
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
                $result .= "<button dataid='$user->id' class='rounded delete btn btn-danger mr-2 ' style='height:40px'>
                <span class='iconify' data-icon='ant-design:delete-filled'></span>
                </button>";
                $result .= "<button data-target='#exampleModal' data-toggle='modal' dataid=' $user->id ' class='rounded edits btn btn-success mr-2' data-backdrop='static' data-keyboard='false'style='height:40px' >
                <span class='iconify' data-icon='ant-design:edit-filled'  data-height='19'></span></button>";
                               
                return $result;
            })
            ->editColumn('shift', function ($data) {
                return $data->shift == 1 ? 'Morning' : 'Evening';
                
            })
            ->rawColumns(['action'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Doctor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Doctor $model, Request $request)
    {

        if ($request->shift) {

            return $model->where('shift', $request->shift);
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
            ->setTableId('doctor-table')
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
            Column::make('id')->data('DT_RowIndex'),
            Column::make('name'),
            Column::make('email'),
            Column::make('mobile'),
            Column::make('shift'),
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
        return 'Doctor_' . date('YmdHis');
    }
}
