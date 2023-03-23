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

        </style>

    </head>

    <body>

        <div class="main" id="main-site" style="background-image: url('{{ asset('managerpanel/images/login-bg.png')}}');">

            <div class="admin-dashboard">

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

                            <div class="admin-dashboard-box-main">

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

                                    $formRoute = route('managerpanel.user.save');

                                    if(isset($data['error'])) 

                                    {

                                        $isError = true;

                                        if($data['type']=="Edit") 

                                        {

                                            $label = "Edit";

                                            $formRoute = route('managerpanel.user.update');

                                        }

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

                                            $manager_id = $data['input'][0]->manager_id;

                                            $phone = $data['input'][0]->phone;

                                            $formRoute = route('managerpanel.user.update');



                                            $profile_picture = URL::asset('public/images/default-user.jpg');

                                            if($userImage!="" && $userImage!=null) 

                                            {

                                                if(file_exists(public_path()."/uploads/userImages/".$userImage)) 

                                                {

                                                    $profile_picture = URL::asset('uploads/userImages/'.$userImage);

                                                }

                                            }

                                        }

                                    } 

                                ?>

                                <div class="user-details-modal-main add-users-sub-dtl">

                                    <div class="user-details-sub-dtl">

                                        @if($errors->any())

                                            <div class="alert alert-danger">                    

                                                <p>{{$errors->first()}}</p>

                                            </div>

                                        @endif

                                        @if($isError)

                                            <div class="alert alert-danger">

                                                <?php foreach($data['error']->all() as $error)

                                                {

                                                    echo "<p>". $error . "</p>";

                                                } 

                                                ?>

                                            </div>

                                        @endif

                                        <div class="user-details-head">

                                            <h2>{{ $label }} User:</h2>

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

                                                <div class="logoContainer edit-account-img" style="display: flex; flex-direction: row; ">

                                                    <img src="{{ $profile_picture }}" id="useimg" style="max-width: 500%; max-height: 500%; width: auto; height: auto;">

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

                                                                <input type="text" name="last_name" value="{{ $last_name }}" placeholder="Last name*" class="add-us-inp" required="">

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="add-users-fr-sec-inp">

                                                        <div class="col-lg-4 col-md-4 col-sm-4">

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

                                                                <input type="password" name="password" value="{{ $password }}" placeholder="Password*" class="add-us-inp" required="">

                                                            </div>

                                                        </div>

                                                        <?php } ?>

                                                    </div>

                                                    <div class="add-users-fr-sec-inp">

                                                        <div class="col-lg-4 col-md-4 col-sm-4">

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
                                                                    <option value="Manager" <?php if ($manager_id == "Manager") { echo "Selected"; } ?> >Manager</option>
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

                                                    <!-- <img src="{{ asset('managerpanel/images/delete-icn.png') }}">

                                                    <span>REMOVE USER</span> -->

                                                </a>

                                            </div>

                                            <div class="user-details-footer-link">

                                                    <img src="{{ asset('managerpanel/images/save-user.png') }}">

                                                    <button class="btn info" type="submit" value="SAVE USER">SAVE USER</button>

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

        <script>

            $(window).on('load', function() {

                $('#edit-users-modal').modal('show');

            });

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

            $(".edit-account-img  input:file").change(function ()

            {

                var fileName = $(this).val();

                if(fileName.length >0){

                    $(this).parent().children('span').html(fileName);

                }

                else

                {

                    $(this).parent().children('span').html("Choose file");

                }

            });

            //file input preview

            function readURL(input) 

            {

                if (input.files && input.files[0]) 

                {

                    var reader = new FileReader();            

                    reader.onload = function (e) 

                    {

                        $('.logoContainer img').attr('src', e.target.result);

                    }

                    reader.readAsDataURL(input.files[0]);

                }

            }

            $(".edit-account-img input:file").change(function()

            {

                readURL(this);

            });

        </script>

        <script type="text/javascript">

        function countryDropdown(seletor)

        {

            var Selected = $(seletor);

            var Drop = $(seletor+'-drop');

            var DropItem = Drop.find('li');



            Selected.click(function()

            {

                Selected.toggleClass('open');

                Drop.toggle();

            });



            Drop.find('li').click(function()

            {

                Selected.removeClass('open');

                Drop.hide();

                

                var item = $(this);

                Selected.html(item.html());

            });



            DropItem.each(function()

            {

                var code = $(this).attr('data-code');



                if(code != undefined)

                {

                    var countryCode = code.toLowerCase();

                    $(this).find('i').addClass('flagstrap-'+countryCode);

                }

            });

        }



        countryDropdown('#country');

    </script>

    <script type="text/javascript">

        $('.palceholder').click(function() 

        {

          $(this).siblings('input').focus();

        });

        $('.form-control').focus(function() 

        {

          $(this).siblings('.palceholder').hide();

        });

        $('.form-control').blur(function() 

        {

          var $this = $(this);

          if ($this.val().length == 0)

            $(this).siblings('.palceholder').show();

        });

        $('.form-control').blur();

    </script>

    </body>

</html>