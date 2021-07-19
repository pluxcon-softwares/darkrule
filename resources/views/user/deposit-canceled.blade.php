@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row"></div>
    <div class="row mt-5">
        <div class="col-md-6 col-sm-12 ml-auto mr-auto">
            <div class="card card-blue">
                <div class="card-header">
                    <h2 class="card-title">{{__('Deposit - Payment Canceled')}}</h2>
                </div>
                <div class="card-body" style="text-align: center;">
                    <h4>{{__('Payment has been canceled, you can still add funds -OR- visit homepage my using the buttons below')}}</h4>
                    <a href="{{ route('add.money') }}" class="btn btn-sm btn-success">{{__('Add Funds')}}</a>
                    <a href="{{ route('home') }}" class="btn btn-sm btn-danger">{{__('Home')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
