@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="card card-blue">
                <div class="card-header">
                  <h3 class="card-title">Product Categories</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="text-align: center;">
                    <p>
                        @if(count($subCategories) <= 0)
                            No Product types
                        @else
                            @foreach ($subCategories as $subCategory)
                                <a href="#" data-subcategory_id="{{ $subCategory->id }}" class="badge badge-pill badge-success top_category_btn" style="font-size: 14px; margin-bottom:10px;">{{ $subCategory->sub_category_name }}</a>
                            @endforeach
                        @endif
                    </p>
                </div>
                <!-- /.card-body -->
              </div>

        </div>

        <div class="col-md-12 col-sm-12 mt-0">

            <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">{{ $title }}</h3> &nbsp;
                  <button id="addProductBtn" class="btn btn-sm btn-danger fa-pull-right">Add New Product</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body" id="productsTableDiv">
                    <table id="productsDataTable" width="100%" style="font-size: 100%; width:100%;" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="font-size: 11px; width:50px;">TYPE</th>
                                <th style="font-size: 11px; width:30px;">COUNTRY</th>
                                <th style="font-size: 11px; width:300px;">INFORMATION</th>
                                <th style="font-size: 11px; width:15px;">PRICE</th>
                                <th style="font-size: 11px; width:15px;">IN STOCK</th>
                                <th style="font-size: 11px; width:200px; text-align:center;">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody id="productsTbody">
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->type }}</td>
                                <td>{{ $product->country ? $product->country : 'None' }}</td>
                                <td>{{ $product->name }}</td>
                                <td>${{ $product->price ? $product->price : '0.00' }}</td>
                                <td>{{ $product->in_stock ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="#" class="view_product btn btn-info btn-sm" data-product_id="{{$product->id}}">
                                        <i class="fa fa-file-archive-o"></i>
                                        <div class="spinner spinner-border spinner-border-sm" style="display: none"></div>
                                        View</a>
                                    <a href="#" class="edit_product btn btn-success btn-sm" data-product_id="{{$product->id}}"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="#" class="delete_product btn btn-danger btn-sm" data-product_id="{{$product->id}}">
                                        <i class="fa fa-remove"></i>
                                        <div class="spinner spinner-border spinner-border-sm" style="display:none"></div>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>

    <!-- ============= VIEW PRODUCT DETAILS ============== -->
    <div class="modal fade" id="viewProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Prodcut Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <!-- Content Here -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
        </div>
      </div>
    <!-- ============== END OF PRODUCT DETAILS ============= -->


    <!-- ========= ADD PRODUCT ============ -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addProductForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                        <div class="form-group">
                            <label for="addCategory" class="control-label">Category</label>
                            <select name="addCategory" id="addCategory" class="form-control">
                                @if(isset($subCategories))
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{$subCategory->id}}">{{$subCategory->sub_category_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="addName" class="control-label">Title</label>
                            <input type="text" name="addName" id="addName" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="addDescription" class="control-label">Information</label>
                            <textarea name="addDescription" id="addDescription" class="form-control" cols="30" rows="8"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="addPrice" class="control-label">Price</label>
                            <input type="text" name="addPrice" id="addPrice" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="addInStock" class="control-label">In Stock</label>
                            <select name="addInStock" id="addInStock" class="form-control">
                                <option value="0">No</option>
                                <option value="1" selected>Yes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="addCountry" class="control-label">Country</label>
                            <input type="text" name="addCountry" id="addCountry" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <div class="spinner spinner-border spinner-border-sm"></div>
                        Add Product
                    </button>
                </div>
              </div>
            </form>
        </div>
      </div>
    <!-- //.========== ADD PRODUCT ============== -->


    <!-- ============== EDIT PRODUCT ==================== -->
    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editProductForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Tutorial</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                        <div class="form-group">
                            <label for="editCategory" class="control-label">Category</label>
                            <select name="editCategory" id="editCategory" class="form-control"></select>
                        </div>

                        <div class="form-group">
                            <label for="editName" class="control-label">Title</label>
                            <input type="text" name="editName" id="editName" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="editDescription" class="control-label">Information</label>
                            <textarea name="editDescription" id="editDescription" class="form-control" cols="30" rows="8"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="editPrice" class="control-label">Price</label>
                            <input type="text" name="editPrice" id="editPrice" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="editInStock" class="control-label">In Stock</label>
                            <select name="editInStock" id="editInStock" class="form-control">
                                <option value="0">No</option>
                                <option value="1" selected>Yes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="editCountry" class="control-label">Country</label>
                            <input type="text" name="editCountry" id="editCountry" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <div class="spinner spinner-border spinner-border-sm"></div>
                        Update Product
                    </button>
                </div>
              </div>
            </form>
        </div>
      </div>
    <!-- ================ // END OF EDIT PRODUCT ============== -->

@endsection

@section('extra_script')
    <script>
        $(function(){

            function allProducts()
            {
                $("#productsDataTable").DataTable();
                $('#productsDataTable .spinner').hide();
            }
            allProducts();


        //Fetch products by subcategory
        function productBySubCategory(){
            $('.top_category_btn').on('click', function(e){
                e.preventDefault();
                var subCategory_id = e.currentTarget.dataset.subcategory_id;
                //alert(subCategory_id);
                $("#productsDataTable_wrapper").remove();
                $('#productsDataTable').remove();
                $('#productsDataTable_length').remove();
                $('#productsDataTable_filter').remove();
                $('#productsDataTable_info').remove();
                $('#productsDataTable_paginate').remove();
                $('#productsTableDiv').append(`
                <table id="productsDataTable" width="100%" style="font-size: 100%; width:100%;" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="font-size: 11px; width:50px;">TYPE</th>
                        <th style="font-size: 11px; width:30px;">COUNTRY</th>
                        <th style="font-size: 11px; width:300px;">INFORMATION</th>
                        <th style="font-size: 11px; width:15px;">PRICE</th>
                        <th style="font-size: 11px; width:200px; text-align:center;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody id="productsTbody">
                </tbody>
                </table>
                `);

                $('#productsDataTable').DataTable({
                    ajax: {
                        url: `/admin/products/by-subcategory/${subCategory_id}`,
                        dataSrc: 'products'
                    },
                    columns:[
                        {data: 'type'},
                        {
                            data: 'country',
                            render: function(country){
                                return `${country ? country : 'None'}`;
                            }
                        },
                        {data: 'name'},
                        {
                            data: 'price',
                            render: function(price){
                                return `$${price}`;
                            }
                        },
                        {
                            data: 'id',
                            render: function(id){
                                return `
                                <a href="#" class="view_product btn btn-info btn-sm" data-product_id="${id}">
                                <i class="fa fa-file-archive-o"></i>
                                <div class="spinner spinner-border spinner-border-sm" style="display:none"></div>
                                 View</a>
                                <a href="#" class="edit_product btn btn-success btn-sm" data-product_id="${id}"><i class="fa fa-edit"></i> Edit</a>
                                <a href="#" class="delete_product btn btn-danger btn-sm" data-product_id="${id}">
                                <i class="fa fa-remove"></i>
                                <div class="spinner spinner-border spinner-border-sm" style="display:none"></div>
                                Delete</a>
                                `;
                            }
                        }
                    ],
                    "scrollY": true
                });

                viewProduct();
                editProduct();
                deleteProduct();
            });
        }
        productBySubCategory();


        // =========================== VIEW PRODUCT DETAILS
        function viewProduct()
            {
                $("#productsTbody").on('click', '.view_product', function(e){
                    e.preventDefault();
                    $("#viewProductModal").modal('show');
                    var product_id = e.currentTarget.dataset.product_id;
                    $.ajax({
                        url: `/admin/products/view/${product_id}`,
                        method: 'get',
                        beforeSend: function(){
                            e.currentTarget.children[1].style.display = 'inline-block';
                        },
                        complete: function(){
                            e.currentTarget.children[1].style.display = 'none';
                        },
                        success: function(res){
                            $("#viewProductModal .modal-body .modal-body-content").remove();
                            $("#viewProductModal .modal-body").append(`
                            <div class="modal-body-content">
                            <h5>TITLE: ${res.product.name}</h5>

                            <p><strong>DESCRIPTION:<strong><br>
                             ${res.product.description}
                            </p>

                            <p>
                                <strong>PRICE:</strong>
                                <span>${res.product.price}</span>
                            </p>

                            <p>
                                <strong>COUNTRY:</strong>
                                <span>${res.product.country ? res.product.country : 'N/A'}</span>
                            </p>

                            <p>
                                <strong>TYPE:</strong>
                                <span>${res.product.type}</span>
                            </p>
                            </div>
                            `);
                            $("#viewProductModal").modal('show');
                        }
                    });

                });
            }
            viewProduct();
        // ====================== END OF VIEW PRODUCT DETAILS

        // ============================== Add New Product
        function addProduct(){
            $("#addProductBtn").on('click', function(){
                $("#addProductModal").modal('show');
                    $('#addProductModal .spinner').hide();
                    $("#addProductForm").submit(function(e){
                        e.preventDefault();
                        var csrfToken = $("input[name=_token]");
                        var category = $("select[id=addCategory]");
                        var name = $("input[id=addName]");
                        var description = $("textarea[id=addDescription]");
                        var price = $("input[id=addPrice]");
                        var inStock = $("select[id=addInStock]");
                        var country = $("input[id=addCountry]");
                        $.ajax({
                            url: '/admin/product/store',
                            method: 'POST',
                            dataType: 'JSON',
                            data:{
                                '_token' : csrfToken.val(),
                                'sub_category_id': category.val(),
                                'name': name.val(),
                                'description': description.val(),
                                'price' : price.val(),
                                'in_stock' : inStock.val(),
                                'country'  : country.val()
                            },
                            beforeSend: function(){
                                $('#addProductModal .spinner').show();
                            },
                            complete: function(){
                                $('#addProductModal .spinner').hide();
                            },
                            success: function(res){
                                console.log(res)
                                if(res.errors){
                                    $("span.error_msg").remove();
                                    $(`<span style="font-size:12px; color:red;" class="error_msg">${res.errors.name ? res.errors.name : ''}</span>`).insertBefore(name);
                                    $(`<span style="font-size:12px; color:red;" class="error_msg">${res.errors.description ? res.errors.description : ''}</span>`).insertBefore(description);
                                    $(`<span style="font-size:12px; color:red;" class="error_msg">${res.errors.price ? res.errors.price : ''}</span>`).insertBefore(price);
                                }

                                if(res.success){
                                    swal(res.success, {icon: "success"});
                                    window.location.reload();
                                }
                            }
                        });
                    });
                });
        }
        addProduct();

        // ============================ AND OF ADD PRODUCT


        //===================== EDIT / UPDATE PRODUCT
        function editProduct(){
                $("#productsTbody").on('click', '.edit_product', function(e){
                    e.preventDefault();
                    var productID = e.currentTarget.dataset.product_id;
                    var subCategories = {!! $subCategories !!};
                    $.ajax({
                        url: '/admin/product/edit/' + productID,
                        method:'GET',
                        success: function(res){
                            $("select[id=editCategory] option").remove();
                            $.each(subCategories, function(k, v){
                                $("select[id=editCategory]").append(`
                                <option value="${v.id}" ${(v.id === res.product.sub_category_id) ? 'selected' : ''}>${v.sub_category_name}</option>
                                `);
                            });
                            $(`<input type="hidden" name="productID" value="${res.product.id}">`)
                            .insertAfter($("input[name=_token]"));
                            $("input[id=editName]").val(res.product.name);
                            $("textarea[id=editDescription]").val(res.product.description);
                            $("input[id=editPrice]").val(res.product.price);
                            $("input[id=editCountry]").val(res.product.country);
                            $("select[id=editInStock] option").remove();
                            $("select[id=editInStock]").append(`
                            <option value="1" ${res.product.in_stock ? 'selected':''}>Yes</option>
                            <option value="0" ${res.product.in_stock ? '':'selected'}>No</option>
                            `);
                        }
                    });
                    $("#editProductModal").modal('show');
                    $('#editProductModal .spinner').hide();
                });
            }
            editProduct();

            function updateProduct()
            {
                $("#editProductForm").submit(function(e){
                    e.preventDefault();
                    var productID = $("input[name=productID]").val();
                    var csrfToken = $("input[name=_token]");
                    var category = $("select[id=editCategory]");
                    var name = $("input[id=editName]");
                    var description = $("textarea[id=editDescription]");
                    var price = $("input[id=editPrice]");
                    var inStock = $("select[id=editInStock]");
                    var country = $("input[id=editCountry]");
                    $.ajax({
                        url: '/admin/product/update/' + productID,
                        method: 'POST',
                        dataType: 'JSON',
                        data:{
                            '_token': csrfToken.val(),
                            'sub_category_id': category.val(),
                            'name' : name.val(),
                            'description': description.val(),
                            'price' : price.val(),
                            'in_stock': inStock.val(),
                            'country' : country.val()
                        },
                        beforeSend: function(){
                            $('#editProductModal .spinner').show();
                        },
                        complete: function(){
                            $('#editProductModal .spinner').hide();
                        },
                        success: function(res){
                            if(res.errors){
                                $('span.error_msg').remove();
                                $(`<span class="error_msg" style="font-size:12px;color:red;">${res.errors.name ? res.errors.name : ''}</span>`).insertBefore(name);
                                $(`<span class="error_msg" style="font-size:12px;color:red;">${res.errors.description ? res.errors.description : ''}</span>`).insertBefore(description);
                                $(`<span class="error_msg" style="font-size:12px;color:red;">${res.errors.price ? res.errors.price : ''}</span>`).insertBefore(price);
                            }

                            if(res.success){
                                swal(res.success, {icon: "success"});
                                window.location.reload();
                            }
                        }
                    });
                });
            }
            updateProduct();
        //=================== END OF EDIT/UPDATE PRODUCT



        //=================== DELETE PRODUCT ===============
        function deleteProduct()
            {
                $("#productsTbody").on('click', '.delete_product', function(e){
                    e.preventDefault();
                    var spinner = e.currentTarget.children[1];
                    console.log(e.currentTarget.children[1]);
                    var product_id = e.currentTarget.dataset.product_id;
                    spinner.style.display = 'inline-block';
                    swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: `/admin/product/delete/${product_id}`,
                            method: 'get',
                            beforeSend: function(){},
                            complete: function(){
                                e.currentTarget.children[1].style.display = 'none';
                            },
                            success:function(res){
                                if(res.success){
                                   swal(res.success, {icon: "success"})
                                   window.location.reload();
                                }
                            }
                        });
                    } else {
                        swal("Product deleting cancel");
                        e.currentTarget.children[1].style.display = 'none';
                    }
                    });
                });
            }
            deleteProduct();
        //=============== END OF DELETE PRODUCT =================

        });
    </script>
@endsection
