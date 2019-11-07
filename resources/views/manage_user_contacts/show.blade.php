@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">manage_user_contact {{ $manage_user_contact->id }}</div>
                    <div class="box-body">
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $manage_user_contact->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Name</th>
                                        <td> {{ $manage_user_contact->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Email  </th>
                                        <td> {{ $manage_user_contact->email }} </td>
                                    </tr>
                                    <tr>
                                        <th> Subject </th>
                                        <td> {{ $manage_user_contact->subject }} </td>
                                    </tr>
                                     <tr>
                                        <th> Message </th>
                                        <td> <p Style="word-break: break-all;">{{ $manage_user_contact->message }} </p></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="{{ route('manage_user_contacts.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
