<div class="shadow p-4 rounded">
    <h5 class="font-secondary fw-bold">
        Welcome, {{auth()->user()->first_name}} {{auth()->user()->last_name}}
    </h5>
    <hr class="mt-2"/>
    <ol class="list-group list-group-numbered">
        <li class="list-group-item ">
            <a class="{{(request()->is('user/my-account')) ? 'active':''}} d-flex justify-content-between align-items-start" href="{{ url('/user/my-account') }}">
                <span>
                    <svg class="bi bi-person-check me-2" fill="currentColor" height="16" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z">
                        </path>
                        <path d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" fill-rule="evenodd">
                        </path>
                    </svg>
                    My Account
                </span>
            </a>
        </li>
        <li class="list-group-item ">
            <a class=" {{(request()->is('user/my-order')) ? 'active':''}} d-flex justify-content-between align-items-start" href="{{url('/user/my-order')}}">
                <span>
                    <svg class="bi bi-cart-check me-2" fill="currentColor" height="16" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z">
                        </path>
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z">
                        </path>
                    </svg>
                    My Orders
                </span>
                <span class="badge bg-primary rounded-pill">
                    {{$helpers->orderItemCount() }}
                </span>
            </a>
        </li>
        <li class="list-group-item ">
            <a class="{{(request()->is('user/my-cart')) ? 'active':''}} d-flex justify-content-between align-items-start" href="{{url('user/my-cart')}}">
                <span>
                    <svg class="bi bi-save2 me-2" fill="currentColor" height="16" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z">
                        </path>
                    </svg>
                    Saved Carts
                </span>
                <span class="badge bg-primary rounded-pill text-right">
                    {{$helpers->cartItemCount()}}
                </span>
            </a>
        </li>
        <li class="list-group-item ">
            <a class="d-flex justify-content-between align-items-start" href="#" onclick="logoutFunction()">
                <span>
                    <svg class="bi bi-box-arrow-right me-2" fill="currentColor" height="16" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" fill-rule="evenodd">
                        </path>
                        <path d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" fill-rule="evenodd">
                        </path>
                    </svg>
                    Logout
                </span>
            </a>
        </li>
    </ol>
</div>

@push('js')
{{-- <script type="text/javascript">
    function logoutFunction(){
        axios.post('/user/logout')
        .then((response) =>{
            if(response.data.status == true){
                eraseCookie('__cart_items');
                window.location.href="/";
            }
        });
    }
</script> --}}
@endpush