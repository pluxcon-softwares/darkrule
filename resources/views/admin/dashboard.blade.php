@extends('admin.layouts.master')

@section('title')
    {{ $data['title'] }}
@endsection

@section('content')

@include('admin.partials.top_widgets')

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">Payment transactions</div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="transactionTbl" style="width: 100%">
                    <thead>
                        <tr>
                            <th>USERNAME</th>
                            <th>EMAIL</th>
                            <th>USD</th>
                            <th>BTC</th>
                            <th>ADDRESS</th>
                            <th>STATUS</th>
                            <th>DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['transactions'] as $transac)
                        <tr>
                            <td>{{ $transac->buyer_name }}</td>
                            <td>{{ $transac->buyer_email }}</td>
                            <td>{{ $transac->amount_total_fiat }}</td>
                            <td>{{ $transac->amountf }}</td>
                            <td>{{ $transac->address }}</td>
                            <td>
                                @if($transac->status < -1)
                                <span class="badge badge-danger">Failed/Cancel</span>
                                @endif

                                @if($transac->status == 0 && $transac->status <= 0)
                                <span class="badge badge-info">Pending</span>
                                @endif

                                @if($transac->status >= 100)
                                <span class="badge badge-success">Success</span>
                                @endif
                            </td>
                            <td>{{ date('d-M-Y', strtotime($transac->created_at)) }}</td>
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
        $('#transactionTbl').DataTable({
            scrollX: true,
            scrollY: true
        });
    });
</script>
@endsection
