<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Managers</title>
        <link rel="stylesheet" href="{{ asset('managerpanel/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/fontawesome-all.css') }}" >
        <link rel="stylesheet" href="{{ asset('managerpanel/css/searchboxstyle.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/style.css') }}" >
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
                                        <li>
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
                                        </li>
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
                                    <form method="get" action="{{ route('managerpanel.manager.search') }}" enctype="multipart/form-data" style="display: flex;" id="search_form">
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
                                        <h2>USERS: (<span>{{ $data1['Users'] }}</span>)</h2>
                                    </div>
                                    <div class="admin-dashboard-user-sm-list">
                                        <ul>
                                            <li>Admins:<strong>{{ $data1['Admins'] }}</strong></li>
                                            <li>Managers:<strong>{{ $data1['Managers'] }}</strong></li>
                                            <!-- <li>Operators:<strong></strong></li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="admin-dashboard-user-right-dtl">
                                    <div class="admin-dashboard-sing-plus-icon">
                                        <a href="{{ route('managerpanel.manager.add') }}"><img src="{{ asset('managerpanel/images/plus.png') }}"></a>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="admin-list-part">
                                <div class="admin-dashboard-list-box">
                                    @if(session()->has('success'))
                                        <div class="alert alert-info">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if($errors->any())
                                        <div class="error-message-box">                    
                                            <p>{{$errors->first()}}</p>
                                        </div>
                                    @endif
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
                                                                        if($d->managerImage!="" && $d->managerImage!=null) {
                                                                            if(file_exists(public_path()."/uploads/managerImages/".$d->managerImage)) {
                                                                                $profile_picture = URL::asset('uploads/managerImages/'.$d->managerImage);
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
                                                                <a class="dropdown-item" href="{{ url('/managerpanel/editmanager/'.$d->id) }}"><span><i class="fas fa-edit"></i></span>Edit</a>
                                                                <a class="dropdown-item" href="{{ url('/managerpanel/deletemanager/'.$d->id) }}"><span><i class="fas fa-trash-alt"></i></span>Delete</a>
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
                                                   <!--  <li class="page-item"><a class="page-link disble" href="javascript:;">Prev</a></li> -->
                                                    {{ $data->render() }}
                                                    <!-- <li class="page-item"><a class="page-link" href="javascript:;">Next</a></li> -->
                                                </ul>
                                            </nav>
                                        </div>
                                        <!-- <div class="admin-dashboard-bottom-left admin-dashboard-bottom-right">
                                            <div class="admin-dashboard-bottom-select">
                                                <select class="ad-dsh-select">
                                                    <option value="">Edit selected</option>
                                                    <option value="">Edit selected1</option>
                                                </select>
                                                <div class="admin-edit-delete">
                                                    <a href="javascript:;">Delete</a>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
                $label = "Create";
                $first_name = "";
                $last_name = "";
                $managerImage = "";
                $email = "";
                $password = "";
                $profile_picture = "";
                $phone = "";
                $id = "";
                $statusCheck = "";
                $isError = false;
                $formRoute = route('adminpanel.manager.save');
                if(isset($data['error'])) {
                    $isError = true;
                    if($data['type']=="Edit") {
                        $label = "Edit";
                        $formRoute = route('adminpanel.manager.update');
                    }

                } else { 
                    if($data['type'] == "edit") {
                        $label = "Edit";
                        $id = $data['input'][0]->id;
                        $first_name = $data['input'][0]->first_name;
                        $last_name = $data['input'][0]->last_name;
                        $managerImage = $data['input'][0]->managerImage;
                        $email = $data['input'][0]->email;
                        $phone = $data['input'][0]->phone;
                        $formRoute = route('adminpanel.manager.update');

                        $profile_picture = URL::asset('public/images/default-user.jpg');
                        if($managerImage!="" && $managerImage!=null) {
                            if(file_exists(public_path()."/uploads/managerImages/".$managerImage)) 
                            {
                                $profile_picture = URL::asset('uploads/managerImages/'.$managerImage);
                            }
                        }
                    }
                } 
                ?>
         <!-- User Details -->
        <div class="modal hide fade add-user-modal" id="add-users-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="user-details-modal-main add-users-sub-dtl">
                            <div class="user-details-sub-dtl">
                                <div class="user-details-head">
                                    <h2>ADD MANAGER:</h2>
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
                                        <div class="logoContainer edit-account-img" style="display: flex; flex-direction: row; ">
                                            <img src="{{ $profile_picture }}" id="useimg" style="max-width: 500%; max-height: 500%; width: auto; height: auto;">
                                        </div>
                                        <div class="fileContainer sprite">
                                            <input type="file" name="managerImage" id="managerImage" placeholder="Upload File" onchange="displaySingleImagePreview(this, 'useimg')">
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
                                                            <input type="password" name="password" class="add-us-inp form-control" placeholder="Password*" required=""  maxlength="6">
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
                                    <button class="btn info" type="submit" value="SAVE MANAGER">SAVE MANAGER</button>
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
                    <div class="modal-footer">
                        <!-- <div class="user-details-footer">
                            <div class="user-details-footer-link remove-user-link">
                                <a href="javascript:;">
                                    <img src="{{ asset('managerpanel/images/delete-icn.png') }}">
                                    <span>REMOVE USER</span>
                                </a>
                            </div>
                            <div class="user-details-footer-link">
                                <a href="javascript:;">
                                    <img src="{{ asset('managerpanel/images/save-user.png') }}">
                                    <span>SAVE USER</span>
                                </a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- User Details -->
        <!-- User Details -->
        <div class="modal hide fade" id="user-detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="user-details-modal-main">
                            <div class="user-details-sub-dtl">
                                <div class="user-details-head">
                                    <h2>USER DETAILS:</h2>
                                    <button type="button" class="close" data-dismiss="modal"><img src="images/close-icn.png"></button>
                                </div>
                                <div class="user-personla-dtl">
                                    <div class="user-personla-dtl-left-pic">
                                        <img src="images/lady3.png">
                                    </div>
                                    <div class="user-personla-dtl-right-side">
                                        <h3>Susane Dores</h3>
                                        <h6>Manager</h6>
                                        <div class="user-personla-social-dtl">
                                            <ul>
                                                <li>
                                                    <a href="javascript:;">
                                                        <span><img src="images/phone-icn.png"></span>
                                                        +77 123 459-66-69
                                                    </a>
                                                </li>
                                                <li class="mail-address">
                                                    <a href="javascript:;">
                                                        <span><img src="images/email-icn.png"></span>
                                                        susane@treecontrol.com
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="user-details-footer">
                            <div class="user-details-footer-link">
                                <a href="javascript:;">
                                    <img src="images/chat-icn.png">
                                    <span>SEND MESSAGE</span>
                                </a>
                            </div>
                            <div class="user-details-footer-link">
                                <a href="javascript:;">
                                    <img src="images/pen.png">
                                    <span>Edit</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- User Details -->

        <div class="modal hide fade add-user-modal edit-user-modal" id="edit-users-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="user-details-modal-main add-users-sub-dtl">
                            <div class="user-details-sub-dtl">
                                <div class="user-details-head">
                                    <h2><strong>Edit User</strong></h2>
                                    <button type="button" class="close" data-dismiss="modal"><img src="http://keshavinfotechdemo1.com/keshav/KG1/Chun/public/managerpanel/images/close-icn.png"></button>
                                </div>
                                <form action="http://keshavinfotechdemo1.com/keshav/KG1/Chun/adminpanel/edituser" method="POST" id="logForm" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="SZOaL2aBFGTzbTPT8WoeKdUMZDWXfZHCp7TwxkZD">                            <input type="hidden" name="id" value="4">
                                    <div class="user-personla-dtl">
                                        <!-- <div class="user-personla-dtl-left-pic">
                                            <img src="images/dummy-pic.png">
                                            </div> -->
                                        <div class="edit-account-img edit-account-mail-left">
                                            <img src="http://keshavinfotechdemo1.com/keshav/KG1/Chun/public/managerpanel/images/dummy-pic.png">
                                            <div class="camera-icon">
                                                <img src="http://keshavinfotechdemo1.com/keshav/KG1/Chun/public/managerpanel/images/plus-gray.png">
                                                <h6>Add photo</h6>
                                            </div>
                                            <div class="logoContainer edit-account-img" style="display: flex; flex-direction: row; ">
                                                <img src="http://keshavinfotechdemo1.com/keshav/KG1/Chun/public/uploads/userImages/7441userpic.jpg" id="useimg" style="max-width: 500%; max-height: 500%; width: auto; height: auto;">
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
                                                            <input type="text" name="first_name" value="Susane" placeholder="First name*" class="add-us-inp" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp form-group">
                                                            <div class="palceholder">
                                                                <label for="name">Last Name</label>
                                                                <span class="star">*</span>
                                                            </div>
                                                            <input type="text" name="last_name" value="Dores" placeholder="Last name*" class="add-us-inp" required="">
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
                                                            <input type="email" name="email" value="Will@gmail.com" placeholder="Email*" class="add-us-inp" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-users-fr-sec-inp">
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp form-group">
                                                            <div class="palceholder">
                                                                <label for="phone">Phone number</label>
                                                                <span class="star">*</span>
                                                            </div>
                                                            <input type="text" name="phone" value="1234567890" placeholder="Phone number*" class="add-us-inp" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp">
                                                            <select class="add-us-inp" name="manager_id" id="manager_id">
                                                                <option value="1">manager1</option>
                                                                <option value="2">manager2</option>
                                                                <option value="3">manager3</option>
                                                                <option value="4">manager4</option>
                                                                <option value="5" selected="">manager5</option>
                                                                <option value="7">manager6</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="user-details-footer">
                                                    <div class="user-details-footer-link remove-user-link">
                                                        <a href="javascript:;">
                                                            <!-- <img src="http://keshavinfotechdemo1.com/keshav/KG1/Chun/public/managerpanel/images/delete-icn.png">
                                                                <span>REMOVE USER</span> -->
                                                        </a>
                                                    </div>
                                                    <div class="user-details-footer-link">
                                                        <!-- <a href="http://keshavinfotechdemo1.com/keshav/KG1/Chun/adminpanel/manageuser"> -->
                                                        <img src="http://keshavinfotechdemo1.com/keshav/KG1/Chun/public/managerpanel/images/save-user.png">
                                                        <button class="btn info" type="submit" value="SAVE USER">SAVE USER</button>
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
        <script src="{{ asset('managerpanel/js/jquery.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="{{ asset('managerpanel/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('managerpanel/js/slick.min.js') }}"></script>
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
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        if($('.file-upload-input')) {
            $('.file-upload-input').css('display', 'none');
        }
    }
};
        </script>
        
    </body>
</html>

