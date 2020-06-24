@extends('layouts.app_admin_ui')
@section('content')
<section class="col-lg-12 connectedSortable">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <h3>Administra copia de seguridad</h3>
    <h3>Hora: <?php echo $horas ?> </h3>

    <div class="row">
        <div class="col-md-12">
            <a id="create-new-backup-button" href="{{ url('backup/create') }}" class="btn btn-primary pull-right"
                style="margin-bottom:2em;"><i class="fa fa-plus"></i> Crear una copia de seguridad
            </a>





        </div>
        <div class="col-md-12">
            @if (count($backups))

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nombre de archivo</th>
                        <th>Tamaño</th>
                        <th>Fecha</th>
                        <th>Tiempo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($backups as $backup)
                    <tr>
                        <td>{{ $backup['file_name'] }}</td>
                        <td>{{ $backup['file_size'] }}</td>
                        <!--
                            <td>{ formatTimeStamp($backup['last_modified'], 'F jS, Y, g:ia (T)') }}</td>
                            
                            <td> humanFilesize($backup['file_size']) }}</td>
                            <td>{ formatTimeStamp($backup['last_modified'], 'F jS, Y, g:ia (T)') }}</td>
                            <td>
                                { diffTimeStamp($backup['last_modified']) }}
                            </td>
                            -->
                        <td class="text-right">
                            <a class="btn btn-xs btn-default"
                                href="{{ url('backup/download/'.$backup['file_name']) }}"><i
                                    class="fa fa-cloud-download"></i> Descargar</a>
                            <a class="btn btn-xs btn-danger" data-button-type="delete"
                                href="{{ url('backup/delete/'.$backup['file_name']) }}"><i class="fa fa-trash-o"></i>
                                Eliminar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="well">
                <h4>There are no backups</h4>
            </div>
            @endif
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    @include('sweet::alert')
</section>
@endsection