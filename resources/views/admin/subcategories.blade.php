@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12" style="margin: 3% auto; text-align:center; padding:20px 10px 0 10px;">
            <div class="card card-blue">
                <div class="card-header">
                    <h3 class="card-title">Product Main Categories</h3>
                </div>
                <div class="card-body">
                    <p>
                        <a href="{{route('admin.subcategories')}}" class="badge badge-pill badge-success" style="font-size: 14px; margin-bottom:10px;">All</a>
                        @if(isset($categories))
                            @foreach ($categories as $category)
                            <a href="#" data-category_id="{{$category->id}}" class="badge badge-pill badge-success top_category_btn" style="font-size: 14px; margin-bottom:10px;">{{$category->category_name}}</a>
                            @endforeach
                        @endif
                    </p>
                </div>
            </div>

        </div>

        <div class="col-md-12 col-sm-12 mt-0">
            <div class="card card-blue">
                <div class="card-header">
                    <h2 class="card-title">{{ $title }}</h2> &nbsp;
                    <button id="addSubCategoryBtn" class="btn btn-sm btn-danger fa-pull-right">
                        Add Sub Category
                    </button>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body" id="categoryTableDiv">
                    <table id="categoryDataTable" width="100%" style="font-size: 100%; width:100%;" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="font-size: 11px; width:50px;">CATEGORY</th>
                                <th style="font-size: 11px; width:30px;">SUBCATEGORY</th>
                                <th style="font-size: 11px; width:15px; text-align:center;">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

      <!-- Modal - Add Product Modal -->
    <div class="modal fade" id="addSubCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addSubCategoryForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                        <div class="form-group">
                            <label for="addCategory" class="control-label">Main Category</label>
                            <select name="addCategory" id="addCategory" class="form-control">
                                <option value="">Select Main Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="addSubCategory" class="control-label">Sub Category</label>
                            <input type="text" name="addSubCategory" id="addSubCategory" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <div class="spinner spinner-border spinner-border-sm"></div>
                        Add Category</button>
                </div>
              </div>
            </form>
        </div>
      </div>



        <!-- Modal - Edit Product Modal -->
        <div class="modal fade" id="editSubCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editSubCategoryForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                            <div class="form-group">
                                <label for="editCategory" class="control-label">Main Category</label>
                                <select name="editCategory" id="editCategory" class="form-control">
                                    <option value="">Select Main Category</option>
                                    <option value="1">Account</option>
                                    <option value="2">Tool</option>
                                    <option value="3">Tutorial</option>
                                    <option value="4">Premium RDP</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="editSubCategory" class="control-label">Sub Category</label>
                                <input type="text" name="editSubCategory" id="editSubCategory" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">
                            <div class="spinner spinner-border spinner-border-sm"></div>
                            Update Category
                        </button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
@endsection

@section('extra_script')
    <script>
        $(function(){

            function allSubCategories()
            {
                $("#categoryDataTable").DataTable({
                ajax: {
                    url: '/admin/sub-categories',
                    dataSrc: 'subCategories'
                },
                columns: [
                    {data: 'category_name'},
                    {data: 'sub_category_name'},
                    {
                        data: 'id',
                        render: function(id){
                            return `
                            <a href="#" class="edit_sub_category btn btn-success btn-sm" data-sub_category_id="${id}"><i class="fa fa-edit"></i> Edit</a>
                            <a href="#" class="delete_sub_category btn btn-danger btn-sm" data-sub_category_id="${id}"><i class="fa fa-remove"></i>
                                <div class="spinner spinner-border spinner-border-sm" style="display:none;"></div>
                            Delete</a>
                            `;
                        }
                    }
                ],
                "scrollY": true
            });
        }
        allSubCategories();



            // Prodcuts Category buttons at the top
            $('.top_category_btn').on('click', function(e){
                e.preventDefault();
                var category_id = e.currentTarget.dataset.category_id;
                $("#categoryDataTable_wrapper").remove();
                $('#categoryDataTable').remove();
                $('#categoryDataTable_length').remove();
                $('#categoryDataTable_filter').remove();
                $('#categoryDataTable_info').remove();
                $('#categoryDataTable_paginate').remove();
                $('#categoryTableDiv').append(`
                <table id="categoryDataTable" width="100%" style="font-size: 100%; width:100%;" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="font-size: 11px; width:50px;">CATEGORY</th>
                        <th style="font-size: 11px; width:30px;">SUBCATEGORY</th>
                        <th style="font-size: 11px; width:15px; text-align:center;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody id="categoryTbody">
                </tbody>
                </table>
                `);

                $('#categoryDataTable').DataTable({
                    ajax: {
                        url: `/admin/sub-categories/${category_id}`,
                        dataSrc: 'subCategory'
                    },
                    columns:[
                        {data: 'category_name'},
                        {data: 'sub_category_name'},
                        {
                            data: 'id',
                            render: function(id){
                                return `
                                <a href="#" class="edit_sub_category btn btn-success btn-sm" data-sub_category_id="${id}"><i class="fa fa-edit"></i> Edit</a>
                                <a href="#" class="delete_sub_category btn btn-danger btn-sm" data-sub_category_id="${id}"><i class="fa fa-remove"></i>
                                <div class="spinner spinner-border spinner-border-sm" style="display:none;"></div>
                                Delete</a>
                                `;
                            }
                        }
                    ],
                    "scrollY": true
                });

                editSubCategory();
                deleteSubCategory();
            });
            // END ---- Prodcuts Category buttons at the top

            //============== Add Sub Category ====================
            function addSubCategory(){
                $("#addSubCategoryBtn").on('click', function(){
                    $("#addSubCategoryModal").modal('show');
                    $("#addSubCategoryForm div.spinner").hide();
                    $("#addSubCategoryForm").submit(function(e){
                        e.preventDefault();
                        var csrfToken = $("input[name=_token]");
                        var category = $("select[id=addCategory]");
                        var subCategory = $("input[id=addSubCategory]");
                        $.ajax({
                            url: '/admin/sub-category/add',
                            method: 'POST',
                            dataType: 'JSON',
                            data:{
                                '_token' : csrfToken.val(),
                                'category_id': category.val(),
                                'sub_category_name': subCategory.val()
                            },
                            beforeSend: function(){
                                $("#addSubCategoryForm div.spinner").show();
                            },
                            complete: function(){
                                $("#addSubCategoryForm div.spinner").hide();
                            },
                            success: function(res){
                                console.log(res)
                                if(res.errors){
                                    $("span.error_msg").remove();
                                    $(`<span style="font-size:12px; color:red;" class="error_msg">${res.errors.category_id ? res.errors.category_id : ''}</span>`).insertBefore(category);
                                    $(`<span style="font-size:12px; color:red;" class="error_msg">${res.errors.sub_category_name ? res.errors.sub_category_name : ''}</span>`).insertBefore(subCategory);
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
            addSubCategory();


            //================ Update Product ==================

            function editSubCategory(){
                $("#categoryTbody").on('click', '.edit_sub_category', function(e){
                    $("#editSubCategoryForm div.spinner").hide();
                    e.preventDefault();
                    var sub_category_id = e.currentTarget.dataset.sub_category_id;
                    $.ajax({
                        url: '/admin/sub-category/edit/' + sub_category_id,
                        method:'GET',
                        success: function(res){
                            $(`<input type="hidden" name="sub_category_id" value="${res.subCategory.id}">`)
                            .insertAfter($("input[name=_token]"));

                            $("select[name=editCategory] option").remove();
                            $("select[name=editCategory]").append(`<option value="">Select Main Category</option>`);
                            $.each(res.categories, function(k, v){
                                $("select[name=editCategory]").append(`
                                <option value="${v.id}" ${(v.id === res.subCategory.category_id) ? "selected" : ""}>${v.category_name}</option>
                                `);
                            });

                            $("input[id=editSubCategory]").val(res.subCategory.sub_category_name);
                        }
                    });
                    $("#editSubCategoryModal").modal('show');
                });
            }
            editSubCategory();
            //================ END OF uPDATE pRODUCT


            function updateSubCategory()
            {
                $("#editSubCategoryForm").submit(function(e){
                    e.preventDefault();
                    var sub_category_id = $("input[name=sub_category_id]").val();
                    var csrfToken = $("input[name=_token]");
                    var category = $("select[id=editCategory]");
                    var subCategory = $("input[id=editSubCategory]");
                    $.ajax({
                        url: '/admin/sub-category/update/' + sub_category_id,
                        method: 'POST',
                        dataType: 'JSON',
                        data:{
                            '_token': csrfToken.val(),
                            'category_id': category.val(),
                            'sub_category_name' : subCategory.val()
                        },
                        beforeSend: function(){
                            $("#editSubCategoryForm div.spinner").show();
                        },
                        complete: function(){
                            $("#editSubCategoryForm div.spinner").hide();
                        },
                        success: function(res){
                            if(res.errors){
                                $('span.error_msg').remove();
                                $(`<span class="error_msg" style="font-size:12px;color:red;">${res.errors.category_id ? res.errors.category_id : ''}</span>`).insertBefore(category);
                                $(`<span class="error_msg" style="font-size:12px;color:red;">${res.errors.sub_category_name ? res.errors.sub_category_name : ''}</span>`).insertBefore(subCategory);
                            }

                            if(res.success){
                                swal(res.success, {icon: "success"});
                                window.location.reload();
                            }
                        }
                    });
                });
            }
            updateSubCategory();


            // Delete Account
            function deleteSubCategory()
            {
                $("#categoryTbody").on('click', '.delete_sub_category', function(e){
                    e.preventDefault();
                    var sub_category_id = e.currentTarget.dataset.sub_category_id;
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
                            url: `/admin/sub-category/delete/${sub_category_id}`,
                            method: 'get',
                            beforeSend: function(){
                                e.currentTarget.children[0].style.display = 'none';
                                e.currentTarget.children[1].style.display = 'inline-block';
                            },
                            complete: function(){
                                e.currentTarget.children[0].style.display = 'inline-block';
                                e.currentTarget.children[1].style.display = 'none';
                            },
                            success:function(res){
                                if(res.success){
                                   swal(res.success, {icon: "success"})
                                   e.currentTarget.parentNode.parentNode.remove();
                                }
                            }
                        });
                    } else {
                        swal("Product deleting cancel");
                    }
                    });
                });
            }
            deleteSubCategory();
        });
    </script>
@endsection
