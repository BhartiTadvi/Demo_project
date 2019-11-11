@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
         <div class="col-md-11">
                <div class="box">
                    <div class="box-header">Edit Faqs </div>
                    <div class="box-body">
                    <form method="POST" action="{{route('faqs.update',$faqs->id)}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate="parsley">
                          {{ method_field('PATCH') }}
                          {{ csrf_field() }}

                    <div class="col-xs-12 col-sm-12 col-md-12">
                     <div class="form-group">
                        <label for="questionno" class="control-label">{{ 'Question no' }}</label>
                        <input class="form-control" name="questionno" type="text" data-parsley-required="true" value="{{$faqs->question_no}}">
                         {!! $errors->first('questionno', '<p class="check-error">:message</p>') !!}
                    </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="question" class="control-label">{{ 'Question' }}</label>
                        <input class="form-control" name="question" type="text" id="question" data-parsley-required="true" value="{{$faqs->question}}">
                         {!! $errors->first('question', '<p class="check-error">:message</p>') !!}
                    </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
                        <label for="answer" class="control-label">{{ 'Answer' }}</label>
                       <textarea name="answer" class="form-control" data-parsley-required="true" > {{$faqs->answer}}</textarea>
                         {!! $errors->first('answer', '<p class="check-error">:message</p>') !!}
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                     <div class="form-group">
                     <label style="margin-left: 18px;}"> Active </label>
                     <input type="radio" name="status" value="1" class="minimal-red" checked>

                     <label> Inactive </label>
                     <input type="radio" name="status" value="0" class="minimal-red"></div>
                      
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="update">
                        <a href="{{ route('faqs') }}" title="Back" class="btn btn-warning" role="button">Back</a>
                    </div>
                    </div>
                            
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection
