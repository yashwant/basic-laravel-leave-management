<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Basic Leave Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{HTML::style('http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css')}}
        {{HTML::style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker.css')}}
        <style>
            body{
                padding-top: 70px;
            }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="container-fluid">
                <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="/">Leave Management</a>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                @if (Auth::check())
                                @if (Auth::user()->is_admin)
                                <li><a href="{{ route('admin_leave_pening'); }}">Admin Dashboard</a></li>
                                <li><a href="{{ route('leave_show'); }}">Dashboard</a></li>
                                @else
                                <li><a href="{{ route('leave_show'); }}">Dashboard</a></li>
                                @endif
                                <li><a href="{{ route('logout'); }}">Log Out</a></li>
                                <li><a href="{{ route('profile'); }}">{{ Auth::user()->first_name }}</a></li>
                                @else
                                <li><a href="{{ route('login'); }}">Login</a></li>
                                <li><a href="{{ route('user.create'); }}">Sign Up</a></li>
                                @endif
                            </ul>

                        </div><!-- /.navbar-collapse -->
                    </div>
                </nav>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        @if(Session::has('message'))

                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h2>{{ Session::get('message') }}</h2>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @yield('body')
        </div>
        {{HTML::script('http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js')}}
        {{HTML::script('http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js')}}
        {{HTML::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.js')}}
        @show
        <script type = "text/javascript" >
            //    $(".form_datetime").datepicker({
            //        format: 'd-m-yyyy',
            //        autoclose: true,
            //        todayBtn: true
            //    });
            var start1Date = new Date();
            var From1EndDate = new Date();
            var To1EndDate = new Date();
            var start2Date = new Date();
            var From2EndDate = new Date();
            var To2EndDate = new Date();

            To1EndDate.setDate(To1EndDate.getDate() + 365);

            $('.from_date').datepicker({
                format: 'd-m-yyyy',
                weekStart: 1,
                startDate: start1Date,
                endDate: To1EndDate,
                autoclose: true
            })
            .on('changeDate', function (selected) {
                start1Date = new Date(selected.date.valueOf());
                start1Date.setDate(start1Date.getDate(new Date(selected.date.valueOf())));
                $('.to_date').datepicker('setStartDate', start1Date);
                var new_end = new Date();
                new_end.setDate(start1Date.getDate() + 7);
                $('.to_date').datepicker('setEndDate', new_end);

                console.log('new_start');
                console.log(start1Date);
                console.log('new_end');
                console.log(new_end);
            });
            $('.to_date')
                    .datepicker({
                        format: 'd-m-yyyy',
                        weekStart: 1,
                        startDate: start2Date,
                        endDate: To2EndDate,
                        autoclose: true
                    })
                    .on('changeDate', function (selected) {
                        //FromEndDate = new Date(selected.date.valueOf());
                        //FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
                        //$('.from_date').datepicker('setEndDate', FromEndDate);
                    });

        </script>
    </body>
</html>