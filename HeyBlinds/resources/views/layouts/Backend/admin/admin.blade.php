<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.Backend.admin.layouts._header')

@yield('style')

@stack('js')

@yield('scripts')

<body>
@include('layouts.Backend.admin.layouts._loader')
@include('layouts.Backend.admin.layouts._header-menu')

<section id="body-content" class="">
    @yield("content")
</section>
@include('layouts.Backend.admin.layouts._footer')
<div class="modal fade" id="exampleModaltwo" data-target="#exampleModaltwo" tabindex="-1" data-controls-modal="exampleModaltwo" aria-labelledby="exampleModalLabeltwo" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content p-4 border-0">

            <div class="modal-body p-0 text-center">
                <div class="text-primary pb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                        class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                    </svg>
                </div>

                <h6 id="alert_message">Alert Message Here</h6>

                <div class="pt-3">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" id="model-no">No</button>
                    <button type="button" class="btn btn-sm btn-primary" id="model-yes">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(function ($) {
        $('#exampleModaltwo').modal({backdrop: 'static', keyboard: false}) ;
        $(document).on('keyup', 'input[type="number"]', function (){
            let num = $(this);
            var posNum = (num.val() < 0) ? 0 : num.val();
            num.val(posNum);
        })
    })
    function removeMedia(id,table=''){
        if(confirm("Are You Sure to delete this")){
           axios.post(`/admin/media/destroy/${id}`,{
            'table': table
           }).then((response) =>{
                if(response.data.status == true){
                    toastr.success(response.data.message);
                    window.location.reload();
                }else{
                    toastr.error(response.data.message);
                }
            })
        }
    }
</script>
<script type="text/javascript">
    
</script>
</body>
</html>
