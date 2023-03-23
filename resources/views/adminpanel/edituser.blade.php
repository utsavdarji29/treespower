<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Add users</title>

        <link href="{{ asset('managerpanel/css/bootstrap.min.css') }}" rel="stylesheet">

        <link href="{{ asset('managerpanel/css/fontawesome-all.css') }}" rel="stylesheet">

        <link href="{{ asset('managerpanel/css/searchboxstyle.css') }}" rel="stylesheet">

        <link href="{{ asset('managerpanel/css/slick.css') }}" rel="stylesheet">

        <link href="{{ asset('managerpanel/css/slick-theme.css') }}" rel="stylesheet">

        <link href="{{ asset('managerpanel/css/style.css') }}" rel="stylesheet">

        <link href="{{ asset('managerpanel/css/responsive.css') }}" rel="stylesheet">

    </head>

    <body>

        <div class="main" id="main-site" style="background-image: url('{{ asset('managerpanel/images/login-bg.png') }}">

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

                                        <li>

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

                                        </li>

                                        <li>

                                            <a href="{{ route('adminpanel.job.manage') }}">

                                            	<img src="{{ asset('managerpanel/images/Users-icn.png') }}">

                                            <span>Manage Job</span>

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

                                    <input type="text" name="Search" placeholder="Search" class="search-sm">

                                </div>

                                <div class="admin-dashboard-right-dtl">

                                    <h4>Hi You are admin</h4>

                                    <div class="admin-notification">

                                        <!-- <img src="{{ asset('managerpanel/images/bell.png') }}">

                                        <span class="noti-dig">99+</span> -->

                                    </div>

                                    <div class="admin-login-pr">

                                        <img src="">

                                    </div>

                                </div>

                            </div>



                            <!-- <div class="admin-dashboard-box-main">

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                    <div class="admin-dashboard-sing-box">

                                        <div class="admin-dashboard-sing-box-head">

                                            <h2>USERS:</h2>

                                            <h1>69</h1>

                                        </div>

                                        <div class="admin-dashboard-sing-box-dtl-main">

                                            <div class="admin-dashboard-sm-dtl">

                                                <h2>Admins:<strong>4</strong></h2>

                                            </div>

                                            <div class="admin-dashboard-sm-dtl">

                                                <h2>Managers:<strong>12</strong></h2>

                                            </div>

                                            <div class="admin-dashboard-sm-dtl">

                                                <h2>Operators:<strong>53</strong></h2>

                                            </div>

                                        </div>

                                        <div class="admin-dashboard-sing-plus-icon">

                                            <a href="javascript:;"><img src="images/plus.png"></a>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                    <div class="admin-dashboard-sing-box">

                                        <div class="admin-dashboard-sing-box-head">

                                            <h2>AREAS:</h2>

                                            <h1>12</h1>

                                        </div>

                                        <div class="admin-dashboard-sing-box-dtl-main">

                                            <div class="admin-dashboard-sm-dtl">

                                                <h2>Parks:<strong>8</strong></h2>

                                            </div>

                                            <div class="admin-dashboard-sm-dtl">

                                                <h2>Forests:<strong>4</strong></h2>

                                            </div>

                                        </div>

                                        <div class="admin-dashboard-sing-plus-icon">

                                            <a href="javascript:;"><img src="images/plus.png"></a>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                    <div class="admin-dashboard-sing-box">

                                        <div class="admin-dashboard-sing-box-head">

                                            <h2>REPORTS:</h2>

                                            <h1>198</h1>

                                        </div>

                                        <div class="admin-dashboard-sing-box-dtl-main">

                                            <div class="admin-dashboard-sm-dtl">

                                                <h2>New reports:<strong>98</strong></h2>

                                            </div>

                                            <div class="admin-dashboard-sm-dtl">

                                                <h2>Checked:<strong>100</strong></h2>

                                            </div>

                                        </div>

                                        <div class="admin-dashboard-sing-plus-icon">

                                            <a href="javascript:;"><img src="images/plus.png"></a>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                    <div class="admin-dashboard-sing-box">

                                        <div class="admin-dashboard-sing-box-head">

                                            <h2>Tasks:</h2>

                                            <h1>192</h1>

                                        </div>

                                        <div class="admin-dashboard-sing-box-dtl-main">

                                            <div class="admin-dashboard-sm-dtl">

                                                <h2>To do:<strong>100</strong></h2>

                                            </div>

                                            <div class="admin-dashboard-sm-dtl">

                                                <h2>In progress:<strong>82</strong></h2>

                                            </div>

                                            <div class="admin-dashboard-sm-dtl">

                                                <h2>Done<strong>10</strong></h2>

                                            </div>

                                        </div>

                                        <div class="admin-dashboard-sing-plus-icon">

                                            <a href="javascript:;"><img src="images/plus.png"></a>

                                        </div>

                                    </div>

                                </div>

                            </div> -->

<?php

                $label = "Create";

                $first_name = "";

                $last_name = "";

                $userImage = "";

                $email = "";

                $password = "";

                $profile_picture = "";

                $manager_id = "";

                $phone = "";

                $id = "";

                $statusCheck = "";

                $isError = false;

               

                if(isset($data['error'])) {

                    $isError = true;

                    if($data['type']=="Edit") {

                        $label = "Edit";

                        $formRoute = route('adminpanel.user.update');

                    }



                } else { 

                    if($data['type'] == "edit") {

                        $label = "Edit";

                        $id = $data['input'][0]->id;

                        $first_name = $data['input'][0]->first_name;

                        $last_name = $data['input'][0]->last_name;

                        $userImage = $data['input'][0]->userImage;

                        $email = $data['input'][0]->email;

                        $manager_id = $data['input'][0]->manager_id;

                        $phone = $data['input'][0]->phone;

                        $formRoute = route('adminpanel.user.update');



                        $profile_picture = URL::asset('public/images/default-user.jpg');

                        if($userImage!="" && $userImage!=null) {

                            if(file_exists(public_path()."/uploads/userImages/".$userImage)) 

                            {

                                $profile_picture = URL::asset('uploads/userImages/'.$userImage);

                            }

                        }

                    }

                } 

                ?>

                             <div class="admin-dashboard-box-main">

                <div class="modal-content">

                    <div class="modal-body">

                        <div class="user-details-modal-main add-users-sub-dtl">

                            <div class="user-details-sub-dtl">

                                <div class="user-details-head">

                                    <h2>ADD USER:</h2>

                                    <button type="button" class="close" data-dismiss="modal"><img src="{{ asset('managerpanel/images/close-icn.png') }}"></button>

                                </div>

                                <form action="{{ $formRoute }}" method="POST" id="logForm" enctype="multipart/form-data" >

                            @csrf

                            <input type="hidden" name="id" value="{{ $id }}">

                                <div class="user-personla-dtl">

                                    <!-- <div class="user-personla-dtl-left-pic">

                                        <img src="images/dummy-pic.png">

                                    </div> -->

                                    <div class="edit-account-img edit-account-mail-left">

                                    	<img src="{{ asset('managerpanel/images/dummy-pic.png') }}">

                                        <div class="camera-icon">

                                        	<img src="{{ asset('managerpanel/images/plus-gray.png') }}">

                                            <h6>Add photo</h6>

                                        </div>

                                        <div class="logoContainer edit-account-img">

                                        	<img src="{{ asset('managerpanel/images/dummy-pic.png') }}">

                                        </div>

                                        <div class="fileContainer sprite">

                                        	

                                            <input type="file" name="managerImage" id="upload" value="Choose File">

                                        </div>

                                    </div>

                                    <div class="user-personla-dtl-right-side">

                                        <div class="add-users-form">

                                           

                                                <div class="add-users-fr-sec-inp">

                                                    <div class="col-lg-4 col-md-4 col-sm-4">

                                                        <div class="add-users-sm-inp form-group">

                                                            <div class="palceholder">

                                                                <label for="name">First name</label>

                                                                <span class="star">*</span>

                                                            </div>

                                                            <input type="text" name="first_name" value="{{ $first_name }}" placeholder="First name*" class="add-us-inp" required="">

                                                        </div>

                                                    </div>

                                                    <div class="col-lg-4 col-md-4 col-sm-4">

                                                        <div class="add-users-sm-inp form-group">

                                                            <div class="palceholder">

                                                                <label for="name">Last Name</label>

                                                                <span class="star">*</span>

                                                            </div>

                                                            <input type="text" name="last_name" value="{{ $last_name }}" placeholder="First name*" class="add-us-inp" required="">

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="add-users-fr-sec-inp">

                                                    <div class="col-lg-8 col-md-8 col-sm-8">

                                                        <div class="add-users-sm-inp form-group">

                                                            <div class="palceholder">

                                                                <label for="email">Email</label>

                                                                <span class="star">*</span>

                                                            </div>

                                                            <input type="email" name="email" value="{{ $email }}" placeholder="Email*" class="add-us-inp" required="">

                                                        </div>

                                                    </div>

                                                    <?php

                                                        if($label == "Create")

                                                        {

                                                        ?>

                                                    <div class="col-lg-4 col-md-4 col-sm-4">

                                                        <div class="add-users-sm-inp form-group">

                                                            <div class="palceholder">

                                                                <label for="password">Password</label>

                                                                <span class="star">*</span>

                                                            </div>

                                                            <input type="password" name="password" class="add-us-inp form-control" required="">

                                                        </div>

                                                    </div>

                                                </div>

                                            <?php } ?>

                                                <div class="add-users-fr-sec-inp">

                                                    <div class="col-lg-8 col-md-8 col-sm-8">

                                                        <div class="add-users-sm-inp form-group">

                                                            <div class="palceholder">

                                                                <label for="phone">Phone number</label>

                                                                <span class="star">*</span>

                                                            </div>

                                                            <input type="text" name="phone" value="{{ $phone }}" placeholder="Phone number*" class="add-us-inp" required="">

                                                        </div>

                                                    </div>

                                                    <div class="col-lg-4 col-md-4 col-sm-4">

                                                        <div class="add-users-sm-inp">

                                                            <select class="add-us-inp" name="manager_id" id="manager_id">

                                                            	@foreach ($data['manager'] as $m) 



			                                                    <?php

			                                                    $optionSelected = "";

			                                                    if($m->id == $manager_id)

			                                                    {

			                                                        $optionSelected = "selected";

			                                                    }

			                                                    ?>

                                                                <option value="{{ $m->id}}" {{ $optionSelected }}>{{ $m->first_name }}</option>

                                                                @endforeach

                                                            </select>

                                                            

                                                        </div>

                                                    </div>

                                                </div>

                                            </form>

                                        </div>

                                        <div class="modal-footer">

                        <div class="user-details-footer">

                            <div class="user-details-footer-link remove-user-link">

                                <a href="javascript:;">

                                    <img src="{{ asset('managerpanel/images/delete-icn.png') }}">

                                    <span>REMOVE USER</span>

                                </a>

                            </div>

                            <div class="user-details-footer-link">

                                <!-- <a href="{{ route('adminpanel.user.manage') }}"> -->

                                	<img src="{{ asset('managerpanel/images/save-user.png') }}">

                                    <spna><input type="submit" value="Save User"></span>

                               <!--  </a> -->

                            </div>

                        </div>

                    </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <div class="user-details-footer">

                            <div class="user-details-footer-link remove-user-link">

                                <a href="javascript:;">

                                    <img src="{{ asset('managerpanel/images/delete-icn.png') }}">

                                    <span>REMOVE USER</span>

                                </a>

                            </div>

                            <div class="user-details-footer-link">

                                <a href="route('managerpanel.user.save')">

                                	<img src="{{ asset('managerpanel/images/save-user.png') }}">

                                    <span>SAVE USER</span>

                                </a>

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

        <!-- User Details -->

        <!-- <div class="modal hide fade add-user-modal" id="add-users-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->

            <!-- <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-body">

                        <div class="user-details-modal-main add-users-sub-dtl">

                            <div class="user-details-sub-dtl">

                                <div class="user-details-head">

                                    <h2>ADD USER:</h2>

                                    <button type="button" class="close" data-dismiss="modal"><img src="images/close-icn.png"></button>

                                </div>

                                <div class="user-personla-dtl">

                                   <div class="user-personla-dtl-left-pic">

                                        <img src="images/dummy-pic.png">

                                    </div> -->

                                   <!--  <div class="edit-account-img edit-account-mail-left">

                                        <img src="images/dummy-pic.png">

                                        <div class="camera-icon">

                                            <img src="images/plus-gray.png">

                                            <h6>Add photo</h6>

                                        </div>

                                        <div class="logoContainer edit-account-img">

                                            <img src="images/dummy-pic.png">

                                        </div>

                                        <div class="fileContainer sprite">

                                            <input type="file"  value="Choose File">

                                        </div>

                                    </div>

                                    <div class="user-personla-dtl-right-side">

                                        <div class="add-users-form">

                                            <form>

                                                <div class="add-users-fr-sec-inp">

                                                    <div class="col-lg-8 col-md-8 col-sm-8">

                                                        <div class="add-users-sm-inp form-group">

                                                            <div class="palceholder">

                                                                <label for="name">First name</label>

                                                                <span class="star">*</span>

                                                            </div>

                                                            <input type="text" name="name" placeholder="" class="add-us-inp form-control" required="">

                                                        </div>

                                                    </div>

                                                    <div class="col-lg-4 col-md-4 col-sm-4">

                                                        <div class="add-users-sm-inp form-group">

                                                            <div class="palceholder">

                                                                <label for="Password">Password</label>

                                                            </div>

                                                            <input type="password" name="Password" class="add-us-inp form-control" required="">

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="add-users-fr-sec-inp">

                                                    <div class="col-lg-8 col-md-8 col-sm-8">

                                                        <div class="add-users-sm-inp form-group">

                                                            <div class="palceholder">

                                                                <label for="s-name">Seccond name</label>

                                                                <span class="star">*</span>

                                                            </div>

                                                            <input type="text" name="s-name" placeholder="" class="add-us-inp form-control" required="">

                                                        </div>

                                                    </div>

                                                    <div class="col-lg-4 col-md-4 col-sm-4">

                                                        <div class="add-users-sm-inp form-group">

                                                            <div class="palceholder">

                                                                <label for="c-Password">Confirm password</label>

                                                                <span class="star">*</span>

                                                            </div>

                                                            <input type="password" name="c-Password" class="add-us-inp form-control" required="">

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="add-users-fr-sec-inp">

                                                    <div class="col-lg-8 col-md-8 col-sm-8">

                                                        <div class="add-users-sm-inp form-group">

                                                            <div class="palceholder">

                                                                <label for="phone">Phone number</label>

                                                                <span class="star">*</span>

                                                            </div>

                                                            <input type="text" name="phone" placeholder="" class="add-us-inp form-control" required="">

                                                        </div>

                                                    </div>

                                                    <div class="col-lg-4 col-md-4 col-sm-4">

                                                        <div class="add-users-sm-inp"> -->

                                                            <!-- <select class="add-us-inp">

                                                                <option>Select role*</option>

                                                            </select> -->

                                                           <!--  <div class="add-users-role country add-us-inp">

                                                                <div id="country" class="select">

                                                                    <span>Select role<small>*</small></span>

                                                                </div>

                                                                <div id="country-drop" class="dropdown">

                                                                    <ul>

                                                                        <li>Admin</li>

                                                                        <li>Manager</li>

                                                                        <li>Operator</li>

                                                                    </ul>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="add-users-fr-sec-inp">

                                                    <div class="col-lg-8 col-md-8 col-sm-8">

                                                        <div class="add-users-sm-inp form-group">

                                                            <div class="palceholder">

                                                                <label for="email">Email</label>

                                                                <span class="star">*</span>

                                                            </div>

                                                            <input type="email" name="email" class="add-us-inp form-control" required="">

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="required-txt">

                                                    <p><span>*</span> is required</p>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <div class="user-details-footer">

                            <div class="user-details-footer-link remove-user-link">

                                <a href="javascript:;">

                                    <img src="images/delete-icn.png">

                                    <span>REMOVE USER</span>

                                </a>

                            </div>

                            <div class="user-details-footer-link">

                                <a href="javascript:;">

                                    <img src="images/save-user.png">

                                    <span>SAVE USER</span>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div> -->

        <!-- </div> -->

        

        <!-- User Details -->

        <script src="js/jquery.min.js"></script>

        <script src="js/bootstrap.min.js"></script>

        <script src="js/slick.min.js"></script>

        <script type="text/javascript">

            $(window).on('load', function() {

                $('#add-users-modal').modal('show');

            });

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

                        reader.onload = function (e) {

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