<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manager User</title>
    <link rel="stylesheet" href="{{ asset('managerpanel/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/fontawesome-all.css') }}" >
    <link rel="stylesheet" href="{{ asset('managerpanel/css/searchboxstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/style.css?')}}"<?php echo time(); ?> >
    <link rel="stylesheet" href="{{ asset('managerpanel/css/responsive.css') }}" >
    <style type="text/css">
        .info 
        {
            color: darkblue;
            font-size: 18px;
            border: none;
            text-decoration: none;
        }
            /* Dropdown Button */
            .dropbtn {
                background-color: #303396;
                color: white;
                padding: 16px;
                font-size: 16px;
                border: none;
                cursor: pointer;
            }

            /* Dropdown button on hover & focus */
            .dropbtn:hover, .dropbtn:focus {
                background-color: #303396;
            }

            /* The container <div> - needed to position the dropdown content */
            .dropdown {
                position: relative;
                display: inline-block;
            }

            /* Dropdown Content (Hidden by Default) */
            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            }

            /* Links inside the dropdown */
            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            /* Change color of dropdown links on hover */
            .dropdown-content a:hover {background-color: #f1f1f1}

            /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
            .show {display:block;}
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
                                <a href="{{ route('adminpanel.dashboard') }}">
                                    <img src="{{ asset('managerpanel/images/Logo_img.png') }}">
                                </a>
                            </div>
                            <div class="admin-dashboard-menu-part">
                                <ul>
                                    <li>
                                        <a href="{{ route('adminpanel.dashboard') }}">
                                            <img src="{{ asset('managerpanel/images/dashboard-icn.png') }}">
                                            <span>DASHBOARD</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('adminpanel.user.manage') }}" class="active">
                                            <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                                            <span>Manage Users</span>
                                        </a>
                                    </li>
                                    <!-- <li>
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
                    <div class="admin-dashboard-right Manager-task-right-main">
                        <div class="admin-dashboard-searchbar-part">

                            <div class="admin-dashboard-searchbar">
                                <span class="search-icn"><img src="{{ asset('managerpanel/images/search.png') }}"></span>

                                    <form method="get" action="{{ route('adminpanel.user.search') }}" enctype="multipart/form-data" style="display: flex;" id="search_form">
                                    @csrf
                                        <input class="search-sm" type="text" name="search" placeholder="Search..." aria-label="Search">
                                        <div class="input-group-append">
                                             <!-- <span class="input-group-text lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                                                aria-hidden="true"></i></span> -->
                                        </div>
                                    </form>
                                   <!--  <input type="text" name="Search" placeholder="Search" class="search-sm"> -->
                            </div>
                            <div class="admin-dashboard-right-dtl">
                                <h4>Hi {{ $adminName }} You are Admin</h4>
                                <div class="admin-notification">
                                </div>
                                <div class="admin-login-pr"> 
                                    @foreach ($admin as $d)
                                        <a href="{{ url('/adminpanel/editadmin/'.$d->id) }}"><img src="{{ $adminimage }}" style="max-width: 100%; max-height: 100%; width: auto; height: auto;"></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="admin-dashboard-user-dtl Manager-task-user-dtl">
                            <div class="admin-dashboard-user-left-dtl">
                                <div class="admin-dashboard-user-name">
                                    <h2>User: (<span>{{ $data1['Users'] }}</span>)</h2>
                                </div>
                                <div class="admin-dashboard-user-sm-list">
                                    <ul>
                                        <!--<li>Admins:<strong>{{ $data1['Admins'] }}</strong></li>

                                            <li>Managers:<strong>{{ $data1['Managers'] }}</strong></li>-->

                                            <!-- <li>Operators:<strong></strong></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="admin-dashboard-user-right-dtl">
                                 <div class="admin-dashboard-sing-plus-icon">
                                    <div class="dropdown">
                                      <button onclick="myFunction()" class="dropbtn"><img src="{{ asset('managerpanel/images/plus.png') }}"></button>
                                      <div id="myDropdown" class="dropdown-content">
                                        <a href="{{ route('adminpanel.admin.add') }}">Admin</a>
                                        <a href="{{ route('adminpanel.manager.add') }}">Manager</a>
                                        <a href="{{ route('adminpanel.user.add') }}">TreeOperator</a>
                                      </div>
                                    </div>
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

                        <div class="admin-list-part manager-task-list-part-main">
                            <div class="admin-dashboard-list-box manageuser-new-tab-design">
                                <div class="manager-task-list-name">
                                    <div class="manager-task-list-name-left">
                                        <h4>Admin:</h4>
                                    </div>
                                </div>
                                <div class="manager-tree-table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">Id</th>
                                                <th style="text-align:center;">UserImage</th>
                                                <th style="text-align:center;">Firstname</th>
                                                <th style="text-align:center;">Lastname</th>
                                                <th style="text-align:center;">Email</th>
                                                <th style="text-align:center;">Position</th>
                                                <th style="text-align:center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $counter = 0; ?>

                                            @foreach ($admin1 as $a)

                                            <?php $counter++; ?>

                                            <tr>
                                                <td style="text-align: center;">{{ $counter }}</td>
                                                <td style="text-align: center;">
                                                    <div class="user-sm-pick-name">
                                                        <div class="admin-login-pr">
                                                            <span class="user-name-main">
                                                                <?php
                                                                $profile_picture = URL::asset('images/default-user.jpg');
                                                                if($a->userImage!="" && $a->userImage!=null)
                                                                {
                                                                    if(file_exists(public_path()."/uploads/userImages/".$a->userImage)) 
                                                                    {
                                                                        $profile_picture = URL::asset('uploads/userImages/'.$a->userImage);
                                                                    }
                                                                }
                                                                ?>
                                                                <span class="bck-clr"><img src="{{ $profile_picture }}" ></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="text-align: center;">{{ $a['first_name'] }}</td>
                                                <td style="text-align: center;">{{ $a['last_name'] }}</td>
                                                <td style="text-align: center;">{{ $a['email'] }}</td>
                                                <td style="text-align: center;">{{ $a['user_type'] }}</td>
                                                <td style="text-align: center;">
                                                    <div class="users-edit dropdown-menu-list">
                                                        <a href="javascript:;" data-toggle="dropdown">
                                                            <img src="http://treespower.com.sg/treespower/public/managerpanel/images/th-icon.png">
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ url('/adminpanel/editadmin/'.$a['id']) }}"><span><i class="fas fa-edit"></i></span>Edit</a>
                                                            <a class="dropdown-item delete-confirm" href="{{ url('/adminpanel/deleteadmin/'.$a['id']) }}"><span><i class="fas fa-trash-alt"></i></span>Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                    <div class="admin-dashboard-bottom-dtl">
                                        <div class="admin-dashboard-bottom-left">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination">
                                                    {{ $admin1->render() }}
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>

                                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

                                <div class="admin-dashboard-list-box manageuser-new-tab-design">
                                    <div class="manager-task-list-name">
                                        <div class="manager-task-list-name-left">
                                            <h4>Manager:</h4>
                                        </div>
                                    </div>
                                    <div class="manager-tree-table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Id</th>
                                                <th style="text-align: center;">UserImage</th>
                                                <th style="text-align: center;">Firstname</th>
                                                <th style="text-align: center;">Lastname</th>
                                                <th style="text-align: center;">Email</th>
                                                <th style="text-align: center;">Position</th>
                                                <th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter = 0; ?>

                                            @foreach ($manager as $m)

                                            <?php $counter++; ?>

                                            <tr>
                                                <td style="text-align: center;">{{ $counter }}</td>
                                                <td style="text-align: center;">
                                                    <div class="user-sm-pick-name">
                                                        <div class="admin-login-pr">
                                                            <span class="user-name-main">
                                                                <?php
                                                                $profile_picture = URL::asset('images/default-user.jpg');
                                                                if($m->managerImage!="" && $m->managerImage!=null)
                                                                {
                                                                    if(file_exists(public_path()."/uploads/managerImages/".$m->managerImage)) 
                                                                    {
                                                                        $profile_picture = URL::asset('uploads/managerImages/'.$m->managerImage);
                                                                    }
                                                                }
                                                                ?>
                                                                <span class="bck-clr"><img src="{{ $profile_picture }}" ></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="text-align: center;">{{ $m['first_name'] }}</td>
                                                <td style="text-align: center;">{{ $m['last_name'] }}</td>
                                                <td style="text-align: center;">{{ $m['email'] }}</td>
                                                <td style="text-align: center;">{{ $m['user_type'] }}</td>
                                                <td style="text-align: center;">
                                                    <div class="users-edit dropdown-menu-list">
                                                        <a href="javascript:;" data-toggle="dropdown">
                                                            <img src="http://treespower.com.sg/treespower/public/managerpanel/images/th-icon.png">
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ url('/adminpanel/editmanager/'.$m['id']) }}"><span><i class="fas fa-edit"></i></span>Edit</a>
                                                            <a class="dropdown-item delete-confirm1" href="{{ url('/adminpanel/deletemanager/'.$m['id']) }}"><span><i class="fas fa-trash-alt"></i></span>Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="admin-dashboard-bottom-dtl">
                                    <div class="admin-dashboard-bottom-left">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                {{ $manager->render() }}
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="admin-dashboard-list-box manageuser-new-tab-design">
                                <div class="manager-task-list-name">
                                    <div class="manager-task-list-name-left">
                                        <h4>Tree Operator:</h4>
                                    </div>
                                </div>
                                <div class="manager-tree-table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Id</th>
                                                <th style="text-align: center;">UserImage</th>
                                                <th style="text-align: center;">Firstname</th>
                                                <th style="text-align: center;">Lastname</th>
                                                <th style="text-align: center;">Email</th>
                                                <th style="text-align: center;">Position</th>
                                                <th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter = 0; ?>

                                            @foreach ($user as $u)

                                            <?php $counter++; ?>

                                            <tr>
                                                <td style="text-align: center;">{{ $counter }}</td>
                                                <td style="text-align: center;">
                                                    <div class="user-sm-pick-name">
                                                        <div class="admin-login-pr">
                                                            <span class="user-name-main">
                                                                <?php
                                                                $profile_picture = URL::asset('images/default-user.jpg');
                                                                if($u->userImage!="" && $u->userImage!=null)
                                                                {
                                                                    if(file_exists(public_path()."/uploads/userImages/".$u->userImage)) 
                                                                    {
                                                                        $profile_picture = URL::asset('uploads/userImages/'.$u->userImage);
                                                                    }
                                                                }
                                                                ?>
                                                                <span class="bck-clr"><img src="{{ $profile_picture }}" ></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="text-align: center;">{{ $u['first_name'] }}</td>
                                                <td style="text-align: center;">{{ $u['last_name'] }}</td>
                                                <td style="text-align: center;">{{ $u['email'] }}</td>
                                                <td style="text-align: center;">{{ $u['user_type'] }}</td>
                                                <td style="text-align: center;">
                                                    <div class="users-edit dropdown-menu-list">
                                                        <a href="javascript:;" data-toggle="dropdown">
                                                            <img src="http://treespower.com.sg/treespower/public/managerpanel/images/th-icon.png">
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ url('/adminpanel/edituser/'.$u['id']) }}"><span><i class="fas fa-edit"></i></span>Edit</a>
                                                            <a class="dropdown-item delete-confirm2" href="{{ url('/adminpanel/deleteuser/'.$u['id']) }}"><span><i class="fas fa-trash-alt"></i></span>Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="admin-dashboard-bottom-dtl">
                                    <div class="admin-dashboard-bottom-left">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                {{ $user->render() }}
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
                /* When the user clicks on the button,
                toggle between hiding and showing the dropdown content */
                function myFunction() {
                    document.getElementById("myDropdown").classList.toggle("show");
                }

                // Close the dropdown menu if the user clicks outside of it
                window.onclick = function(event) {
                  if (!event.target.matches('.dropbtn')) {

                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                      var openDropdown = dropdowns[i];
                      if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                      }
                    }
                  }
                }
            </script>
    <script type="text/javascript">
        $('.delete-confirm').on('click', function (event) 
        {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'You Want to Delete this Admin!!',
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
        $('.delete-confirm1').on('click', function (event) 
        {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'You Want to Delete this Manager!!',
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
        $('.delete-confirm2').on('click', function (event) 
        {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'You Want to Delete this TreeOperator!!',
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

                url     : 'http://keshavinfotechdemo1.com/keshav/KG1/Chun/adminpanel/ajaxgetuser/'+id,

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



