@extends('layouts.Backend.admin.admin')
@section('content')
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Products</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">All Products</h3>
            </div>
            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                <!-- <button class="btn btn-light">New view</button> -->
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary d-flex align-items-center">
                    <span class="">Create New Product</span>
                </a>
            </div>
        </div>
        <div class="bg-white rounded page-height mt-3 shadow position-relative">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="p-lg-4 p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="productaccordion">
                            <div class="table-responsive">
                                <table class="table table-hover colourtable w-100" id="product-table">
                                    <thead class="text-white bg-secondary">
                                        <tr>
                                            <th scope="col py-2">#</th>
                                            <th scope="col py-2">Name</th>
                                            <th scope="col py-2">SKU</th>
                                            <th scope="col py-2">Stock</th>
                                            <th scope="col py-2">Category</th>
                                            <th scope="col py-2">Subcategory</th>
                                            <th scope="col py-2">Show home page</th>
                                            <th scope="col py-2">Display Image</th>
                                            <th scope="col py-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable sortable">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(function() {
                $('#product-table').DataTable({
                    processing: true,
                    serverSide: true,
                    language: {
                        searchPlaceholder: "Product name or SKU"
                    },
                    ordering: false,
                    "iDisplayLength": 50,
                    ajax: {
                        method: 'POST',
                        url: '/admin/product-search'
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'sku',
                            name: 'sku'
                        },
                        {
                            data: 'stock',
                            name: 'stock'
                        },
                        {
                            data: 'category_name',
                            name: 'category_name'
                        },
                        {
                            data: 'subcategory_name',
                            name: 'subcategory_name'
                        },
                        {
                            data: 'show_home_page',
                            name: 'show_home_page'
                        },
                        {
                            data: 'image',
                            name: 'image'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                });
                $(".sortable").sortable({
                    stop: function(event, ui) {
                        var data = $(this).sortable('serialize');
                        console.log(data);
                        $.ajax({
                            data: {
                                "data": data,
                                "where": "id",
                                "t": "products",
                            },
                            type: 'POST',
                            url: '{{ route('global.sort') }}'
                        });
                    }
                });

            })
        </script>
        <script type="text/javascript">
            function checkedUnchecked(product_id) {
                const checked = $("#show_home_page").is(":checked");
                axios.post(`/admin/product/show-home-page`, {
                    product_id: product_id,
                    is_active: checked
                }).then((response) => {

                }).catch((errors) => {

                })
            }

            function delteProduct(id) {
                if (!confirm('Are you sure you want to delete this item')) return false;
                axios.delete(`/admin/product/${id}`).then((response) => {
                    if (response.data.status === true) {
                        $('#product-table').DataTable().ajax.reload();
                        toastr.success('Successfully deleted!');
                    }
                })
                return true;
            }
        </script>
    @endpush
@endsection
