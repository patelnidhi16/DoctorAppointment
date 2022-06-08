<?php

namespace App\DataTables;

use App\Models\Patient;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PatientDataTable extends DataTable
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
                $result .= "<button dataid='$user->id' class='rounded delete btn btn-danger mr-2 ' style='height:40px'><span class='iconify' data-icon='ant-design:delete-filled'></span></button>";
                $result .= "<button data-target='#exampleModal' data-toggle='modal' dataid=' $user->id ' class='rounded edit btn btn-success mr-2' data-backdrop='static' data-keyboard='false'style='height:40px' > <span class='iconify' data-icon='ant-design:edit-filled'  data-height='19'></span></button>";
                $result .= "<button data-target='#appointment' data-toggle='modal' dataid=' $user->id ' class='rounded schedule btn btn-primary mr-2' data-backdrop='static' data-keyboard='false'style='height:40px' title='Add Appointmet'>
                <span class='iconify' data-icon='carbon:add-filled'></span></button>";
                
                return $result;
            })
            ->rawColumns([ 'action'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Patient $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Patient $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('patient-table')
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
            Column::make('user_name'),
            Column::make('name'),

            Column::make('email'),
            Column::make('mobile'),
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
        return 'Patient_' . date('YmdHis');
    }
}