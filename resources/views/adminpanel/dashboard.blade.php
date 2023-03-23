<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="{{ asset('managerpanel/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/fontawesome-all.css') }}" >
        <link rel="stylesheet" href="{{ asset('managerpanel/css/searchboxstyle.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/style.css') }}" >
        <link rel="stylesheet" href="{{ asset('managerpanel/css/responsive.css') }}" >
        <script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-core.min.js"></script>
        <script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-pie.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script type="text/javascript" src="{{asset('adminpanel/js/echarts.min.js')}}"></script>
    </head>
    <body>
        <div class="main" id="main-site" style="background-image: url('{{ asset('managerpanel/images/login-bg.png')}}');">
                <div class="container">
                    <div class="admin-dashboard-main">
                        <div class="admin-responsive-topbar">
                            <div class="mobile-menu-toggle">
                                <button class="navbar-toggler first-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent20"
                                        aria-controls="navbarSupportedContent20" aria-expanded="false" aria-label="Toggle navigation">
                                  <div class="animated-icon1"><span></span><span></span><span></span></div>
                                </button>
                            </div>
                            <div class="admin-dashboard-searchbar">
                                <span class="search-icn"><img src="{{ asset('managerpanel/images/search.png') }}"></span>
                                <form method="get" action="{{ route('adminpanel.user.search') }}" enctype="multipart/form-data" style="display: flex;" id="search_form">
                                    <input class="search-sm" type="text" name="search" placeholder="Search..." aria-label="Search">
                                    <div class="input-group-append">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="admin-dashboard-leftsidebar">
                            <div class="admin-dashboard-leftsidebar-bg-part">
                                <div class="admin-dashboard-logo">
                                    <a href="javascript:;">
                                        <img src="{{ asset('managerpanel/images/Logo_img.png') }}">
                                    </a>
                                </div>
                                <div class="admin-dashboard-menu-part">
                                    <ul>
                                        <li>
                                            <a href="{{ route('adminpanel.dashboard') }}" class="active">
                                                <img src="{{ asset('managerpanel/images/dashboard-icn.png') }}">
                                            <span>DASHBOARD</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('adminpanel.user.manage') }}">
                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                                            <span>Manage Users</span>
                                            </a>
                                        </li>
                                       <!--  <li>
                                            <a href="{{ route('adminpanel.manager.manage') }}">
                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                                            <span>Manage Manager</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('adminpanel.category.manage') }}">
                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                                            <span>Manage Category</span>
                                            </a>
                                        </li> -->
                                        <li>
                                            <a href="{{ route('adminpanel.job.manage') }}">
                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                                            <span>Manage Task</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('adminpanel.tree.manage') }}">
                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                                                <span>Manage Tree</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('adminpanel.report.manage') }}">
                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                                                <span>Manage Report</span>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                                <div class="admin-dashboard-messages-icn">
                                    <ul>
                                        <li>
                                            <a href="{{ route('adminpanel.logout') }}">
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
                                    <!-- <span class="search-icn"><img src="{{ asset('managerpanel/images/search.png') }}"></span>
                                    <input type="text" name="Search" placeholder="Search" class="search-sm"> -->
                                </div> 
                                <div class="admin-dashboard-right-dtl">
                                    <h4>Hi {{ $adminName }} You are Admin</h4>
                                    <div class="admin-notification">
                                        <!-- <img src="{{ asset('managerpanel/images/bell.png') }}">
                                        <span class="noti-dig">0</span> -->
                                    </div>
                                    <div class="admin-login-pr"> 
                                        @foreach ($admin as $d)
                                            <a href="{{ url('/adminpanel/editadmin/'.$d->id) }}"><img src="{{ $adminimage }}" style="max-width: 100%; max-height: 100%; width: auto; height: auto;"></a>
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
                                            <h1>{{ $data['Task'] }}</h1>
                                        </div>
                                        <div class="admin-dashboard-sing-box-dtl-main">
                                            <div class="admin-dashboard-sm-dtl">
                                                <h2>To Do:<strong>{{ $data['To do'] }}</strong></h2>
                                            </div>
                                            <div class="admin-dashboard-sm-dtl">
                                                <h2>In Progress:<strong>{{ $data['In progress'] }}</strong></h2>
                                            </div>
                                            <div class="admin-dashboard-sm-dtl">
                                                <h2>Done<strong>{{ $data['Done'] }}</strong></h2>
                                            </div>
                                        </div>
                                        <div class="admin-dashboard-sing-plus-icon">
                                            <a href="{{ route('adminpanel.job.manage') }}" style="color:white">View Details</a>
                                            {{-- <img src="{{ asset('managerpanel/images/plus.png') }}"> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="admin-dashboard-sing-box">
                                        <div class="admin-dashboard-sing-box-head">
                                            <h2>REPORTS:</h2> 
                                            <h1>{{ $data['Report'] }}</h1>
                                        </div>
                                        <div class="admin-dashboard-sing-box-dtl-main">
                                            <div class="admin-dashboard-sm-dtl">
                                                <h2>New:<strong>{{ $data['New'] }}</strong></h2>
                                            </div>
                                            <div class="admin-dashboard-sm-dtl">
                                                <h2>Checked:<strong>{{ $data['Checked'] }}</strong></h2>
                                            </div>
                                        </div>
                                        <div class="admin-dashboard-sing-plus-icon">
                                      
                                            <a href="{{ route('adminpanel.report.manage') }}" style="color:white">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/><br/>
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
        <script src="{{ asset('managerpanel/js/jquery.min.js') }}"></script>
        <script src="{{ asset('managerpanel/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('managerpanel/js/slick.min.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script>
            $('.first-button').on('click', function () {
                $('.animated-icon1').toggleClass('open');
                $('.admin-dashboard-leftsidebar').toggleClass('sidebar-open');
                $('body').toggleClass('res-menu-open');
            }); 
    </script> 
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-pie.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script type="text/javascript" src="{{asset('adminpanel/js/echarts.min.js')}}"></script>
    <script type="text/javascript">
    var pie_basic_element = document.getElementById('pie_basic');
    if (pie_basic_element) {
        var pie_basic = echarts.init(pie_basic_element);
        pie_basic.setOption({
            color: [
                '#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
                '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
                '#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
                '#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
            ],          
            
            textStyle: {
                fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                fontSize: 13
            },

            title: {
                text: 'Pie Chart Example',
                left: 'center',
                textStyle: {
                    fontSize: 17,
                    fontWeight: 500
                },
                subtextStyle: {
                    fontSize: 12
                }
            },

            tooltip: {
                trigger: 'item',
                backgroundColor: 'rgba(0,0,0,0.75)',
                padding: [10, 15],
                textStyle: {
                    fontSize: 13,
                    fontFamily: 'Roboto, sans-serif'
                },
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },

            legend: {
                orient: 'horizontal',
                bottom: '0%',
                left: 'center',                   
                data: ['0 to 10 years', '11 to 30 years','31 years to 50 years','51 years to 80 years','81 years to 100 years',
                'Above 100 years'],
                itemHeight: 8,
                itemWidth: 8
            },

            series: [{
                name: 'Age Range',
                type: 'pie',
                radius: '70%',
                center: ['50%', '50%'],
                itemStyle: {
                    normal: {
                        borderWidth: 1,
                        borderColor: '#fff'
                    }
                },
                data: [
                    {value: {{$agecount1}}, name: '0 to 10 years'},
                    {value: {{$agecount2}}, name: '11 to 30 years'},
                    {value: {{$agecount3}}, name: '31 years to 50 years'},
                    {value: {{$agecount4}}, name: '51 years to 80 years'},
                    {value: {{$agecount5}}, name: '81 years to 100 years'},
                    {value: {{$agecount6}}, name: 'Above 100 years'}
                ]
            }]
        });
    }
    </script>


    </body>
</html>
