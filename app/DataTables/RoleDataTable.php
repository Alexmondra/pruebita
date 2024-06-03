<?php

namespace App\DataTables;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;

class RoleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->escapeColumns('active')
            ->addColumn('opciones',function($row){
                $action='';
                if(Gate::allows('rol-editar')){
                    $action= '<button data-action="edit" data-id="'.$row->id.'" class="btn btn-icon btn-sm btn-warning btn-sm action"><i class="fas fa-edit"></i></button>';
                }
                if(Gate::allows('rol-eliminar')){
                    $action= $action.' <button data-action="delete" data-id="'.$row->id.'" class="btn btn-icon btn-sm btn-danger action"><i class="fas fa-trash"></i></button>';
                }
                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('table-listado')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('copy'),
                        Button::make('csv'),
                        Button::make('excel'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('colvis')
                    )
                    ->parameters(([
                        //'language' => ['url' => '/public/assets/datatables/i18n/es-ES.json']
                        'language' => ['url' => '/assets/datatables/i18n/es-ES.json']
                    ]));
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('opciones')
                  ->exportable(false)
                  ->printable(false),
            Column::make('id'),
            Column::make('name'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Role_' . date('YmdHis');
    }
}
