@extends('layouts.app_admin_ui')
<meta charset="utf-8"/>
<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link href="{{ asset('images/favicon.jpg') }}" rel="shortcut icon"/>
<meta content="{{ csrf_token() }}" name="_token"/>

@include('log-viewer::_template.stylema')

@section('content')


@endsection
<script>
    $(document).ready(function(){
            $("#postTable").DataTable();
        });

        $(window).load(function(){
            $("#postTable").removeAttr("style");
        })
</script>
