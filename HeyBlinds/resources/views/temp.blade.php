<!DOCTYPE doctype html>
<html>
    <head>
        <title>
            Import CSV Data to MySQL database with Laravel
        </title>
    </head>
    <body>
        <!-- Message -->
        @if(Session::has('message'))
        <p>
            {{ Session::get('message') }}
        </p>
        @endif
        <!-- Form -->
        <form action="{{url('/demo-email')}}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <input name="csv_file" type="file">
                <input name="submit" type="submit" value="Import">
                </input>
            </input>
        </form>
    </body>
</html>
