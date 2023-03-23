<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add/Edit Users</title>
        <link href="{{ asset('managerpanel/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('managerpanel/css/fontawesome-all.css') }}" rel="stylesheet">
        <link href="{{ asset('managerpanel/css/searchboxstyle.css') }}" rel="stylesheet">
        <link href="{{ asset('managerpanel/css/slick.css') }}" rel="stylesheet">
        <link href="{{ asset('managerpanel/css/slick-theme.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/style.css?')}}"<?php echo time(); ?> >
        <link href="{{ asset('managerpanel/css/responsive.css') }}" rel="stylesheet">
        <style type="text/css">
            .info {
                color: darkblue;
                font-size: 18px;
                border: none;
                text-decoration: none;
            }
            /* Dropdown Button */
            .dropbtn {
                background-color: lightblue;
                color: white;
                padding: 16px;
                font-size: 16px;
                border: none;
                cursor: pointer;
            }

            /* Dropdown button on hover & focus */
            .dropbtn:hover, .dropbtn:focus {
                background-color: lightblue;
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
        <div class="main" id="main-site" style="background-image: url('{{ asset('managerpanel/images/login-bg.png')}}');">
            <div class="admin-dashboard">
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
                            <?php
                                $label = "Create";
                                $first_name = "";
                                $last_name = "";
                                $userImage = "";
                                $email = "";
                                $password = "";
                                $profile_picture = "";
                                //$manager_id = "";
                                $phone = "";
                                $user_type = "";
                                $id = "";
                                $statusCheck = "";
                                $isError = false;

                                $formRoute = route('adminpanel.user.save');

                                if(isset($data['error'])) 
                                {
                                    $isError = true;
                                    if($data['type']=="Edit") 
                                    {
                                        $label = "Edit";
                                        $formRoute = route('adminpanel.user.update');
                                    }
                                    $first_name = $data['input']['first_name'];
                                    $last_name = $data['input']['last_name'];
                                    $userImage = $data['input']['userImage'];
                                    $email = $data['input']['email'];
                                    $phone = $data['input']['phone'];
                                    $user_type = $data['input']['user_type'];
                                } 
                                else 
                                { 
                                    if($data['type'] == "edit") 
                                    {
                                        $label = "Edit";
                                        $id = $data['input'][0]->id;
                                        $first_name = $data['input'][0]->first_name;
                                        $last_name = $data['input'][0]->last_name;
                                        $userImage = $data['input'][0]->userImage;
                                        $email = $data['input'][0]->email;
                                        //$manager_id = $data['input'][0]->manager_id;
                                        $phone = $data['input'][0]->phone;
                                        $user_type = $data['input'][0]->user_type;

                                        $profile_picture = URL::asset('public/images/default-user.jpg');

                                        if($userImage!="" && $userImage!=null) 
                                        {
                                            if(file_exists(public_path()."/uploads/userImages/".$userImage))
                                            {
                                                $profile_picture = URL::asset('uploads/userImages/'.$userImage);
                                            }
                                        }
                                        $formRoute = route('adminpanel.user.update');
                                    }
                                }
                            ?>
                            <div class="admin-dashboard-box-main">
                                <div class="user-details-modal-main add-users-sub-dtl">
                                    <div class="user-details-sub-dtl">
                                        <div class="user-details-modal-main add-users-sub-dtl">
                                            <div class="user-details-sub-dtl">
                                                <div class="user-details-head">
                                                    <h2>{{ $label }} User:</h2>
                                                    <!-- <div class="dropdown">
                                                      <button onclick="myFunction()" class="dropbtn">Select User</button>
                                                      <div id="myDropdown" class="dropdown-content">
                                                        <a href="{{ route('adminpanel.admin.add') }}">Admin</a>
                                                        <a href="{{ route('adminpanel.manager.add') }}">Manager</a>
                                                        <a href="javascript:void(0)" onclick="ShowHideDiv()">TreeOperator</a>
                                                      </div>
                                                    </div> -->
                                                    <!-- <button type="button" class="close" data-dismiss="modal"><img src="{{ asset('managerpanel/images/close-icn.png') }}"></button> -->
                                                </div>
                                                <div class="add-users-sm-inp">        
                                                </div>
                                                
                                                <form action="{{ $formRoute }}" method="POST" id="logForm" enctype="multipart/form-data" >
                                                @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <input type="hidden" name="user_type" value="{{ $user_type }}">
                                                    <div class="user-personla-dtl">
                                                        <div class="edit-account-img edit-account-mail-left">
                                                            <img src="{{ asset('managerpanel/images/dummy-pic.png') }}">
                                                            <div class="camera-icon">
                                                                <img src="{{ asset('managerpanel/images/plus-gray.png') }}">
                                                                <h6>Add photo</h6>
                                                            </div>
                                                            <div class="logoContainer edit-account-img">
                                                                <img src="{{ $profile_picture }}" id="useimg">
                                                            </div>
                                                            <div class="fileContainer sprite">
                                                                <input type="file" name="userImage" id="userImage" placeholder="Upload File" onchange="displaySingleImagePreview(this, 'useimg')">
                                                            </div>
                                                        </div>
                                                        <div class="user-personla-dtl-right-side">
                                                            <div class="add-users-form">
                                                                <div class="add-users-fr-sec-inp">
                                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                                        <div class="add-users-sm-inp form-group">
                                                                            <div>
                                                                                <label for="name">First name</label>
                                                                                <span class="star">*</span>
                                                                            </div>
                                                                            <input type="text" name="first_name" value="{{ $first_name }}" placeholder="First name*" class="add-us-inp" required="required">
                                                                        </div>
                                                                        @error('first_name') <span style="color:#ff0000;width: 100%;text-align: left;padding: 2px;">{{ $errors->first('first_name') }}</span> @enderror
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                                        <div class="add-users-sm-inp form-group">
                                                                            <div>
                                                                                <label for="name">Last Name</label>
                                                                                <span class="star">*</span>
                                                                            </div>
                                                                            <input type="text" name="last_name" value="{{ $last_name }}" placeholder="Last name*" class="add-us-inp" required="required">
                                                                        </div>
                                                                        @error('last_name') <span style="color:#ff0000;width: 100%;text-align: left;padding: 2px;">{{ $errors->first('last_name') }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="add-users-fr-sec-inp">
                                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                                        <div class="add-users-sm-inp form-group">
                                                                            <div>
                                                                                <label for="email">Email</label>
                                                                                <span class="star">*</span>
                                                                            </div>
                                                                            <input type="email" name="email" value="{{ $email }}" placeholder="Email*" class="add-us-inp" required="required">
                                                                        </div>
                                                                        @error('email') <span style="color:#ff0000;width: 100%;text-align: left;padding: 2px;">{{ $errors->first('email') }}</span> @enderror
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                                        <div class="add-users-sm-inp form-group">
                                                                            <div>
                                                                                <label for="password">Password</label>
                                                                                <span class="star">*</span>
                                                                            </div>
                                                                            <input type="password" name="password" placeholder="Password*" class="add-us-inp" required="required" value="">
                                                                        </div>
                                                                        @error('password') <span style="color:#ff0000;width: 100%;text-align: left;padding: 2px;">{{ $errors->first('password') }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="add-users-fr-sec-inp">
                                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                                        <div class="add-users-sm-inp form-group">
                                                                            <div>
                                                                                <label for="phone">Phone number</label>
                                                                                <span class="star">*</span>
                                                                            </div>
                                                                            <input type="text" name="phone" value="{{ $phone }}" placeholder="Phone number*" class="add-us-inp" required="required">
                                                                        </div>
                                                                        @error('phone') <span style="color:#ff0000;width: 100%;text-align: left;padding: 2px;">{{ $errors->first('phone') }}</span> @enderror
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="user-details-footer">
                                                                    <div class="user-details-footer-link remove-user-link">
                                                                        <a href="javascript:;">
                                                                            <!-- <img src="{{ asset('managerpanel/images/delete-icn.png') }}">
                                                                                <span>REMOVE USER</span> -->
                                                                        </a>
                                                                    </div>
                                                                    <div class="user-details-footer-link">
                                                                        <!-- <a href="{{ route('adminpanel.user.manage') }}"> -->
                                                                        <img src="{{ asset('managerpanel/images/save-user.png') }}">
                                                                        <button class="btn info" type="submit" value="SAVE USER">SAVE USER</button>
                                                                        <!--  <span><input type="submit" value="Save User"></span> -->
                                                                <!--  </a> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
            <script>
                $(window).on('load', function() {
                    $('#edit-users-modal').modal('show');
                });
            </script>
            <script type="text/javascript">
                function ShowHideDiv() {
                    var ddlPassport = document.getElementById("ddlPassport");
                    var dvPassport = document.getElementById("dvPassport");
                    dvPassport.style.display = "block" ;
                }
            </script>
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
            <script>
                $(".edit-account-img  input:file").change(function (){
                    var fileName = $(this).val();
                    if(fileName.length >0){
                        $(this).parent().children('span').html(fileName);
                    }
                    else{
                        $(this).parent().children('span').html("Choose file");
                    }
                });

                //file input preview
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();   
                        reader.onload = function (e) 
                        {
                            $('.logoContainer img').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $(".edit-account-img input:file").change(function(){
                        readURL(this);
                });
            </script>
            <script type="text/javascript">
                function countryDropdown(seletor)
                { 
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
            </script>

            <script type="text/javascript">

                $('.palceholder').click(function() {
                    $(this).siblings('input').focus();
                });
                
                $('.form-control').focus(function() {
                    $(this).siblings('.palceholder').hide();
                });
                
                $('.form-control').blur(function() {
                    var $this = $(this);
                    if ($this.val().length == 0)
                        $(this).siblings('.palceholder').show();
                });

                $('.form-control').blur();
            </script>
            <script>
                $('.first-button').on('click', function () {
                    $('.animated-icon1').toggleClass('open');
                    $('.admin-dashboard-leftsidebar').toggleClass('sidebar-open');
                    $('body').toggleClass('res-menu-open');
                }); 
            </script>
        </body>
</html>