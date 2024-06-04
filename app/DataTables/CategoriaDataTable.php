<?php

namespace App\DataTables;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;

class CategoriaDataTable extends DataTable
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
            ->addColumn('opciones', function($row) {
                $action = '';
                if (Gate::allows('categoria-editar')) {
                    $action = '<button data-action="edit" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning action"><i class="fas fa-edit"></i></button>';
                }
                if (Gate::allows('categoria-activar')) {
                    if ($row->activo) {
                        $action = $action . ' <button data-action="desactivar" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-success action"><i class="fas fa-check"></i></button>';
                    } else {
                        $action = $action . ' <button data-action="activar" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-danger action"><i class="fas fa-times"></i>&nbsp;</button>';
                    }
                }
                return $action;
            })
            ->addColumn('vimagen', function ($row) {
                $url = empty($row->imagen) ? asset("assets/noimage.png") : asset("uploads/categorias/$row->imagen");
                return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
            })
            ->addColumn('activo', function ($row) {
                return $row->activo ? 'Activo' : 'Desactivado';
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Categoria $model): QueryBuilder
    {
        return $model->newQuery();
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
                    ->parameters([
                        'language' => ['url' => '/assets/datatables/i18n/es-ES.json']
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('opciones')
                  ->exportable(false)
                  ->printable(false),
            Column::make('id'),
            Column::make('nombre'),
            Column::make('activo')->title('estado') ,
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Categoria_' . date('YmdHis');
    }
}
