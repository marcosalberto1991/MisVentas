@extends('layouts.app_mosnter')
<meta charset="utf-8"/>
<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link href="{{ asset('images/favicon.jpg') }}" rel="shortcut icon"/>
<meta content="{{ csrf_token() }}" name="_token"/>
<!--
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"/>
<style>
    .panel-heading {
            padding: 0;
        }
        .panel-heading ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .panel-heading li {
            float: left;
            border-right:1px solid #bbb;
            display: block;
            padding: 14px 16px;
            text-align: center;
        }
        .panel-heading li:last-child:hover {
            background-color: #ccc;
        }
        .panel-heading li:last-child {
            border-right: none;
        }
        .panel-heading li a:hover {
            text-decoration: none;
        }
        .titulo{
            font-size:18px;
        }
        .info-box.level .info-box-icon {
        border-radius: 2px 0 0 2px;
        display: block;
        float: left;
        height: 70px;
        width: 70px;
        text-align: center;
        font-size: 40px;
        line-height: 70px;
        background: rgba(0,0,0,0.2);
        }
        .fama{
            margin-top: 15px;
        }
</style>
>-->
@include('log-viewer::_template.stylema')

@section('content')
<section class="col-lg-12 connectedSortable">
    <div class="box box-warning">
        <div class="box-header with-border">
            <!--inicio de los porcesos-->
            <div class="col-md-4">
                <a href="#">
                   
                </a>
            </div>
            
           
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="">
            </div>
        </div>
    </div>
</section>
@endsection
<!-- Modal form to mass a form -->
<!--
<script crossorigin="anonymous" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" src="https://code.jquery.com/jquery-2.2.4.js">
</script>
{{--
<script src="{{ asset(" toastr="" toastr.min.js")="" type="text/javascript" }}"="">
</script>
--}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript">
</script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript">
</script>
-->
<script>
    $(document).ready(function(){
            $("#postTable").DataTable();
        });

        $(window).load(function(){
            $("#postTable").removeAttr("style");
        })
</script>
<script>
    $('.edit_published').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'POST',
                                url: "{{ URL::route('changeStatus') }}",
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'id': id
                                },
                                success: function(data) {
                                    // empty
                                },
                            });
                        });
</script>
