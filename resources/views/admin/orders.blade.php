@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <div class="row">

        <div class="col-md-4 col-sm-12">
            <div class="card card-blue">
                <div class="card-header">
                    <h3 class="card-title">ORDER PROFIT</h3>
                </div>
                <div class="card-body">
                    <div class="animated flipInY">
                        <div class="tile-stats">
                          <div class="count" id="total_profit" style="font-size: 40px; color: red">0</div>

                          <h4>TOTAL PROFIT</h4>
                        </div>
                      </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-sm-12">
            <div class="card card-blue">
                <div class="card-header">
                    <h2 class="card-title">{{ $title }}</h2>
                </div>
                <div class="card-body">
                    <table id="ordersDataTable" width="100%" style="font-size: 100%; width:100%;" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="font-size: 11px; width:100px;">ORDER NUMBER</th>
                                <th style="font-size: 11px; width:200px;">USERNAME</th>
                                <th style="font-size: 11px; width:150px;">AMOUNT(USD)</th>
                                <th style="font-size: 11px; width:150px;">AMOUNT(BTC)</th>
                                <th style="font-size: 11px; width:150px;">STATUS</th>
                            </tr>
                        </thead>
                        <tbody id="ordersTbody">
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
        function fetchAllOrders()
        {
            $("#ordersDataTable").DataTable({
                ajax:{
                    url: '/admin/order/all',
                    method: 'GET',
                    dataSrc: 'orders'
                },
                columns:[
                    {data: "order_id"},
                    {data: "buyer_name"},
                    {
                        data: "amount_total_fiat",
                        render: function(amount_total_fiat){
                            return `$${amount_total_fiat}`;
                        }
                    },
                    {data: "amountf"},
                    {
                        data: "status",
                        render: function(status){
                            var status;
                            if(status < 0){
                                status = "<span class='badge badge-danger badge-pill' style='font-size:14px;'>Failure</span>";
                            }
                            if(status == 0 && status <= 99){
                                status = "<span class='badge badge-info badge-pill' style='font-size:14px;'>Pending</span>";
                            }
                            if(status >= 100){
                                status = "<span class='badge badge-success badge-pill' style='font-size:14px;'>Completed</span>";
                            }

                            return `${status}`;
                        }
                    }
                ],
                "scrollY": true
            });
        }
        fetchAllOrders()


        function fetchOrderProfit()
        {
            $.ajax({
                url: '/admin/order/profit',
                method: 'GET',
                success: function(res){
                    if(res.profits){
                        $("div#total_profit").text(`$${res.profits ? res.profits.toFixed(2) : '0.00'}`);
                    }
                }
            });
        }
        fetchOrderProfit();
    });
</script>

@endsection
