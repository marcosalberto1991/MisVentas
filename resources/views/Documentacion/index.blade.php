@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>
            Reg Excel
        </title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
        <script src="{{ asset('js/editablegrid/editablegrid.js') }}">
        </script>
        <link href="{{ asset('css/editablegrid/editablegrid.css') }}" media="screen" rel="stylesheet" type="text/css"/>
    </head>
</html>
<style>
    body { font-family:'lucida grande', tahoma, verdana, arial, sans-serif; font-size:11px; }
        h1 { font-size: 15px; }
        a { color: #548dc4; text-decoration: none; }
        a:hover { text-decoration: underline; }
        table.testgrid { border-collapse: collapse; border: 1px solid #CCB; width: 800px; }
        table.testgrid td, table.testgrid th { padding: 5px; border: 1px solid #E0E0E0; }
        table.testgrid th { background: #E5E5E5; text-align: left; }
        input.invalid { background: red; color: #FDFDFD; }
</style>
<body>
    <section class="col-lg-12 connectedSortable">
        <div class="box box-warning col-lg-12">
            <div class="col-lg-3">
                <div class="box-body">
                    <div class="form-group">
                        <label class=" control-label" for="fichero">
                            Formato de Excel:
                        </label>
                        <a href="{{asset('excel/importal_arboles.xlsx')}}">
                            <img height="50" src="{{asset('imagenes/excel.png')}}" style="margin-top: 10px;" width="50"/>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class=" control-label" for="fichero">
                            Manual de usuario:
                        </label>
                        <a href="{{asset('excel/manual de usuario2.docx')}}">
                            <img height="50" src="{{asset('imagenes/pdf.png')}}" style="margin-top: 10px;" width="50"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@include('Excel.partials.info')
<div class="row">
    <div class="container">
        <table class="table table-hover">
            <div id="tablecontent">
            </div>
        </table>
    </div>
</div>
<script src="{{ asset('js/tableEdit.js') }}" type="text/javascript">
</script>
<!-- tabla editable-->
<script src="{{ asset('js/jquery.js') }}" type="text/javascript">
</script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('js/function.js') }}" type="text/javascript">
</script>
<!-- mi ajax -->
@endsection
