@if ($errors->any())
    <div class="alert alert-danger">
         {{--   <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>  --}}
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
       </ul>
   </div>
@endif


@if ($message = Session::get('success'))
    <div  role="alert" class="alert alert-success alert-block alert-dismissible fade show">
          {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>  --}}
          <strong>{{ $message }}</strong>
    </div>
@endif