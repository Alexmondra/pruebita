<?php

namespace App\DataTables;

use App\Models\Solicitud;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;

class SolicitudDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->escapeColumns('active')
            ->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : 'N/A';
            })
            ->addColumn('opciones', function($row) {
                $action = '';
                if (Gate::allows('solicitud-editar')) {
                    $action = '<button data-action="edit" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning action"><i class="fas fa-edit"></i></button>';
                }
                if (Gate::allows('solicitud-activar')) {
                    if ($row->estado) {
                        $action = $action . ' <button data-action="desactivar" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-success action"><i class="fas fa-check"></i></button>';
                    } else {
                        $action = $action . ' <button data-action="activar" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-danger action"><i class="fas fa-times"></i>&nbsp;</button>';
                    }
                }
                return $action;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Solicitud $model): QueryBuilder
    {
        if (Gate::allows('solicitud-editar')) {
            return $model->newQuery()->with('user');
        } else {
            $userId = auth()->user()->id;
            return $model->newQuery()->with('user')->where('user_id', $userId);
        }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('table-listado')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->parameters(([
                        'language' => ['url' => '/assets/datatables/i18n/es-ES.json']
                    ]));
    }


    public function getColumns(): array
    {
        return [
            Column::computed('opciones')
                  ->exportable(false)
                  ->printable(false),
            Column::make('user_name')->title('Usuario'),
            Column::make('tipo'),
            Column::make('comentario'),
            Column::make('observaciones'),
            Column::make('fecha_envio'),
            Column::make('estado'),
            Column::make('archivo'),
        ];
    }


    protected function filename(): string
    {
        return 'Solicitud_' . date('YmdHis');
    }
}
