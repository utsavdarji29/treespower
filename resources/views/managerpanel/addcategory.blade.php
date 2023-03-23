<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Add/Edit Category</title>

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

                                            <a href="{{ route('managerpanel.user.manage') }}">

                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">

                                            <span>Manage Users</span>

                                            </a>

                                        </li>

                                        <li>

                                            <a href="{{ route('managerpanel.category.manage') }}" class="active">

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

                                    <!-- <span class="search-icn"><img src="{{ asset('managerpanel/images/search.png') }}"></span>

                                    <input type="text" name="Search" placeholder="Search" class="search-sm"> -->

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

                            <div class="admin-dashboard-box-main">

                                <?php

                                    $label = "Create";

                                    $category_title = "";

                                    $id = "";

                                    $statusCheck = "";

                                    $isError = false;

                                    $formRoute = route('managerpanel.category.save');

                                    if(isset($data['error'])) {

                                        $isError = true;

                                        if($data['type']=="Edit") {

                                            $label = "Edit";

                                            $formRoute = route('managerpanel.category.update');

                                        }



                                    } else { 

                                        if($data['type'] == "edit") {

                                            $label = "Edit";

                                             $id = $data['input'][0]->id;

                                            $category_title = $data['input'][0]->category_title;

                                            $formRoute = route('managerpanel.category.update');



                                        }

                                    } 

                                ?>

                                <div class="user-details-modal-main add-users-sub-dtl">

                            <div class="user-details-sub-dtl">

                                <div class="user-details-head">

                                    <h2>{{ $label }} Category:</h2>

                                    <!--<button type="button" class="close" data-dismiss="modal"><img src="{{ asset('managerpanel/images/close-icn.png') }}"></button>-->

                                </div>

                                @if($errors->any())

                                    <div class="error-message-box">                    

                                        <p>{{$errors->first()}}</p>

                                    </div>

                                @endif

                                @if($isError)

                                    <div class="error-message-box">

                                        <?php foreach($data['error']->all() as $error) {

                                            echo "<p>". $error . "</p>";

                                        } ?>

                                    </div>

                                @endif

                                <form action="{{ $formRoute }}" method="POST" id="logForm" enctype="multipart/form-data" >

                            @csrf

                            <input type="hidden" name="id" value="{{ $id }}">

                                <div class="user-personla-dtl">

                                    <!-- <div class="user-personla-dtl-left-pic">

                                        <img src="images/dummy-pic.png">

                                    </div> -->

                                    <div class="edit-account-img edit-account-mail-left">

                                        

                                    </div>

                                    <div class="user-personla-dtl-right-side">

                                        <div class="add-users-form">

                                           

                                                <div class="add-users-fr-sec-inp">

                                                    <div class="col-lg-8 col-md-8 col-sm-8">

                                                        <div class="add-users-sm-inp form-group">

                                                            <div class="palceholder">

                                                                <label for="name">Category Title</label>

                                                                <span class="star">*</span>

                                                            </div>

                                                            <input type="text" name="category_title" value="{{ $category_title }}" placeholder="Category Title*" class="add-us-inp" required="">

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

                                <!-- <a href="{{ route('adminpanel.user.manage') }}"> -->

                                    <img src="{{ asset('managerpanel/images/save-user.png') }}">

                                    <button class="btn info" type="submit" value="SAVE CATEGORY">SAVE CATEGORY</button>

                                   <!--  <span><input type="submit" value="Save User"></span> -->

                               <!--  </a> -->

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

    </body>

</html>