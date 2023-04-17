@extends('layouts.Backend.admin.admin')
@section('content')
@push('css')

@endpush

    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                     aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Colours</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">Colour Management</h3>
            </div>
        </div>
        <div class="bg-white rounded page-height mt-3 shadow">
            @include('partial.message')
            <div class="p-4">
                <div class="pt-2">
                    <h5>Add a New Colour</h5>
                </div>
                <form action="{{ route('admin.color.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="pt-2 justify-content-center">
                        <div class="color-records pb-3">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="row gx-2">

                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control" name="vendor_color_name"
                                                       value="{{ old('vendor_color_name') }}" id="vendor_color_name"
                                                       placeholder="Vendor Colour Name *">
                                                <label for="vendor_color_name">Vendor Colour Name <span class="text-primary">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control" name="vendor_color_id"
                                                       value="{{ old('vendor_color_id') }}" id="vendor_color_id"
                                                       placeholder="Colour Colour ID *">
                                                <label for="vendor_color_id">Vendor Colour ID <span class="text-primary">*</span></label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control" name="name"
                                                       value="{{ old('name') }}" id="name" placeholder="Our Colour Name *">
                                                <label for="name">Our Colour Name <span class="text-primary">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">

                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control" name="color_id" id="color_id"
                                                       value="{{ old('color_id') }}" placeholder="Our Colour ID *">
                                                <label for="color_id">Our Colour ID <span class="text-primary">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <div class="check-box d-inline-block pt-4 ">
                                                <input type="checkbox" id="out_of_stock" name="out_of_stock"
                                                       {{ old('out_of_stock') == 1 ? 'checked' : '' }} value="1">
                                                <label for="out_of_stock">Out Of Stock</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mt-3">
                                            <label for="group_name" class="pb-2">Colour Group Name <span class="text-primary">*</span></label>
                                            <select class="form-control add-colour-name" id="group_name"
                                                    name="color_group_id">
                                                <option value="">Select Colour Group </option>
                                                @foreach ($allGroups as $group)
                                                    <option value="{{ $group->id }}"
                                                        {{ old('color_group_id') == $group->id ? 'selected' : '' }}>
                                                        {{ $group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-1 ps-3 mt-4">
                                            <div class="check-box d-inline-block pt-4">
                                                <input type="checkbox" id="enable-check" name="is_enable"
                                                       {{ old('is_enable') == 1 ? 'checked' : '' }} value="1" >
                                                <label for="enable-check">Enable</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-1 ps-3 mt-3">
                                            <label for="enable-check-quantity" class="pb-2">Quantity <span class="text-primary">*</span></label>
                                            <input type="number" id="enable-check-quantity" value="{{old('quantity')}}" class="form-control"
                                                   name="quantity">
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6 mt-3">
                                            <label class="mb-2 form-label">Colour Image</label>
                                            <div id="myId" class="fallback">
                                                <input type="file" name="image" class="form-control"
                                                       value="{{ old('image') }}" accept="image/*" >
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6 mt-3">
                                            <label class="mb-2 form-label">Featured Image</label>
                                            <div class="fallback">
                                                <input class="form-control" type="file" name="feature"
                                                       value="{{ old('feature') }}" accept="image/*">
                                            </div>
                                        </div>

                                        <div class="col-lg-1 col-md-3 col-sm-6 col-6 d-flex align-items-end">
                                            <button
                                                class="btn btn-primary btn-sm pe-3 d-flex align-items-center add-more-color ms-auto">
                                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                </svg> -->
                                                <span class="d-none d-md-block save-data">Save</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

               
                <div class="col-md-12 text-md-end">
                    {{-- <button type="button" class="btn btn-primary h-100 px-4" id="download">Export</button> --}}
                    <a href="{{ url('/admin/color/color-export') }}" class="btn btn-primary h-100 px-4" id="">Export</a>
                </div>
                 <div class="table-responsive mt-2">
                    <table class="table colourtable w-100 " id="color-table">
                        <thead class="text-white bg-secondary">
                        <tr>
                            <th class="col py-2">#</th>
                            <th class="col py-2">Vendor Name</th>
                            <th class="col py-2">Vendor ID</th>
                            <th class="col py-2">Display Name</th>
                            <th class="col py-2">Colour ID</th>
                            <th class="col py-2">Colour Image</th>
                            <th class="col py-2">Colour Group</th>
                            <th class="col py-2">Featured Image</th>
                            <th class="col py-2">Disclaimer <input type="checkbox" id="example-select-all" name="disclaimer"></th>
                            <th class="col py-2"> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('js')

    <script>
        
        jQuery(document).ready(function () {
           
            var table  = $('#color-table').DataTable({
                processing: true,
                serverSide: true,
                ordering : false,
                ajax: {
                    method : "GET",
                    url: '/admin/color',
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'vendor_color_name', name: 'vendor_color_name' },
                    { data: 'vendor_color_id', name: 'vendor_color_id' },
                    { data: 'name', name: 'name' },
                    { data: 'color_id', name: 'color_id' },
                    { data: 'color_image', name: 'color_image' },
                    { data: 'group_name', name: 'group_name' },
                    { data: 'feature_image', name: 'feature_image' },
                    { data: 'disclaimer', name: 'disclaimer' },
                    { data: 'action', name: 'action' },
                ],
            })
            $('#download').click(function($e){
                axios.post('/admin/color/color-export').then((response)=>{
                    window.location="/admin/color";
                })
            })
            $('#example-select-all').on('click', function(){
                var rows = table.rows({ 'search': 'applied' }).nodes();
                    $('input[type="checkbox"]', rows).prop('checked', this.checked);
                    var value = '';
                    if(this.checked){
                        value = 'checked';
                    }
                    else{
                        value = 'unchecked';
                    }
                    axios.post('/admin/checked-color-update',{
                        'data':value 
                    }).then((response)=>{
                    })
                  
            });
            var all_checkboxes = $('#color-table input[type="checkbox"]');

            if (all_checkboxes.length === all_checkboxes.filter(":checked").length) {
                    
                }
            
        });
        function colorDelete(id){
            if (!confirm('Are you sure you want to delete this item')) return false;
            axios.delete(`/admin/color/${id}`).then((response)=>{
                if(response.data.status ===true){
                    $('#color-table').DataTable().ajax.reload();
                    toastr.success('Successfully deleted!');
                }
            })
            return true;
        }
        function checkedUnchecked(id){
            axios.put(`/admin/color/checked/${id}`).then((response)=>{
                if(response.data.status ===true){
                   // $('#color-table').DataTable().ajax.reload();
                    //toastr.success('Successfully deleted!');
                }
            })
        }
    </script>
    @endpush
@endsection
