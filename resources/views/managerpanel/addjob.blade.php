<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add/Edit Task</title>
    <link href="{{ asset('managerpanel/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('managerpanel/css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('managerpanel/css/searchboxstyle.css') }}" rel="stylesheet">
    <link href="{{ asset('managerpanel/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('managerpanel/css/slick-theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/style.css?')}}"<?php echo time(); ?> >
    <link href="{{ asset('managerpanel/css/responsive.css') }}" rel="stylesheet">
    <style type="text/css">
        .info 
        {
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
                                $job_title = "";
                                $description = "";
                                $job_date = "";
                                $start_time = "";
                                $end_time = "";
                                //$category_id = "";
                                $manager_id = "";
                                $user_id = "";
                                $user_name = "";
                                //$tags = "";
                                $add = "";
                                //$latitude = "";
                                //$longitude = "";
                                $status = "";
                                $treeId = "";
                                $id = "";
                                $statusCheck = "";

                                //$address = array();
                                $isError = false;
                                $formRoute = route('managerpanel.job.save');
                                $treeId = 0;

                                if(isset($data['treeId'])) 
                                { 
                                    $treeId = $data['treeId'];
                                }
                                if(isset($data['error']))
                                {
                                    $isError = true;
                                    if($data['type']=="Edit")
                                    {
                                        $label = "Edit";
                                        $formRoute = route('managerpanel.job.update');
                                    }
                                    $job_title = $data['input']['job_title'];
                                    $description = $data['input']['description'];
                                    $job_date = $data['input']['job_date'];
                                    $start_time = $data['input']['start_time'];
                                    $end_time = $data['input']['end_time'];
                                    $manager_id = $data['input']['manager_id'];
                                    $user_id = $data['input']['user_id'];
                                    //$getUserName = $data['input']['getUserName'];
                                    //$address = $data['input']['address'];

                                    //print_r($data['address']);die;

                                  //  $status = $data['input']['status'];
                                } 
                                else 
                                { 
                                    if($data['type'] == "edit") 
                                    {
                                        $label = "Edit";
                                        $id = $data['input'][0]->id;
                                        $job_title = $data['input'][0]->job_title;
                                        $description = $data['input'][0]->description;
                                        $job_date = $data['input'][0]->job_date;
                                        $start_time = $data['input'][0]->start_time;
                                        $end_time = $data['input'][0]->end_time;
                                        //$category_id = $data['input'][0]->category_id;
                                        $manager_id = $data['input'][0]->manager_id;
                                        $user_id = $data['input'][0]->user_id;
                                       // $user_name = $data['input'][0]->getUserName;
                                        //$tags = $data['input'][0]->tags;
                                        $address = $data['input'][0]->address;
                                        //$latitude = $data['input'][0]->latitude;
                                        //$longitude = $data['input'][0]->longitude;
                                        $status = $data['input'][0]->status;
                                        $formRoute = route('managerpanel.job.update');
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
                                            <?php 
                                            /*echo "<pre>";
                                            print_r($data);
                                            echo "<pre>";die;*/

                                            foreach($data['error']->all() as $error)
                                            {
                                                echo "<p>". $error . "</p>";
                                            } 
                                            ?>
                                        </div>
                                    @endif
                                    <div class="user-details-head">
                                        <h2>{{ $label }} Task:</h2>
                                    </div>
                                    <form action="{{ $formRoute }}" method="POST" id="logForm" enctype="multipart/form-data">
                                    @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <input type="hidden" name="treeId" value="{{ $treeId }}">
                                        <div class="user-personla-dtl">
                                            <div class="user-personla-dtl-right-side">
                                                <div class="add-users-form">
                                                    <div class="add-users-fr-sec-inp">
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                            <div class="add-users-sm-inp form-group">
                                                                <div>
                                                                    <label for="title">Job Title</label>
                                                                    <span class="star">*</span>
                                                                </div>
                                                                <input type="text" name="job_title" value="{{ $job_title }}" class="add-us-inp" placeholder="Enter Job Title" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                            <div class="add-users-sm-inp form-group">
                                                                <div>
                                                                    <label for="description">Description</label>
                                                                    <span class="star">*</span>
                                                                </div>
                                                                <textarea type="description" name="description" class="add-us-inp" placeholder="Enter Description" required="true">{{ $description }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-users-fr-sec-inp">
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                            <div class="add-users-sm-inp form-group">
                                                                <div>
                                                                    <label for="name">Manager</label>
                                                                    <span class="star">*</span>
                                                                </div>
                                                                <select name="manager_id" class="add-us-inp" id="manager_id">
                                                                    @foreach ($manager as $m)
                                                                        <option value="{{ $m->id }}" selected="true">{{$m->first_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                            <div class="add-users-sm-inp form-group">
                                                                <label for="name">Select Tree Operator</label>
                                                                <span class="star">*</span>
                                                            </div>
                                                            <select name="user_id" class="add-us-inp" id="user_id">
                                                                @foreach ($user as $u)
                                                                    <option value="{{ $u->id }}" <?php if($data['type'] == "edit" && $user_id == $u->id){ ?> Selected <?php  }?>>{{$u->first_name}} {{$u->last_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-users-fr-sec-inp">
                                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                                        <div class="add-users-sm-inp form-group">
                                                            <div>
                                                                <label for="date">Select Task Date</label>
                                                                <span class="star">*</span>
                                                            </div>
                                                            <input type="date" name="job_date" value="{{ $job_date }}" placeholder="Select Date*" class="add-us-inp" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                                        <div class="add-users-sm-inp form-group">
                                                            <div>
                                                                <label for="address">Address</label>
                                                                <span class="star">*</span>
                                                            </div>
                                                            @foreach ($address as $a)
                                                                <input type="text" name="address" value="{{ $a->address }}" placeholder="Enter Address*" class="add-us-inp" required="" readonly>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-users-fr-sec-inp">
                                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                                        <div class="add-users-sm-inp form-group">
                                                            <div>
                                                                <label for="time">Select Start Time</label>
                                                                <span class="star">*</span>
                                                            </div>
                                                            <input type="time" name="start_time" value="{{ $start_time }}" placeholder="Select Start Time*" class="add-us-inp" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                                        <div class="add-users-sm-inp form-group">
                                                            <div>
                                                                <label for="time">Select End Time</label>
                                                                <span class="star">*</span>
                                                            </div>
                                                            <input type="time" name="end_time" value="{{ $end_time }}" placeholder="Select End Time*" class="add-us-inp" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-users-fr-sec-inp">
                                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                                        <div class="add-users-sm-inp form-group">
                                                            <div>
                                                                <label for="location">Location</label>
                                                                <span class="star">*</span>
                                                            </div>
                                                            @foreach ($location as $l)
                                                                <input type="text" name="location" value="{{ $l->location }}" placeholder="Enter Address*" class="add-us-inp" required="" readonly>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <?php
                                                if($label == "Edit")
                                                {
                                                ?>
                                                <div class="add-users-fr-sec-inp">
                                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                                        <div class="add-users-sm-inp form-group">
                                                            <div>
                                                                <label for="time">Task Status</label>
                                                                <span class="star">*</span>
                                                            </div>
                                                            <select class="add-us-inp" name="status" id="status" required>
                                                                <option value="" selected="selected" >Select Status</option>
                                                                <option value="1" {{ ( '1' == $status) ? 'selected' : '' }}>To Do</option>
                                                                <option value="2" {{ ( '2' == $status) ? 'selected' : '' }}>In Progress</option>
                                                                <option value="3" {{ ( '3' == $status) ? 'selected' : '' }}>Done</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </form>
                                        </div>
                                        <div class="user-details-footer">
                                            <div class="user-details-footer-link remove-user-link">
                                                <a href="javascript:;">
                                                    <!-- <img src="{{ asset('managerpanel/images/delete-icn.png') }}">
                                                        <span>REMOVE USER</span> -->
                                                </a>
                                            </div>
                                            <div class="user-details-footer-link">
                                                <img src="{{ asset('managerpanel/images/save-user.png') }}">
                                                <button class="btn info" type="submit" value="SAVE TASK">SAVE TASK</button>
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
                $(window).on('load', function() 
                {
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
                function getUser(id)
                {
                    $.ajax
                    ({
                        type    : 'GET',
                        url     : 'http://treespower.com.sg/treespower/adminpanel/ajaxgetuser/'+id,
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
            <script>
                $(".edit-account-img  input:file").change(function ()
                {
                    var fileName = $(this).val();
                    if(fileName.length >0)
                    {
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