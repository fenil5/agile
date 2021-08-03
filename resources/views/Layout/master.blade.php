<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Basic Form</title>

    <link href="{{ url('public/web/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/web/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ url('public/web/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ url('public/web/css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('public/web/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('public/web/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

    <link href="{{ url('public/web/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

    @include('Layout.sidebar')

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            

        </nav>
        </div>
            
        <div class="wrapper wrapper-content animated fadeInRight">
                @yield('content')
        
        </div>
        @include('Layout.footer')

        </div>
        </div>



        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
</body>

</html>
