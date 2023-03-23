<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Users</title>

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

        </style>

    </head>

    <body>

        <div class="main" id="main-site" style="background-image: url('{{ asset('managerpanel/images/login-bg.png')}}');">

            <div class="admin-dashboard operator-dashboard">

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

                                            <a href="{{ route('managerpanel.dashboard') }}">

                                                <img src="{{ asset('managerpanel/images/dashboard-icn.png') }}">

                                            <span>DASHBOARD</span>

                                            </a>

                                        </li>

                                        <!-- <li>

                                            <a href="{{ route('managerpanel.user.manage') }}" class="active">

                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">

                                            <span>Manage Users</span>

                                            </a>

                                        </li>

                                        <li>

                                            <a href="{{ route('managerpanel.category.manage') }}">

                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">

                                            <span>Manage Category</span>

                                            </a>

                                        </li> -->

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

                                    <span class="search-icn"><img src="{{ asset('managerpanel/images/search.png') }}"></span>

                                    <form method="get" action="{{ route('managerpanel.user.search') }}" enctype="multipart/form-data" style="display: flex;" id="search_form">

                                        <input class="search-sm" type="text" name="search" placeholder="Search..." aria-label="Search">

                                        <div class="input-group-append">

                                            <!-- <span class="input-group-text lighten-3" id="basic-text1"><i class="fas fa-search text-grey"

                                                aria-hidden="true"></i></span> -->

                                        </div>

                                    </form>

                                   <!--  <input type="text" name="Search" placeholder="Search" class="search-sm"> -->

                                </div>

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

                            <div class="admin-dashboard-user-dtl">

                                <div class="admin-dashboard-user-left-dtl">

                                    <div class="admin-dashboard-user-name">

                                        <h2>Users: (<span>{{ $data1['Users'] }}</span>)</h2>

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

                                        <a href="{{ route('managerpanel.user.add') }}"><img src="{{ asset('managerpanel/images/plus.png') }}"></a>

                                       

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

                            <div class="admin-list-part">

                               

                                <div class="admin-dashboard-list-box">

                                    <table>

                                        <thead>

                                            <tr>

                                                <th style="text-align: right;width: 1%;">Id</th>

                                                <th style="text-align: right;width: 2%;">UserImage</th>

                                                <th style="text-align: right;width: 5%;">Username</th>

                                                <th style="text-align: right;width: 5%;">Email</th>

                                                <th style="text-align: right;width: 8%">Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php $counter = 0; ?>

                                            @foreach ($data as $d)

                                            <?php $counter++; ?>

                                            <tr>

                                                <td></td>



                                                <td style="text-align: left;width: 5%;">{{ $counter }}</td>



                                                <td style="text-align: right;width: 1%;">

                                                    <div class="user-sm-pick-name">

                                                        <div class="admin-login-pr">

                                                            <span class="user-name-main">

                                                            <?php

                                                                $profile_picture = URL::asset('images/default-user.jpg');

                                                                if($d->userImage!="" && $d->userImage!=null) 

                                                                {

                                                                    if(file_exists(public_path()."/uploads/userImages/".$d->userImage)) 

                                                                    {

                                                                        $profile_picture = URL::asset('uploads/userImages/'.$d->userImage);

                                                                    }

                                                                }

                                                            ?>

                                                            <span class="bck-clr"><img src="{{ $profile_picture }}" ></span>

                                                        </div>

                                                    </div>

                                                </td>



                                                <td style="text-align: right;width: 28%;">{{ $d->first_name }}&nbsp;&nbsp;&nbsp;&nbsp;{{ $d->last_name }}</td>



                                                <td style="text-align: right;width: 25%;">{{ $d->email}}</td>



                                                <td style="text-align: right;width: 27%">

                                                    <div class="users-edit dropdown-menu-list">

                                                        <a href="javascript:;" data-toggle="dropdown">

                                                            <img src="http://treespower.com.sg/treespower/public/managerpanel/images/th-icon.png"></a>

                                                            <div class="dropdown-menu">

                                                                <a class="dropdown-item" href="{{ url('/managerpanel/edituser/'.$d->id) }}"><span><i class="fas fa-edit"></i></span>Edit</a>

                                                                <a class="dropdown-item delete-confirm" href="{{ url('/managerpanel/deleteuser/'.$d->id) }}"><span><i class="fas fa-trash-alt"></i></span>Delete</a>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </td>

                                            </tr>

                                            @endforeach

                                        </tbody>

                                    </table>

                                    <div class="admin-dashboard-bottom-dtl">

                                        <div class="admin-dashboard-bottom-left">

                                            <nav aria-label="Page navigation example">

                                                <ul class="pagination">

                                                    {{ $data->render() }}

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
            $('.delete-confirm').on('click', function (event) 
            {
                event.preventDefault();
                const url = $(this).attr('href');
                swal({
                    title: 'Are you sure?',
                    text: 'You Want to Delete this User!!',
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

            var confirmDelete = function(section, url) 

            {

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

                .then((willDelete) => 

                {

                    if (willDelete) {

                        window.location.href = url;

                    }

                });

            };

        </script>

        <script type="text/javascript">

            

            var displaySingleImagePreview = function(input, id)

            {

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

       

    </body>

</html>



