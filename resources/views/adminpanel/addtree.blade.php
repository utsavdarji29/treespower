<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add/Edit Tree</title>
        <link href="{{ asset('managerpanel/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('managerpanel/css/fontawesome-all.css') }}" rel="stylesheet">
        <link href="{{ asset('managerpanel/css/searchboxstyle.css') }}" rel="stylesheet">
        <link href="{{ asset('managerpanel/css/slick.css') }}" rel="stylesheet">
        <link href="{{ asset('managerpanel/css/slick-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('managerpanel/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('managerpanel/css/responsive.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
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
                                <a href="{{ route('adminpanel.tree.manage') }}" class="active">
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
                        <!-- <span class="search-icn"><img src="{{ asset('managerpanel/images/search.png') }}"></span>
                            <input type="text" name="Search" placeholder="Search" class="search-sm"> -->
                    </div>
                    <div class="admin-dashboard-right-dtl">
                        <h4>Hi {{ $adminName }} You are Admin</h4>
                        <div class="admin-notification">
                            <!-- <img src="{{ asset('managerpanel/images/bell.png') }}">
                                <span class="noti-dig">0</span> -->
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
                    $treeid = "";
                    $address = "";
                    $location = "";
                    $species = "";
                    $height = "";
                    $trunk_diameter = "";
                    //$defects = "";
                    $date_planted = "";
                    $comments = "";
                    //$manager_comments = "";
                    $age_range = "";
                    $vitality = "";
                    $soil_type = "";
                    $treeImage = "";
                    $profile_picture = "";
                    $id = "";
                    $years = "";
                    $statusCheck = "";
                    $datePlanted = "";
                    $isError = false;
                    $formRoute = route('adminpanel.tree.save');
                    //$formRoute = route('adminpanel.tree.saveall');
                    if(isset($data['error'])) {
                        $isError = true;
                        if($data['type']=="Edit") {
                            $label = "Edit";
                            $formRoute = route('adminpanel.tree.update');
                        }
                        $treeid = $data['input']['treeid'];
                        $address = $data['input']['address'];
                        $location = $data['input']['location'];
                        $species = $data['input']['species'];
                        $height = $data['input']['height'];
                        $trunk_diameter = $data['input']['trunk_diameter'];
                        $date_planted = $data['input']['date_planted'];
                        //$defects = $data['input']['defects'];
                        $comments = $data['input']['comments'];
                        //$manager_comments = $data['input']['manager_comments'];
                        $age_range = $data['input']['age_range'];
                        $vitality = $data['input']['vitality'];
                        $soil_type = $data['input']['soil_type'];
                    } else { 
                        if($data['type'] == "edit") {
                            $label = "Edit";
                            $id = $data['input'][0]->id;
                            $treeid = $data['input'][0]->treeid;
                            $address = $data['input'][0]->address;
                            $location = $data['input'][0]->location;
                            $species = $data['input'][0]->species;
                            $height = $data['input'][0]->height;
                            $trunk_diameter = $data['input'][0]->trunk_diameter;
                            $date_planted = $data['input'][0]->date_planted;

                            $date2 = date('m/d/Y');
                            //$manager_comments = $data['input'][0]->manager_comments;

                            $diff = abs(strtotime($date2) - strtotime($date_planted));
                            $years = floor($diff / (365*60*60*24));

                            if ($date_planted == '') {
                                $age_range = "0-10";
                            }
                            elseif ($years >= 0 && $years <= 10) {
                                $age_range = "0-10";
                            }
                            elseif ($years >= 11 && $years <= 30) {
                                $age_range = "11-30";
                            }
                            elseif ($years >= 31 && $years <= 50) {
                                $age_range = "31-50";
                            }
                            elseif ($years >= 51 && $years <= 80) {
                                $age_range = "51-80";
                            }
                            elseif ($years >= 81 && $years <= 100) {
                                $age_range = "81-100";
                            }
                            elseif ($years > 100){
                                $age_range = "Above 100 years";
                            }
                            else{
                                $age_range = "0-10";
                            }

                            //$defects = $data['input'][0]->defects;
                            $comments = $data['input'][0]->comments;
                            //$manager_comments = $data['input'][0]->manager_comments;
                            //$age_range = $data['input'][0]->age_range;
                            $vitality = $data['input'][0]->vitality;
                            $soil_type = $data['input'][0]->soil_type;
                            
                        
                            $profile_picture = URL::asset('public/images/default-user.jpg');
                            if($treeImage!="" && $treeImage!=null)
                            {
                                if(file_exists(public_path()."/uploads/Tree_Images/".$treeImage))
                                {
                                    $clogo = asset('/uploads/Tree_Images/'.$treeImage);
                                }
                            }
                    
                            $formRoute = route('adminpanel.tree.update');
                        }
                    } 
                    
                    
                    ?>
                <div class="admin-dashboard-box-main edit-tree-main-page">
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
                                        <h2>{{ $label }} Tree:</h2>
                                        <!-- <button type="button" class="close" data-dismiss="modal"><img src="{{ asset('managerpanel/images/close-icn.png') }}"></button> -->
                                    </div>
                                    <form action="{{ $formRoute }}" method="POST" id="logForm" enctype="multipart/form-data" >
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <div class="user-personla-dtl">
                                            <!-- <div class="user-personla-dtl-left-pic">
                                                <img src="images/dummy-pic.png">
                                                </div> -->
                                            <div class="add-users-fr-sec-inp">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="add-users-sm-inp form-group">
                                                        <div>
                                                            <label for="name">Id</label>
                                                            <span class="star">*</span>
                                                        </div>
                                                        <?php
                                                            if($label == "Create")
                                                            {
                                                            ?>
                                                        <input type="text" name="treeid" value="{{ $treeid }}" placeholder="Tree Id*" class="add-us-inp" required="">
                                                        <?php } ?>
                                                        <?php
                                                            if($label == "Edit")
                                                            {
                                                            ?>
                                                        <label class="add-us-inp">{{ $treeid }} </label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="edit-tree-left-sidebar">
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
                                                        <input type="file" name="treeImage[]" id="treeImage[]" placeholder="Upload File" onchange="displaySingleImagePreview(this, 'useimg')" multiple="multiple">
                                                    </div>
                                                </div>
                                                @if(isset($images))
                                                <div class="user-pro-detail-content-dt-one">
                                                    <div class="user-pro-detail-content-left">
                                                        <label></label>
                                                    </div>
                                                    <div class="user-pro-detail-content-right">
                                                        @foreach($images as $img)
                                                        <?php
                                                            $treeImage = $img->treeImage;
                                                            if($treeImage!="" && $treeImage!=null) {
                                                                if(file_exists(public_path()."/uploads/Tree_Images/".$treeImage)) {
                                                                    $treeImage = asset('/uploads/Tree_Images/'.$treeImage);
                                                                    ?>
                                                        <div class="col-12" style="text-align: center;">
                                                            <div class="edit-tree-left-sing">
                                                                <div class="edit-tree-left-sing-dtl">
                                                                    <img src="{{ $treeImage }}" />
                                                                    {{ $img->treeimage_date}}
                                                                </div>
                                                                <div class="edit-tree-left-sing-icn">
                                                                    <!-- <a class="delete-confirm" href="{{ url('/adminpanel/deletetreeimage/'.$img->id) }}">Delete</a> -->
                                                                    <a class="delete-confirm" href="{{ url('/adminpanel/deletetreeimage/'.$img->id) }}"><img src="http://treespower.com.sg/treespower/public/managerpanel/images/blue-delete-icn.png"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            }
                                                            }?>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="user-personla-dtl-right-side edit-tree-right-sidebar">
                                                <div class="add-users-form">
                                                    <div class="add-users-fr-sec-inp">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="add-users-sm-inp form-group">
                                                                <div>
                                                                    <label for="name">Address</label>
                                                                    <span class="star">*</span>
                                                                </div>
                                                                <input type="text" name="address" value="{{ $address }}" placeholder="Address*" class="add-us-inp" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="add-users-sm-inp form-group">
                                                                <div>
                                                                    <label for="name">Location</label>
                                                                    <span class="star">*</span>
                                                                </div>
                                                                <input type="text" name="location" value="{{ $location }}" placeholder="Location*" class="add-us-inp" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-users-fr-sec-inp">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="add-users-sm-inp form-group">
                                                                <div>
                                                                    <label for="text">Species</label>
                                                                    <span class="star">*</span>
                                                                </div>
                                                                <input type="text" name="species" value="{{ $species }}" placeholder="Species*" class="add-us-inp" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="add-users-sm-inp form-group">
                                                                <div>
                                                                    <label for="text">Height(meter)</label>
                                                                    <span class="star">*</span>
                                                                </div>
                                                                <input type="text" name="height" value="{{ $height }}" placeholder="Height(meter)*" class="add-us-inp" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-users-fr-sec-inp">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="add-users-sm-inp form-group">
                                                                <div>
                                                                    <label for="text">Trunk diameter(meter)</label>
                                                                    <span class="star">*</span>
                                                                </div>
                                                                <input type="text" name="trunk_diameter" value="{{ $trunk_diameter }}" placeholder="Trunk diameter(meter)*" class="add-us-inp" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="add-users-sm-inp form-group">
                                                                <div>
                                                                    <label for="text">Date Planted</label>
                                                                    <span class="star">*</span>
                                                                </div>
                                                               
                                                                <input type="date" name="date_planted" value="{{ $date_planted }}" placeholder="Date Planted*" class="add-us-inp" required="">
                                                                <span style="position: absolute;left: 10px;top: 74px;">Selected Date: <?php echo $date_planted; ?></span>
                                                                &nbsp;
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-users-fr-sec-inp">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="add-users-sm-inp form-group">
                                                                <div>
                                                                    <label for="text">Comments</label>
                                                                    <span class="star">*</span>
                                                                </div>
                                                                <input type="text" name="comments" value="{{ $comments }}" placeholder="Comments*" class="add-us-inp" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="add-users-sm-inp form-group">
                                                                <div>
                                                                    <label for="text">Soil Type</label>
                                                                    <span class="star">*</span>
                                                                </div>
                                                                <select name="soil_type" required="true" class="add-us-inp">
                                                                    <option>Soil Type</option>
                                                                    <option value="Clay" <?php if ($soil_type == "Clay") { echo "Selected"; } ?> >Clay</option>
                                                                    <option value="Sandy" <?php if ($soil_type == "Sandy") { echo "Selected"; } ?> >Sandy</option>
                                                                    <option value="Silty" <?php if ($soil_type == "Silty") { echo "Selected"; } ?> >Silty</option>
                                                                    <option value="Peaty" <?php if ($soil_type == "Peaty") { echo "Selected"; } ?> >Peaty</option>
                                                                    <option value="Chalky" <?php if ($soil_type == "Chalky") { echo "Selected"; } ?> >Chalky</option>
                                                                    <option value="Loamy" <?php if ($soil_type == "Loamy") { echo "Selected"; } ?> >Loamy</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-users-fr-sec-inp">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="add-users-sm-inp form-group">
                                                                <div>
                                                                    <label for="text">Age Range</label>
                                                                    <span class="star">*</span>
                                                                </div>
                                                                <select name="age_range" required="true" class="add-us-inp" attr="<?php echo $years; ?>">
                                                                    <option>Age Range</option>
                                                                    <option value="0 to 10 years" <?php if ($age_range == "0-10") { echo "Selected"; } ?> >0 to 10 years</option>
                                                                    <option value="11 to 30 years" <?php if ($age_range == "11-30") { echo "Selected"; } ?> >11 to 30 years</option>
                                                                    <option value="31 years to 50 years" <?php if ($age_range == "31-50") { echo "Selected"; } ?> >31 years to 50 years</option>
                                                                    <option value="51 years to 80 years" <?php if ($age_range == "51-80") { echo "Selected"; } ?> >51 years to 80 years</option>
                                                                    <option value="81 years to 100 years" <?php if ($age_range == "81-100") { echo "Selected"; } ?> >81 years to 100 years</option>
                                                                    <option value="Above 100 years" <?php if ($age_range == "Above 100 years") { echo "Selected"; } ?> >Above 100 years</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="add-users-sm-inp form-group">
                                                                <div>
                                                                    <label for="text">Vitality</label>
                                                                    <span class="star">*</span>
                                                                </div>
                                                                <select name="vitality" required="true" class="add-us-inp">
                                                                    <option>Vitality</option>
                                                                    <option value="Healthy" <?php if ($vitality == "Healthy") { echo "Selected"; } ?> >Healthy</option>
                                                                    <option value="Weak" <?php if ($vitality == "Weak") { echo "Selected"; } ?> >Weak</option>
                                                                    <option value="Unsafe" <?php if ($vitality == "Unsafe") { echo "Selected"; } ?> >Unsafe</option>
                                                                    <option value="Death" <?php if ($vitality == "Death") { echo "Selected"; } ?> >Death</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-users-fr-sec-inp add-users-fr-sec-btn">
                                                        <?php
                                                        if($label == "Create")
                                                        
                                                        {
                                                        
                                                        ?>
                                                    <img src="{{ asset('managerpanel/images/save-user.png') }}">
                                                    <button class="btn info" type="submit" value="SAVE REPORT">Save Tree Detail</button>
                                                    <?php } ?>
                                                       <?php
                                                    if($label == "Edit")
                                                    
                                                    {
                                                    
                                                    ?>
                                                <img src="{{ asset('managerpanel/images/save-user.png') }}">
                                                <button class="btn info" type="submit" value="SAVE EDITED">SAVE EDITED</button>
                                                <?php } ?>
                                                    </div>
                                                </form>
                                                
                                    </div>
                                   <!--  <div class="modal-footer">
                                        <div class="user-details-footer">
                                            <div class="user-details-footer-link">
                                                <a href="{{ route('adminpanel.dashboard') }}"><button class="btn info">SUBMIT REPORT</button></a>
                                            </div>
                                            <div class="user-details-footer-link">
                                                <a href="{{ route('adminpanel.user.manage') }}">
                                                <?php
                                                    if($label == "Create")
                                                    
                                                    {
                                                    
                                                    ?>
                                                <img src="{{ asset('managerpanel/images/save-user.png') }}">
                                                <button class="btn info" type="submit" value="SAVE REPORT">SUBMIT REPORT</button></a>
                                                <a href="{{ route('adminpanel.tree.addall') }}">
                                                    <img src="{{ asset('managerpanel/images/save-user.png') }}">Import</a>
                                                <?php } ?>
                                                <?php
                                                    if($label == "Edit")
                                                    
                                                    {
                                                    
                                                    ?>
                                                <img src="{{ asset('managerpanel/images/save-user.png') }}">
                                                <button class="btn info" type="submit" value="SAVE EDITED">SAVE EDITED</button>
                                                <?php } ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="modal-footer">
                                    <div class="user-details-footer">
                                    <div class="user-details-footer-link remove-user-link">
                                    <a href="javascript:;">
                                    <img src="{{ asset('managerpanel/images/delete-icn.png') }}">
                                        <span>REMOVE USER</span>
                                    </a>
                                    </div>
                                    <div class="user-details-footer-link">
                                        <a href="{{ route('adminpanel.user.manage') }}">
                                    <?php
                                        if($label == "Create")
                                        
                                        {
                                        
                                        ?>
                                    <img src="{{ asset('managerpanel/images/save-user.png') }}">
                                    <button class="btn info" type="submit" value="SAVE REPORT">SUBMIT REPORT</button>
                                    <a href="{{ route('adminpanel.tree.addall') }}">
                                        <img src="{{ asset('managerpanel/images/save-user.png') }}">Import</a>
                                    <?php } ?>
                                    <?php
                                        if($label == "Edit")
                                        
                                        {
                                        
                                        ?>
                                    <img src="{{ asset('managerpanel/images/save-user.png') }}">
                                    <button class="btn info" type="submit" value="SAVE EDITED">SAVE EDITED</button>
                                    <?php } ?>
                                     </a>
                                    </div>
                                    </div>
                                    </div> -->
                                    <!-- label>Import</label>
                                        <input type="file" name="excel" />
                                         <button class="btn info" type="submit" value="SAVE">SAVE</button> -->
                                    </div>
                                    </div>
                                     <div class="modal-footer">
                                        <div class="user-details-footer">
                                            <div class="user-details-footer-link">
                                                <?php
                                                if($label == "Edit")
                                                
                                                {
                                                    ?>
                                                <a href="{{ route('adminpanel.dashboard') }}"><button class="btn info">SUBMIT REPORT</button></a>
                                                 <?php } ?>
                                            </div>
                                            <div class="user-details-footer-link">
                                               <!--  <a href="{{ route('adminpanel.tree.manage') }}">
                                                <?php
                                                    if($label == "Create")
                                                    
                                                    {
                                                    
                                                    ?>
                                                <img src="{{ asset('managerpanel/images/save-user.png') }}">
                                                <button class="btn info" type="submit" value="SAVE REPORT">SUBMIT REPORT</button></a>
                                                <a href="{{ route('adminpanel.tree.addall') }}">
                                                    <img src="{{ asset('managerpanel/images/save-user.png') }}">Import</a>
                                                <?php } ?>
                                                <?php
                                                    if($label == "Edit")
                                                    
                                                    {
                                                    
                                                    ?>
                                                <img src="{{ asset('managerpanel/images/save-user.png') }}">
                                                <button class="btn info" type="submit" value="SAVE EDITED">SAVE EDITED</button>
                                                <?php } ?>
                                                </a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                if($label == "Edit")
                                
                                {
                                
                                ?>
                            <!-- <div class="user-details-footer-link">
                                <a href="{{ route('adminpanel.dashboard') }}"><button class="btn info">SUBMIT REPORT</button></a>
                            </div> -->
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('managerpanel/js/jquery.min.js') }}"></script>
        <script src="{{ asset('managerpanel/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('managerpanel/js/slick.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript">
            $('.delete-confirm').on('click', function (event) {
                event.preventDefault();
                const url = $(this).attr('href');
                swal({
                    title: 'Are you sure?',
                    text: 'You Want to Delete this TreeImage!!',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value) {
                        window.location.href = url;
                    }
                });
            });
        </script>
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
        <script>
            $('.first-button').on('click', function () {
                $('.animated-icon1').toggleClass('open');
                $('.admin-dashboard-leftsidebar').toggleClass('sidebar-open');
                $('body').toggleClass('res-menu-open');
            }); 
    </script> 
    </body>
</html>