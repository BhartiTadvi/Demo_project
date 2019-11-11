@extends('frontend.layouts.master')
@section('content')

<section>
	<h3 style="text-align:center;"> {{$ComanyInfo->type}}</h3>
	<div class="container" style="margin-bottom:20px">
    {!! $ComanyInfo->description !!}
	</div>

</section>
@endsection
