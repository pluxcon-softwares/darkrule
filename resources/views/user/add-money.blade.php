@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row"></div>
    <div class="row mt-3">
        <div class="col-md-4 col-sm-12">
            <div class="card card-blue sg-shadow">
                <div class="card-header">
                    <h2 class="card-title">{{ __('Bitcoin (BTC) Payment') }}</h2>
                </div>
                <div class="card-body" style="text-align: center;">
                    <h4>{{__('We Accept BTC')}} <i class="badge badge-success badge-pill">Online</i></h4>
                    <img src="{{asset('images/bitcoin.png')}}" class="sg-shadow img-circle img-thumbnail mb-3" width="75px" height="75px" alt="">

                    <form method="POST" action="{{ route('deposit') }}">
                        @csrf
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text" style="background-color: #F5365C; color:#fff;">$</div>
                        </div>
                        <input type="text" name="deposit" class="form-control" placeholder="{{__('Deposit Amount')}}">
                            <div class="input-group-append">
                                <input type="submit" value="{{__('Deposit')}}" style="background-color: #F5365C; color:#fff; border:none;">
                            </div>
                    </div>
                     @if($errors->has('deposit'))
                            <span style="font-size: 14px; font-weight:bold; color:#F5365C;">{{ $errors->first('deposit') }}</span>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-sm-12">

            <div class="card card-blue sg-shadow">
                <div class="card-header">
                    <h2 class="card-title">{{__('History of Payments')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-condensed" id="paymentHistoryDataTable">
                        <thead>
                            <tr>
                                <th>{{__('Amount')}} (USD)</th>
                                <th>{{__('Amount')}} (BTC)</th>
                                <th>{{__('Address')}}</th>
                                <th>{{__('Status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payment_history as $payment)
                            <tr>
                                <td>${{ $payment->amount_total_fiat }}</td>
                                <td>{{ $payment->amountf }}</td>
                                <td>{{ $payment->address }}</td>
                                <td>
                                    @if($payment->status < -1)
                                    <span class="badge badge-danger badge-pill" style="font-size: 12px;">Failed</span>
                                    @endif
                                    @if ($payment->status >= 100)
                                    <span class="badge badge-success badge-pill" style="font-size: 12px;">Success</span>
                                    @endif
                                    @if($payment->status == 0 && $payment->status <= 0)
                                    <span class="badge badge-info badge-pill" style="font-size: 12px;">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_script')
    <script>
        $(function(){
            $('#paymentHistoryDataTable').DataTable({});
        });
    </script>
@endsection
