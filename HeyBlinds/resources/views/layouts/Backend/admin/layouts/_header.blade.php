<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{url('admin/images/favicons/apple-touch-icon.png')}}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('admin/images/favicons/favicon-32x32.png')}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('admin/images/favicons/favicon-16x16.png')}}" />
    <link rel="manifest" href="{{url('admin/images/favicons/site.webmanifest')}}" />

    <!-- Style sheet import -->
    <link rel="stylesheet" id="bootstrap-css" href="{{asset('admin/css/bootstrap.min.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="dataTables-bootstrap5" href="{{asset('admin/css/dataTables.bootstrap5.min.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="summernote-min" href="{{asset('admin/css/summernote.min.css')}}" type="text/css" media="all" />
    
    <link rel="stylesheet" id="jquery-ui" href="{{asset('admin/css/jquery-ui.css')}}"/>
    <link href="{{asset('admin/css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admin/css/toastr.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin/css/daterangepicker.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin/css/daterangepicker.min.css')}}"/>
    
    
    <link rel="stylesheet" id="style-css" href="{{asset('admin/css/style.css?var=').time()}}" type="text/css" media="all" />

    <!-- Google fonts import -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400&display=swap"
        rel="stylesheet"/>

        <!-- fontawesome import -->
    <script type="text/javascript" src="https://kit.fontawesome.com/4bb008fe2b.js"></script>
    <!-- jquery import -->
    <script src="{{asset('admin/js/jquery-3.4.1.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('admin/js/moment.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('admin/js/daterangepicker.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('admin/js/jquery.daterangepicker.min.js')}}"></script>
    <script type='text/javascript' src='{{asset('admin/js/bootstrap.min.js')}}'></script>
    <script type='text/javascript' src="{{asset('admin/js/jquery-ui.js')}}"></script>
    <script type='text/javascript' src='{{asset('admin/js/summernote.min.js')}}'></script>
    <script type='text/javascript' src="{{asset('admin/js/select2.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('admin/js/axios.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('admin/js/jquery.validate.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('admin/js/toastr.min.js')}}"></script>
    <!-- for data table -->
     <script type='text/javascript' src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('admin/js/dataTables.bootstrap5.min.js')}}"></script>
   
    <script type='text/javascript' src='{{asset('admin/js/master.js')}}'></script>   
    <script type='text/javascript' src='{{asset('admin/js/totalscrpit.js')}}'></script>
    
    <script type="text/javascript">
        jQuery(function() {
           axios.defaults.withCredentials = true;
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           //$('[data-toggle="tooltip"]').tooltip();
       })
    </script>
</head>
