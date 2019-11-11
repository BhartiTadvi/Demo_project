@extends('frontend.layouts.master')
@section('content')

<section>
	<h3 style="text-align:center"> {{$terms->type}}</h3>
	<div class="container">
    {!! $terms->description !!}
	</div>					
</section>
@endsection
