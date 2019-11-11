@extends('frontend.layouts.master')
@section('content')

<section>
	<h3 style="margin-left:530px;margin-bottom:60px"> {{$privacyPolicy[0]->type}}</h3>
	<div class="container">
    {!! $privacyPolicy[0]->description !!}
	</div>					
</section>
@endsection
