<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Manager Task</title>
        <link rel="stylesheet" href="{{ asset('managerpanel/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/fontawesome-all.css') }}" >
        <link rel="stylesheet" href="{{ asset('managerpanel/css/searchboxstyle.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/style.css?')}}"<?php echo time(); ?> >
        <link rel="stylesheet" href="{{ asset('managerpanel/css/responsive.css') }}" >
        <style type="text/css">
            .info {
                color: darkblue;
                font-size: 18px;
                border: none;
                text-decoration: none;
            }
            .admin-dashboard-user-left-dtl{
                width: 100%;
            }
            .admin-dashboard-user-dtl{
                padding: 18px 48px 30px;
            }
            .admin-dashboard-user-name{
                width: 100%;
                justify-content: center;
            }
            .admin-dashboard-user-sm-list{
                width: 100%;
                padding-top: 30px;
                justify-content: flex-end;
            }
        </style>
    </head>
    <body>
        <div class="main" id="main-site">
            <div class="admin-dashboard manager-task-dash">
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
                                <!-- <span class="search-icn"><img src="{{ asset('managerpanel/images/search.png') }}"></span>
                                <form method="get" action="" enctype="multipart/form-data" style="display: flex;" id="search_form">
                                    <input class="search-sm" type="text" name="search" placeholder="Search..." aria-label="Search">
                                    <div class="input-group-append">
                                    </div>
                                </form> -->
                            </div>
                        </div>

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
                                            <a href="{{ route('managerpanel.dashboard') }}">
                                                <img src="{{ asset('managerpanel/images/dashboard-icn.png') }}">
                                                <span>DASHBOARD</span>
                                            </a>
                                        </li>

                                        <!-- <li>

                                            <a href="{{ route('managerpanel.user.manage') }}">

                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">

                                            <span>Manage Users</span>

                                            </a>

                                        </li> -->

                                        <!-- <li>

                                            <a href="{{ route('managerpanel.manager.manage') }}">

                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">

                                            <span>Manage Manager</span>

                                            </a>

                                        </li>

                                        <li>

                                            <a href="{{ route('managerpanel.category.manage') }}">

                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">

                                            <span>Manage Category</span>

                                            </a>

                                        </li> -->

                                        <li>
                                            <a href="{{ route('managerpanel.job.manage') }}" class="active">
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

                        <div class="admin-dashboard-right Manager-task-right-main">
                        <div class="admin-dashboard-searchbar-part">
                                <div class="admin-dashboard-searchbar">
                                    <select id = "ddlPassport" onchange = "ShowHideDiv()" class="search-sm" style="font-size: 11px;">
                                        <option>Select Day/Week/Month</option>
                                        <option value="day">Day</option>
                                        <option value="week">Week</option>
                                        <option value="month">Month</option>
                                    </select>
                                </div>
                                <div class="admin-dashboard-searchbar">
                                    <span class="search-icn"><img src="{{ asset('managerpanel/images/search.png') }}"></span>

                                    <form method="get" action="{{ route('managerpanel.job.searchtreeoperator') }}" enctype="multipart/form-data" style="display: flex;" id="search_form1">
                                    @csrf
                                        <input class="search-sm" type="text" name="searchusername" placeholder="Search TreeOperator" aria-label="Search" style="font-size: 12px;">
                                        <div class="input-group-append">
                                             <!-- <span class="input-group-text lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                                                aria-hidden="true"></i></span> -->
                                        </div>
                                    </form>
                                </div>
                                <div class="admin-dashboard-searchbar">
                                    <span class="search-icn"><img src="{{ asset('managerpanel/images/search.png') }}"></span>

                                    <form method="get" action="{{ route('managerpanel.job.searchjoblocation') }}" enctype="multipart/form-data" style="display: flex;" id="search_form1">
                                    @csrf
                                        <input class="search-sm" type="text" name="searchlocation" placeholder="Search Location" aria-label="Search" style="font-size: 12px;">
                                        <div class="input-group-append">
                                             <!-- <span class="input-group-text lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                                                aria-hidden="true"></i></span> -->
                                        </div>
                                    </form>
                                </div>
                                <div class="admin-dashboard-searchbar" id="dvPassport" style="display: none">
                                    
                                    <form method="get" action="{{ route('managerpanel.job.search') }}" enctype="multipart/form-data" style="display: flex;" id="search_form">
                                    @csrf
                                        <input class="search-sm" type="date" name="search" placeholder="Search..." aria-label="Search" style="font-size: 12px;">
                                        <div class="input-group-append">
                                            <button class="search-icn"><i class="fa fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="admin-dashboard-searchbar" id="dvPassport1" style="display: none">
                                    <form method="get" action="{{ route('managerpanel.job.search') }}" enctype="multipart/form-data" style="display: flex;" id="search_form">
                                    @csrf
                                        <input class="search-sm" type="week" name="search" placeholder="Search..." aria-label="Search" style="font-size: 12px;">

                                        <div class="input-group-append">
                                            <button class="search-icn"><i class="fa fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="admin-dashboard-searchbar" id="dvPassport2" style="display: none">
                                    <form method="get" action="{{ route('managerpanel.job.search') }}" enctype="multipart/form-data" style="display: flex;" id="search_form">
                                    @csrf
                                        <input class="search-sm" type="month" name="search" placeholder="Search..." aria-label="Search" style="font-size: 12px;">

                                        <div class="input-group-append">
                                            <button class="search-icn"><i class="fa fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <br/><br/><br/><br/>
                                <div class="admin-dashboard-right-dtl">
                                    <h4>Hi {{ $managerName }} You are manager</h4>
                                    <div class="admin-notification">
                                        <!-- <img src="{{ asset('managerpanel/images/bell.png') }}">
                                        <span class="noti-dig">0</span> -->
                                    </div>
                                    <div class="admin-login-pr"> 
                                        @foreach ($manager as $d)
                                        <a href="{{ url('/managerpanel/editmanager/'.$d->id) }}"><img src="{{ $managerimage }}" style="max-width: 100%; max-height: 100%; width: auto; height: auto;"></a>
                                        @endforeach
                                    </div>
                                   
                                     
                                </div>

                            </div>
                            
                            <div class="admin-dashboard-user-dtl Manager-task-user-dtl">
                                <div class="admin-dashboard-user-left-dtl">
                                    <div class="admin-dashboard-user-name">
                                        <h2>Task:(<span>{{ $task }}</span>)</h2>
                                    </div>
                                    <div class="admin-dashboard-user-sm-list">
                                        <ul>
                                            <li>To Do <strong>{{ $todo }}</strong></li>
                                            <li>In Progress:<strong>{{ $inprogress }}</strong></li>
                                            <li>Done:<strong>{{ $done }}</strong></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="admin-dashboard-user-right-dtl">

                                   <!--  <div class="admin-dashboard-sing-plus-icon">

                                        

                                    </div> -->

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

                            <div class="admin-list-part manager-task-list-part-main">
                                <div class="admin-dashboard-list-box">
                                    <div class="manager-task-list-name">
                                        <div class="manager-task-list-name-left">
                                            <h4>New Tasks:</h4>
                                        </div>
                                        <div class="manager-task-list-name-left">
                                            <div class="edit-select">
                                                <div class="add-users-role country add-us-inp">
                                                    <div id="country" class="select">
                                                        <span>Edit selected</span>
                                                    </div>
                                                    <div id="country-drop" class="dropdown">
                                                        <ul>
                                                            <li>New</li>
                                                            <li>In process</li>
                                                            <li>Done</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                 <button class="btn btn-primary update_all" data-url="{{ url('managerpanel/updateAll/') }}"><i class="fa fa-edit"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="manager-tree-table manageuser-new-tab-design">
                                        <div class="view-job-table">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <td style="text-align: center;"></td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">ID</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">Name</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;width: 14%;">Date</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;width: 12%;">Start and <br/> End Time</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;width: 12%;">Job Title</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">Location</td>
                                                        <td style="text-align: center;padding-right: 20px;">Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $counter = 0; ?>

                                                    @foreach ($Todo as $t)

                                                    <?php $counter++; ?>

                                                    <tr>
                                                        <td style="text-align: center;padding-left: 0px;"><input type="checkbox" class="sub_chk" data-id="{{$t->id}}"></td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $counter }}</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $t->firstName }}</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $t->job_date }} </td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $t->start_time }}-{{ $t->end_time }} </td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $t->job_title}} </td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $t->address }}</td>
                                                        {{-- <td style="text-align: center;">{{ strlen($t->address) > 8 ? substr($t->address,0,8).'..' : $t->address }}</td> --}}
                                                        {{-- {{ strlen($t->address) > 10 ? substr($t->address,0,10).'..' : $t->address }}  --}}

                                                        <td style="text-align: center;">
                                                            <div class="users-edit dropdown-menu-list">
                                                                <a href="javascript:;" data-toggle="dropdown">
                                                                    <img src="http://treespower.com.sg/treespower/public/managerpanel/images/th-icon.png"></a>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="{{ url('/managerpanel/viewjob/'.$t->id) }}"><span><i class="fas fa-eye"></i></span>View</a>
                                                                        <a class="dropdown-item" href="{{ url('/managerpanel/editjob/'.$t->id) }}"><span><i class="fas fa-edit"></i></span>Edit</a>
                                                                        <a class="dropdown-item delete-confirm" href="{{ url('/managerpanel/deletejob/'.$t->id) }}"><span><i class="fas fa-trash-alt"></i></span>Delete</a>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </td>

                                                    </tr>

                                                    @endforeach

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="admin-dashboard-bottom-dtl">

                                        <div class="admin-dashboard-bottom-left">

                                            <nav aria-label="Page navigation example">

                                                <ul class="pagination">

                                                    {{ $Todo->render() }}

                                                </ul>

                                            </nav>

                                        </div>

                                    </div>

                                </div>

                                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

                                <div class="admin-dashboard-list-box">

                                    <div class="manager-task-list-name">
                                    
                                        <div class="manager-task-list-name-left">

                                            <h4>In Progress:</h4>

                                        </div>

                                    </div>
                                    <div class="manager-tree-table manageuser-new-tab-design">
                                        <div class="view-job-table">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <td style="text-align: center;padding-left: 0px;"></td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">ID</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">Name</td>
                                                        <td style="text-align: center;width: 14;padding-left: 5px;padding-right: 5px;">Date</td>
                                                        <td style="text-align: center;width: 12%;padding-left: 5px;padding-right: 5px;">Start and <br/> End Time</td>
                                                        <td style="text-align: center;width: 12%;padding-left: 5px;padding-right: 5px;">Job Title</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">Location</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php $counter = 0; ?>

                                                    @foreach ($Inprogress as $i)

                                                    <?php $counter++; ?>

                                                    <tr>
                                                        <td style="text-align: center;padding-left: 0px;"><input type="checkbox" class="sub_chk" data-id="{{$i->id}}"></td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $counter }}</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $i->firstName }}</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $i->job_date }} </td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $i->start_time }}-{{ $i->end_time }} </td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $i->job_title}} </td>
                                                        <td style="text-align: center;width: 20%;">{{ $i->address }}</td>
                                                        {{-- <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ strlen($i->address) > 8 ? substr($i->address,0,8).'..' : $i->address }}</td>
         --}}
                                                            

                                                           {{--  {{ strlen($i->description) > 10 ? substr($i->description,0,10).'..' : $i->description }}  --}}

                                                        <td style="text-align: center;">

                                                            <div class="users-edit dropdown-menu-list">

                                                                <a href="javascript:;" data-toggle="dropdown">

                                                                    <img src="http://treespower.com.sg/treespower/public/managerpanel/images/th-icon.png"></a>

                                                                    <div class="dropdown-menu">

                                                                        <a class="dropdown-item" href="{{ url('/managerpanel/viewjob/'.$i->id) }}"><span><i class="fas fa-eye"></i></span>View</a>

                                                                        <a class="dropdown-item" href="{{ url('/managerpanel/editjob/'.$i->id) }}"><span><i class="fas fa-edit"></i></span>Edit</a>

                                                                        <a class="dropdown-item delete-confirm" href="{{ url('/managerpanel/deletejob/'.$i->id) }}"><span><i class="fas fa-trash-alt"></i></span>Delete</a>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </td>

                                                    </tr>

                                                    @endforeach

                                                </tbody>

                                            </table>
                                        </div>
                                </div>
                                    <div class="admin-dashboard-bottom-dtl">

                                        <div class="admin-dashboard-bottom-left">

                                            <nav aria-label="Page navigation example">

                                                <ul class="pagination">

                                                    {{ $Inprogress->render() }}

                                                </ul>

                                            </nav>

                                        </div>

                                    </div>

                                </div>

                                <div class="admin-dashboard-list-box">

                                    <div class="manager-task-list-name">
                                    
                                        <div class="manager-task-list-name-left">

                                            <h4>DONE:</h4>

                                        </div>
                                    </div>
                                    <div class="manager-tree-table manageuser-new-tab-design">
                                        <div class="view-job-table">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <td style="text-align: center;padding-left: 0px;"></td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">ID</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">Name</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;width: 14%;">Date</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;width: 12%;">Start and <br/> End Time</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;width: 12%;">Job Title</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">Location</td>
                                                        <td style="text-align: center;padding-right: 20px;">Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php $counter = 0; ?>

                                                    @foreach ($Done as $do)

                                                    <?php $counter++; ?>

                                                    <tr>

                                                        <!-- <td>

                                                           <div class="user-pic-dtl">

                                                               <label class="user-check">

                                                                  <input type="checkbox">

                                                                  <span class="checkmark"></span>

                                                                </label>

                                                           </div> 

                                                        </td> -->
                                                        <td style="text-align: center;padding-left: 0px;"><input type="checkbox" class="sub_chk" data-id="{{$do->id}}"></td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $counter }}</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $do->firstName }}</td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $do->job_date }} </td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $do->start_time }}-{{ $do->end_time }} </td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $do->job_title}} </td>
                                                        <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ $do->address }}</td>
                                                        {{-- <td style="text-align: center;padding-left: 5px;padding-right: 5px;">{{ strlen($do->address) > 8 ? substr($do->address,0,8).'..' : $do->address }}</td> --}}

                                                            

                                                          {{-- {{ strlen($do->description) > 10 ? substr($do->description,0,10).'..' : $do->description }}  --}}

                                                        <td style="text-align: center;">

                                                            <div class="users-edit dropdown-menu-list">

                                                                <a href="javascript:;" data-toggle="dropdown">

                                                                    <img src="http://treespower.com.sg/treespower/public/managerpanel/images/th-icon.png"></a>

                                                                    <div class="dropdown-menu">

                                                                        <a class="dropdown-item" href="{{ url('/managerpanel/viewjob/'.$do->id) }}"><span><i class="fas fa-eye"></i></span>View</a>

                                                                        <a class="dropdown-item" href="{{ url('/managerpanel/editjob/'.$do->id) }}"><span><i class="fas fa-edit"></i></span>Edit</a>

                                                                        <a class="dropdown-item delete-confirm" href="{{ url('/managerpanel/deletejob/'.$do->id) }}"><span><i class="fas fa-trash-alt"></i></span>Delete</a>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </td>

                                                    </tr>

                                                    @endforeach

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="admin-dashboard-bottom-dtl">

                                        <div class="admin-dashboard-bottom-left">

                                            <nav aria-label="Page navigation example">

                                                <ul class="pagination">

                                                    {{ $Done->render() }}

                                                </ul>

                                            </nav>

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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

        <script src="{{ asset('managerpanel/js/bootstrap.min.js') }}"></script>

        <script src="{{ asset('managerpanel/js/slick.min.js') }}"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript">
            function ShowHideDiv() 
            {
                var ddlPassport = document.getElementById("ddlPassport");
                var dvPassport = document.getElementById("dvPassport");
                var dvPassport1 = document.getElementById("dvPassport1");
                var dvPassport2 = document.getElementById("dvPassport2");
                dvPassport.style.display = ddlPassport.value == "day" ? "block" : "none";
                dvPassport1.style.display = ddlPassport.value == "week" ? "block" : "none";
                dvPassport2.style.display = ddlPassport.value == "month" ? "block" : "none";
            }
        </script>
        <script type="text/javascript">
            $('.delete-confirm').on('click', function (event) 
            {
                event.preventDefault();
                const url = $(this).attr('href');
                swal({
                    title: 'Are you sure?',
                    text: 'You Want to Delete this Job!!',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) 
                {
                    if (value) 
                    {
                        window.location.href = url;
                    }
                });
            });
        </script>

        <script>

             var confirmDelete = function(section, url) {

            // if(confirm("Are you sure you want to delete " + section)) {

            //  window.location.href = url;

            // }

            swal({

                title: "Are you sure?",

                text: "You want to delete this " + section,

                icon: "error",

                buttons: true,

                dangerMode: true,

            })

            .then((willDelete) => {

                if (willDelete) {

                    window.location.href = url;

                }

            });

        };

        </script>

        <script type="text/javascript">

            var displaySingleImagePreview = function(input, id) {

            if (input.files && input.files[0]) 
            {

                var reader = new FileReader();
                reader.onload = function (e) 
                {
                    $('#'+id).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);

                if($('.file-upload-input')) 
                {

                    $('.file-upload-input').css('display', 'none');

                }

            }
        };

        </script>

        <script>



        function getUser(id)

        {

            $.ajax

            ({

                type    : 'GET',

                url     : 'http://keshavinfotechdemo1.com/keshav/KG1/Chun/managerpanel/ajaxgetuser/'+id,

                dataType: 'json',

                success: function(response)

                {

                    var len = 0;            

                    $('#user_id').empty();

                    if(response['data'] != null)

                    {

                        len = response['data'].length;

                    }

                    if(len > 0)

                    {

                        for(var i=0; i<len; i++)

                        {

                            var id = response['data'][i].id;

                            var first_name = response['data'][i].first_name;

                            if(i==0)

                            {   

                                $("#user_id").append("<option value=''>Select User</option>");

                            }

                            $("#user_id").append("<option value="+ id +">"+ first_name +"</option>");

                        }

                    }

                    else

                    {

                        $("#user_id").append("<option value=''>No record found</option>");

                    }

                }

            });

        }

        </script>

        <script type="text/javascript">

        function countryDropdown(seletor){

            var Selected = $(seletor);

            var Drop = $(seletor+'-drop');

            var DropItem = Drop.find('li');



            Selected.click(function(){

                Selected.toggleClass('open');

                Drop.toggle();

            });



            Drop.find('li').click(function(){

                Selected.removeClass('open');

                Drop.hide();

                

                var item = $(this);

                Selected.html(item.html());

            });



            DropItem.each(function(){

                var code = $(this).attr('data-code');



                if(code != undefined){

                    var countryCode = code.toLowerCase();

                    $(this).find('i').addClass('flagstrap-'+countryCode);

                }

            });

        }

        countryDropdown('#country');



        function countryDropdown1(seletor){

            var Selected1 = $(seletor1);

            var Drop = $(seletor1+'-drop');

            var DropItem = Drop.find('li');



            Selected1.click(function(){

                Selected1.toggleClass('open');

                Drop.toggle();

            });



            Drop.find('li').click(function(){

                Selected1.removeClass('open');

                Drop.hide();

                

                var item = $(this);

                Selected1.html(item.html());

            });



            DropItem.each(function(){

                var code = $(this).attr('data-code');



                if(code != undefined){

                    var countryCode = code.toLowerCase();

                    $(this).find('i').addClass('flagstrap-'+countryCode);

                }

            });

        }

        countryDropdown1('#country1');

        function countryDropdown(seletor){

            var Selected = $(seletor);

            var Drop = $(seletor+'-drop');

            var DropItem = Drop.find('li');



            Selected.click(function(){

                Selected.toggleClass('open');

                Drop.toggle();

            });



            Drop.find('li').click(function(){

                Selected.removeClass('open');

                Drop.hide();

                

                var item = $(this);

                Selected.html(item.html());

            });



            DropItem.each(function(){

                var code = $(this).attr('data-code');



                if(code != undefined){

                    var countryCode = code.toLowerCase();

                    $(this).find('i').addClass('flagstrap-'+countryCode);

                }

            });

        }

        countryDropdown('#country2');

    </script>
    <script>
            $('.first-button').on('click', function () {
                $('.animated-icon1').toggleClass('open');
                $('.admin-dashboard-leftsidebar').toggleClass('sidebar-open');
                $('body').toggleClass('res-menu-open');
            }); 
    </script> 
    <script type="text/javascript">  
    $(document).ready(function () {  
  
        $('#master').on('click', function(e) {  
         if($(this).is(':checked',true))    
         {  
            $(".sub_chk").prop('checked', true);    
         } else {    
            $(".sub_chk").prop('checked',false);    
         }    
        });  
  
        $('.update_all').on('click', function(e) {  
  
            var allVals = [];    
            $(".sub_chk:checked").each(function() {    
                allVals.push($(this).attr('data-id'));  
            });    
  
            if(allVals.length <=0)    
            {    
                alert("Please select row.");    
            }  else {    
  
                var check = confirm("Are you sure you want to Update this row?");    
                if(check == true){    
  
                    var join_selected_values = allVals.join(",");   
                    var taskStatus = $('#country').text();
                    
                    $.ajax({  
                        url: $(this).data('url'),  
                        type: 'GET',  
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},  
                        data: 'ids='+join_selected_values+"&taskStatus="+taskStatus,  
                        success: function (data) {  
                            if(data > 0){
                                alert("selected Job Updated succussfully");
                                location.reload();
                            }
                            else{

                            }
                        },  
                        error: function (data) {  
                            alert(data.responseText);  
                        }  
                    });  
  
                  $.each(allVals, function( index, value ) {  
                      $('table tr').filter("[data-row-id='" + value + "']").remove();  
                  });  
                }    
            }    
        });  
  
        $('[data-toggle=confirmation]').confirmation({  
            rootSelector: '[data-toggle=confirmation]',  
            onConfirm: function (event, element) {  
                element.trigger('confirm');  
            }  
        });  
  
        $(document).on('confirm', function (e) {  
            var eele = e.target;  
            e.preventDefault();  
  
            $.ajax({  
                url: ele.href,  
                type: 'GET',  
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},  
                success: function (data) {  
                    if (data['success']) {  
                        $("#" + data['tr']).slideUp("slow");  
                        alert(data['success']);  
                    } else if (data['error']) {  
                        alert(data['error']);  
                    } else {  
                        alert('Whoops Something went wrong!!');  
                    }  
                },  
                error: function (data) {  
                    alert(data.responseText);  
                }  
            });  
  
            return false;  
        });  
    });  
</script>
    </body>

</html>



