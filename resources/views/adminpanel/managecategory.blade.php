<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Category</title>

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

                                            <a href="{{ route('adminpanel.user.manage') }}">

                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">

                                            <span>Manage Users</span>

                                            </a>

                                        </li>

                                        <li>

                                            <a href="{{ route('adminpanel.manager.manage') }}">

                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">

                                            <span>Manage Manager</span>

                                            </a>

                                        </li>

                                        <li>

                                            <a href="{{ route('adminpanel.category.manage') }}" class="active">

                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">

                                            <span>Manage Category</span>

                                            </a>

                                        </li>

                                        <li>

                                            <a href="{{ route('adminpanel.job.manage') }}">

                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">

                                            <span>Manage Task</span>

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

                                    <span class="search-icn"><img src="{{ asset('managerpanel/images/search.png') }}"></span>

                                    <form method="get" action="{{ route('adminpanel.category.search') }}" enctype="multipart/form-data" style="display: flex;" id="search_form">

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
                                            <a href="{{ url('/adminpanel/editadmin/'.$d->id) }}"><img src="{{ asset('managerpanel/images/men.png') }}"></a>
                                        @endforeach
                                    </div>

                                </div>

                            </div>

                            <div class="admin-dashboard-user-dtl">

                                <div class="admin-dashboard-user-left-dtl">

                                    <div class="admin-dashboard-user-name">

                                        <h2>Category: (<span>{{ $data1['Category'] }}</span>)</h2>

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

                                        <a href="{{ route('adminpanel.category.add') }}"><img src="{{ asset('managerpanel/images/plus.png') }}"></a>

                                       

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

                                                <th style="text-align: left;width: 10%;">ID</th>

                                                <th style="text-align: right;width: 15%;">Category Title</th>

                                                <th style="text-align: right;width: 24%">Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php $counter = 0; ?>

                                            @foreach ($data as $d)

                                            <?php $counter++; ?>

                                            <tr>

                                                <td style="text-align: right;width: 2%;">{{ $counter }}</td>



                                                <td style="text-align: right;width: 10%;">{{ $d->category_title }}</td>



                                                <td style="text-align: right;width: 15%">

                                                    <div class="users-edit dropdown-menu-list">

                                                        <br/>

                                                        <a href="javascript:;" data-toggle="dropdown">

                                                            <img src="http://treespower.com.sg/treespower/public/managerpanel/images/th-icon.png">

                                                        </a>

                                                        <div class="dropdown-menu">

                                                            <a class="dropdown-item" href="{{ url('/adminpanel/editcategory/'.$d->id) }}"><span><i class="fas fa-edit"></i></span>Edit</a>

                                                            <a class="dropdown-item delete-confirm" href="{{ url('/adminpanel/deletecategory/'.$d->id) }}"><span><i class="fas fa-trash-alt"></i></span>Delete</a>

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
                    text: 'You Want to Delete this Category!!',
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

                .then((willDelete) => {

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

        @push('script')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>





        <script>

            $(document).ready(function () 

            {



                $.ajaxSetup({

                    headers: 

                    {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });



                $('body').on('click', '#submit', function (event) 

                {

                    event.preventDefault()

                    var id = $("#id").val();

                    var category_title = $("#category_title").val();

                   

                    $.ajax({

                        url: '/adminpanel/editcategory/' + id,

                        type: "POST",

                        data: 

                        {

                            id: id,

                            category_title: category_title,

                        },

                        dataType: 'json',

                        success: function (data) 

                        {

                            $('#logForm').trigger("reset");

                            $('#edit-user-modal').modal('hide');

                            //window.location.reload(true);

                        }

                    });

                });



                $('body').on('click', '#editCategory', function (event) 

                {

                    event.preventDefault();

                    var id = $(this).data('id');

                    console.log(id)

                    $.get('/adminpanel/editcategory/' + id , function (data) 

                    {

                        $('#submit').val("Edit category");

                        $('#edit-user-modal').modal('show');

                        $('#id').val(data.data.id);

                        $('#category_title').val(data.data.category_title);

                    })

                });

            }); 

        </script>
        <script>
            $('.first-button').on('click', function () {
                $('.animated-icon1').toggleClass('open');
                $('.admin-dashboard-leftsidebar').toggleClass('sidebar-open');
                $('body').toggleClass('res-menu-open');
            }); 
    </script> 

        @endpush 

    </body>

</html>



