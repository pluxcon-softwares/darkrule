@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <div class="row"></div>

    <div class="row mt-5">
        <div class="col-md-12 ml-auto mr-auto">
            <div class="card card-blue" style="background-color:#ECEEF9;">
                <div class="card-header">
                  <h2 class="card-title"><i class="fas fa-ticket-alt"></i> {{__($title)}}</h2>
                </div>
                <div class="card-body">
                    <table id="purchasesDataTable" width="100%" style="font-size: 100%; width:100%;" class="table table-bordered table-responsive table-striped">
                        <thead>
                            <tr>
                                <th style="font-size: 11px; width:100px;">{{__('ORDER ID')}}</th>
                                <th style="font-size: 11px; width:100px;">{{__('TYPE')}}</th>
                                <th style="font-size: 11px; width:500px;">{{__('PRODUCT')}}</th>
                                <th style="font-size: 11px; width:150;">{{__('PRICE')}}</th>
                                <th style="font-size: 11px; width:150px;">{{__('DATE')}}</th>
                                <th style="font-size: 11px; width:200px; text-align:center;">{{__('ACTION')}}</th>
                            </tr>
                        </thead>
                        <tbody id="purchasesTbody">
                        </tbody>
                    </table>

                </div>
              </div>
        </div>
    </div>

    <!-- Modal - View Ticket Reply Modal -->
<div class="modal fade" id="viewPurchaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('Purchase')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <!-- Content Here -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
            </div>
          </div>
    </div>
  </div>

@endsection

@section('extra_script')
    <script>
        $(function(){
            //Get all purchases
            function getUserPurchases(){
                $("#purchasesDataTable").DataTable({
                    ajax:{
                        url: '/purchase/all',
                        method: 'GET',
                        dataSrc: 'purchases'
                    },
                    columns:[
                        {data: 'order_id'},
                        {data: 'type'},
                        {data: 'name'},
                        {
                            data: 'price',
                            render: function(price){
                                return `$${price}`;
                            }
                        },
                        {
                            data: 'created_at',
                            render: function(created_at){
                                return `${moment(created_at).format("dddd, MMMM Do YYYY")}`;
                            }
                        },
                        {
                            data: 'id',
                            render: function(id){
                                return `
                                <a href="#" class="view_purchase btn btn-sm btn-primary" data-view_purchase="${id}"><i class="fa fa-file-archive-o"></i> View</a>
                                <a href="#" class="delete_purchase btn btn-sm btn-danger" data-delete_purchase="${id}"><i class="fa fa-remove"></i> Delete</a>
                                `;
                            }
                        }
                    ]
                });
            }
            getUserPurchases();

            //View Purchase
            function viewUserPurchase(){
                $("#purchasesTbody").on('click', '.view_purchase', function(e){
                    e.preventDefault();
                    var purchaseID = e.currentTarget.dataset.view_purchase;
                    $.ajax({
                        url: '/purchase/view/'+purchaseID,
                        method: 'GET',
                        success: function(res){
                            $("div.modal-body-purchase").remove();
                            $("#viewPurchaseModal .modal-body").append(
                                `
                                <div class="modal-body-purchase">
                                    <h3>${res.purchase.name}</h3>
                                    <hr>
                                    <p>${res.purchase.description}</p>
                                    <hr>
                                    <span>Price: ${res.purchase.price}</span><br>
                                    <span>OrderID: ${res.purchase.order_id}</span><br>
                                    <span>Type: ${res.purchase.type}</span><br>
                                    <span>Purchase Date: ${moment(res.purchase.created_at).format("dddd, MMMM Do YYYY")}</span>
                                </div>
                                `
                            );
                        }
                    });
                    $("#viewPurchaseModal").modal('show');
                });
            }
            viewUserPurchase();

            //Delete Purchase by User
            function deleteUserPurchase(){
                $("#purchasesTbody").on('click', '.delete_purchase', function(e){
                    e.preventDefault();
                    var purchaseID = e.currentTarget.dataset.delete_purchase;
                    swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover it",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '/purchase/delete/' + purchaseID,
                            method:'GET',
                            success: function(res){
                                if(res.success){
                                    swal(res.success, {
                                        icon: "success",
                                    });
                                    window.location.reload();
                                }
                            }
                        });
                    } else {
                        swal("Your puchased product is safe!");
                    }
                    });
                });
            }
            deleteUserPurchase();
        });
    </script>
@endsection
