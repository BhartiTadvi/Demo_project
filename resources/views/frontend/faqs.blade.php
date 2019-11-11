@extends('frontend.layouts.master')
@section('content')

<section class="accordion-section clearfix mt-3" aria-label="Question Accordions">
  <div class="container">
  	   <h3 class="faqs">FAQ's
  	   </h3>
	  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	  	@foreach($faqs as $faq)
             
		<div class="panel panel-default">
			
			
		  <div class="panel-heading p-3 mb-3" role="tab" id="heading{{$faq->id}}">
			<h3 class="panel-title">
			  <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$faq->id}}" aria-expanded="true" aria-controls="collapse0">
				 {{$faq->question}}
			  </a>
			</h3>
		  </div>
		  <div id="collapse{{$faq->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$faq->id}}">
			<div class="panel-body px-3 mb-4">
				{{$faq->answer}}
			  </ul>
			</div>
		  </div>
		</div>
		@endforeach
	  </div>
  </div>
  <br/>
</section>
@endsection

@section('script')
<script>
	</script>

@endsection