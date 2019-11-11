@extends('frontend.layouts.master')
@section('content')
<section>
	<h3 style="text-align:center;margin-bottom:50px;"> {{$copyright->type}}</h3>
	<div class="container" style="text-align:center; margin-bottom:20px;">
    {!! $copyright->description !!}
	</div>					
</section>
@endsection
