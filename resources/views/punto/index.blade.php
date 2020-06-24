@extends('layouts.app_mosnter')

<script type='text/javascript'>
			</script>

@section('content')

<style type="text/css">
	.mesa{
	padding-left: 0px;
    padding-right: 0px;
    border-left: 5px solid #009efb!important;
    border: 1px solid rgba(120, 130, 140, 0.13);
	}
	.card-body{
	padding-left: 0px;
    padding-right: 0px;	
	}
	.card-header{
	background-color: #55ce63;
	}
	.boton_add{
		margin-top: 7px;
	}
</style>


	

<div class="container">
    <punto-component></punto-component>
</div>

<div class='col-lg-12'>
	<div class="row">
	</div>
</div>
<section class="col-lg-12 ">

</section>

@endsection

	
@section("page-js-files")	
	<!--
	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	-->


    <link href="{{ asset('jQuery-autoComplete-master/jquery.auto-complete.css')}}" rel="stylesheet" />
	<script type="text/javascript" src="{{asset('jQuery-autoComplete-master/jquery.auto-complete.min.js')}}"></script>


@stop	
@section("page-js-script")
	
			
<script type='text/javascript'>

</script>



<script type='text/javascript'>
	
</script>
@stop
</body>
</html>

				
