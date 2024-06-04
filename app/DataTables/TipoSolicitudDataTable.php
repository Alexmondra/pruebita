<?php
namespace App\DataTables;

use App\Models\TipoSolicitud;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;

class TipoSolicitudDataTable extends DataTable
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
            ->escapeColumns([])
            ->addColumn('opciones', function ($row) {
                $action = '';
                if (Gate::allows('tiposolicitud-editar')) {
                    $action .= '<button data-action="edit" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning action"><i class="fas fa-edit"></i></button>';
                }
                if (Gate::allows('tiposolicitud-activar')) {
                    if ($row->activo) {
                        $action .= ' <button data-action="desactivar" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-success action"><i class="fas fa-check"></i></button>';
                    } else {
                        $action .= ' <button data-action="activar" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-danger action"><i class="fas fa-times"></i>&nbsp;</button>';
                    }
                }
                return $action;
            })
            ->addColumn('vimagen', function ($row) {
                $url = empty($row->imagen) ? asset("assets/noimage.png") : asset("uploads/tipoSolicitudes/$row->imagen");
                return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
            })
            ->addColumn('activo', function ($row) {
                return $row->activo ? 'Activo' : 'Desactivado';
            })
            ->rawColumns(['opciones', 'vimagen', 'activo']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TipoSolicitud $model): QueryBuilder
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
                        'language' => ['url' => '/assets/datatables/i18n/es-ES.json'],
                        'dom' => 'Bfrtip',
                        'buttons' => [
                            'excel', 'csv', 'pdf', 'print', 'reset', 'reload'
                        ]
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
                  ->printable(false)
                  ->addClass('text-center')
                  ->title('Opciones'),
            Column::make('id'),
            Column::make('nombre')->title('Nombre'),
            Column::make('activo')->title('Estado'),
            Column::computed('vimagen')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center')
                  ->title('Imagen'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'TipoSolicitud_' . date('YmdHis');
    }
}
