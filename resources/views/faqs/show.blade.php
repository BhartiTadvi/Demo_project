@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="box">
                    <div class="box-header">Banner </div>
                    <div class="box-body">
                         <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $faqs->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Question No </th>
                                        <td> {{ $faqs->question_no }} </td>
                                    </tr>
                                    <tr>
                                        <th> Question</th>
                                        <td> {{ $faqs->question }} </td>
                                    </tr>
                                    <tr>
                                        <th> Answer</th>
                                        <td> {{ $faqs->answer }} </td>
                                    </tr>
                                    <tr>
                                        <th> Status</th>
                                        <td> {{ $faqs->status }} </td>
                                    </tr>
                                 </tbody>
                            </table>
                        </div>
                        <a href="{{ route('faqs') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                     </div>
                 </div>
            </div>
        </div>
    </div>
@endsection
