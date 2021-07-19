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
                    <h2 class="card-title">{{__('Deposit - Payment Completed')}}</h2>
                </div>
                <div class="card-body" style="text-align: center;">
                    <h5>{{__('Payment to deposit funds to your wallet was successfully')}}</h5>
                    <h4>{{__('Please wait for 3 confirmations from the blockchain and your money will reflect in your wallet.')}}</h4>
                    <p style="color: red; font-weight:bold;">{{__('Click the button below to check your payment status')}}</p>
                    <a href="{{ route('add.money') }}" class="btn btn-sm btn-success">{{__('Payment History')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
