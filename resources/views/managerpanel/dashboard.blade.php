<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Manager Dashboard</title>
        <link rel="stylesheet" href="{{ asset('managerpanel/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/fontawesome-all.css') }}" >
        <link rel="stylesheet" href="{{ asset('managerpanel/css/searchboxstyle.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/style.css?')}}"<?php echo time(); ?> >
        <link rel="stylesheet" href="{{ asset('managerpanel/css/responsive.css') }}" >
        <script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-core.min.js"></script>
        <script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-pie.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <script type="text/javascript" src="{{asset('adminpanel/js/echarts.min.js')}}"></script>
    </head>
    <body>
        <div class="main" id="main-site" style="background-image: url('{{ asset('managerpanel/images/login-bg.png')}}');">
            <div class="admin-dashboard manager-dashboard">
                <div class="container">
                    <div class="admin-dashboard-main">
                        <div class="admin-dashboard-leftsidebar">
                            <div class="admin-dashboard-leftsidebar-bg-part">
                                <div class="admin-dashboard-logo">
                                    <a href="{{ route('managerpanel.dashboard') }}">
                                        <img src="{{ asset('managerpanel/images/Logo_img.png') }}">
                                    </a>
                                </div>
                                <div class="admin-dashboard-menu-part">
                                    <ul>
                                        <li>
                                            <a href="{{ route('managerpanel.dashboard') }}" class="active">
                                                <img src="{{ asset('managerpanel/images/dashboard-icn.png') }}">
                                                <span>DASHBOARD</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('managerpanel.job.manage') }}">
                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                                                <span>Manage Task</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('managerpanel.tree.manage') }}">
                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                                            <span>Manage Tree</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('managerpanel.report.manage') }}">
                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                                                <span>Manage Report</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="admin-dashboard-messages-icn">
                                    <ul>
                                        <li>
                                            <a href="{{ route('managerpanel.logout') }}">
                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="admin-dashboard-right">
                            <div class="admin-dashboard-searchbar-part">
                                <div class="admin-dashboard-searchbar">
                                </div>
                                <div class="admin-dashboard-right-dtl">
                                    <h4>Hi {{ $managerName }} You are manager</h4>
                                    <div class="admin-notification">
                                    </div>
                                    <div class="admin-login-pr"> 
                                        @foreach ($manager as $d)
                                            <a href="{{ url('/managerpanel/editmanager/'.$d->id) }}"><img src="{{ $managerimage }}" style="max-width: 100%; max-height: 100%; width: auto; height: auto;"></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if(session()->has('success'))
                                <div class="alert alert-info">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">                    
                                    <p>{{$errors->first()}}</p>
                                </div>
                            @endif
                            <div class="admin-dashboard-box-main">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="admin-dashboard-sing-box">
                                        <div class="admin-dashboard-sing-box-head">
                                            <h2>Tasks:</h2>
                                            <h1>{{ $task }}</h1>
                                        </div>
                                        <div class="admin-dashboard-sing-box-dtl-main">
                                            <div class="admin-dashboard-sm-dtl">
                                                <h2>To Do:<strong>{{ $todo }}</strong></h2>
                                            </div>
                                            <div class="admin-dashboard-sm-dtl">
                                                <h2>In Progress:<strong>{{ $inprogress }}</strong></h2>
                                            </div>
                                            <div class="admin-dashboard-sm-dtl">
                                                <h2>Done<strong>{{ $done }}</strong></h2>
                                            </div>
                                        </div>
                                        <div class="admin-dashboard-sing-plus-icon">
                                            <a href="{{ route('managerpanel.job.manage') }}" style="color:white">View Details</a>
                                            <!-- <img src="{{ asset('managerpanel/images/plus.png') }}"> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="admin-dashboard-sing-box">
                                        <div class="admin-dashboard-sing-box-head">
                                            <h2>REPORTS:</h2> 
                                            <h1>{{ $Report }}</h1>
                                        </div>
                                        <div class="admin-dashboard-sing-box-dtl-main">
                                            <div class="admin-dashboard-sm-dtl">
                                                <h2>New:<strong>{{ $New }}</strong></h2>
                                            </div>
                                            <div class="admin-dashboard-sm-dtl">
                                                <h2>Checked:<strong>{{ $Checked }}</strong></h2>
                                            </div>
                                        </div>
                                        <div class="admin-dashboard-sing-plus-icon">
                                      
                                            <a href="{{ route('managerpanel.report.manage') }}" style="color:white">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="admin-dashboard-box-main">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="admin-dashboard-sing-box">
                                            <div class="admin-dashboard-sing-box-head">
                                                <div id="container" style="width: 500%; height: 200%"></div>
                                                <script type="text/javascript">
                                                   anychart.onDocumentReady(function() {
                                                    
                                                      // set the data
                                                      var data = [
                                                          {x: "0 to 10 years", value: {{$agecount1}}},
                                                          {x: "11 to 30 years", value: {{$agecount2}}},
                                                          {x: "31 years to 50 years", value: {{$agecount3}}},
                                                          {x: "51 years to 80 years", value: {{$agecount4}}},
                                                          {x: "81 years to 100 years", value: {{$agecount5}}},
                                                          {x: "Above 100 years", value: {{$agecount6}}}
                                                      ];
                                                      
                                                      // create the chart
                                                      var chart = anychart.pie();

                                                      // set the chart title
                                                      chart.title("Age Range");

                                                      // add the data
                                                      chart.data(data);

                                                      // display the chart in the container
                                                      chart.container('container');
                                                      chart.draw();

                                                    });
                                               </script>
                                            </div>
                                            <div class="admin-dashboard-sing-box-dtl-main">
                                                <div class="admin-dashboard-sm-dtl">
                                                    
                                                </div>
                                                <div class="admin-dashboard-sm-dtl">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="admin-dashboard-sing-box">
                                            <div class="admin-dashboard-sing-box-head">
                                                <div class="chart has-fixed-height" id="pie_basic"></div>
                                                <div id="container1" style="width: 500%; height: 200%"></div>
                                                <script type="text/javascript">
                                                   anychart.onDocumentReady(function() {

                                                      // set the data
                                                      var data = [
                                                          {x: "0 to 10 meter", value: {{$treeheight1}}},
                                                          {x: "10.01 to 30 meter", value: {{$treeheight2}}},
                                                          {x: "30.01 meter to 50 meter", value: {{$treeheight3}}},
                                                          {x: "50.01 meter to 70 meter", value: {{$treeheight4}}},
                                                          {x: "above 70.01 meter", value: {{$treeheight5}}}
                                                      ];

                                                      // create the chart
                                                      var chart = anychart.pie();

                                                      // set the chart title
                                                      chart.title("Tree Height");

                                                      // add the data
                                                      chart.data(data);

                                                      // display the chart in the container
                                                      chart.container('container1');
                                                      chart.draw();

                                                    });
                                                </script>
                                            </div>
                                            <div class="admin-dashboard-sing-box-dtl-main">
                                                <div class="admin-dashboard-sm-dtl">
                                                </div>
                                                <div class="admin-dashboard-sm-dtl">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('managerpanel/js/jquery.min.js') }}"></script>
        <script src="{{ asset('managerpanel/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('managerpanel/js/slick.min.js') }}"></script>
    </body>
</html>