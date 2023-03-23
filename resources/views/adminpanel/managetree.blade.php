<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Manager Tree</title>
        
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
        .dataTables_paginate, .dataTables_info, .dataTables_length, .user-table div.dataTables_wrapper div.dataTables_filter{
            padding: 15px 0px 0px 15px;
            display: block;
        }
        .dataTables_inf{
           
            display: none;
        }
        div.dataTables_wrapper div.dataTables_length select{
            
            display: none;
        }
        .manager-task-list-name-left{
            width: 100%;
            justify-content: center;
        }
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
                        <div class="admin-dashboard-right Manager-task-right-main">
                            <div class="admin-dashboard-searchbar-part">
                                <div class="admin-dashboard-searchbar">
                                     <span class="search-icn"><img src="{{ asset('managerpanel/images/search.png') }}"></span>

                                    <form method="get" action="{{ route('adminpanel.tree.search') }}" enctype="multipart/form-data" style="display: flex;" id="search_form">
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
                            <div class="admin-dashboard-user-dtl Manager-task-user-dtl manage-tree-task-user">
                                <div class="admin-dashboard-user-left-dtl">
                                    <div class="admin-dashboard-user-name">
                                        <button class="btn-main"> <a href="{{ route('adminpanel.tree.addall') }}">Import</a></button> &nbsp;&nbsp;&nbsp;
                                        <button class="btn-main"> <a href="{{ route('adminpanel.tree.exportCSV') }}">Export as Excel</a></button> &nbsp;&nbsp;&nbsp;

                                       <!-- <input type="button" class="btn-main" onclick = 'csv_treeReport()' value="Export as Excel" > -->
                                    </div>
                                    <div class="admin-dashboard-user-sm-list">
                                        <ul>
                                           
                                        </ul>
                                    </div>
                                </div>
                                 
                                <div class="admin-dashboard-user-right-dtl">
                                    <div class="admin-dashboard-sing-plus-icon">
                                        <a href="{{ route('adminpanel.tree.add') }}"><img src="{{ asset('managerpanel/images/plus.png') }}"></a>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;
                                   
       <!--  <a href="javascript:void(0);" class="btn-main" onclick='csv_treeReport()'>Export</a> -->
                                    <table id="tree_example" class="table table-striped table-bordered" style="display:none;width:100%">
                                        <thead>
                                            <tr>
                                                <th>TreeId</th>
                                                <th>Address</th>
                                                <th>Location</th>
                                                <th>Species</th>
                                                <th>Height (meter)</th>
                                                <th>Width (meter)</th>
                                                <th>Date Planted</th>
                                                <th>Comments</th>
                                                <th>Age Range</th>
                                                <th>Vitality</th>
                                                <th>Soil Type</th>
                                                <!-- <th>Tree Image</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <?
                                            $counter1=0;
                                            
                                            foreach($data as $s)
                                            {
                                                $treeid = $s->treeid;
                                                $address = $s->address;
                                                $location = $s->location;
                                                $species = $s->species;
                                                $height = $s->height;
                                                $trunk_diameter = $s->trunk_diameter;
                                                $date_planted = $s->date_planted;
                                                $comments = $s->comments;
                                                $age_range = $s->age_range;
                                                $vitality = $s->vitality;
                                                $soil_type = $s->soil_type;
                                                
                                                $treeImage = App\Http\Controllers\adminpanel\TreeController::getTreeImages($s->id); 
                                                $profile_picture = "";
                                                foreach($treeImage as $j)
                                                {
                                                    if($j->treeImage!="" && $j->treeImage!=null) 
                                                    {
                                                        if(file_exists(public_path()."/uploads/Tree_Images/".$j->treeImage)) 
                                                        {
                                                                $profile_picture.= $j->treeImage.",";
                                                        }
                                                    }
                                                }
                                                $profile_picture= trim($profile_picture,',');
                                            ?>
                                            <tr>
                                                <td><? echo $treeid; ?></td>
                                                <td><? echo $address; ?></td>
                                                <td><? echo $location; ?></td>
                                                <td><? echo $species; ?></td>
                                                <td><? echo $height; ?></td>
                                                <td><? echo $trunk_diameter; ?></td>
                                                <td><? echo $date_planted; ?></td>
                                                <td><? echo $comments; ?></td>
                                                <td><? echo $age_range; ?></td>
                                                <td><? echo $vitality; ?></td>
                                                <td><? echo $soil_type; ?></td>
                                                <td><? echo $profile_picture; ?></td>

                                            </tr>
                                            <?
                                        
                                            }
                                            ?> -->
                                        </tbody>
                                    </table>
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
                            <div class="admin-list-part manager-task-list-part-main manage-tree-page-page">
                                <div class="admin-dashboard-list-box manage-tree-dtl-part">
                                    <div class="manager-task-list-name">
                                        <div class="manager-task-list-name-left">
                                            <h4>Tree:</h4>
                                        </div>
                                    </div>
                                    <div class="manageuser-new-tab-design">
                                        <div class="view-job-table">
                                        <table id="example">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;">ID</th>
                                                    <th style="text-align: center;">Address</th>
                                                    <th style="text-align: center;">Location</th>
                                                    <th style="text-align: center;">Species</th>
                                                    <th style="text-align: center;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $counter = 0; ?>
                                                @foreach ($data as $d)
                                                <?php $counter++; ?>
                                                <tr>
                                                    <td style="text-align: center;padding-left: 0px;">{{ $d->treeid }}</td>
                                                    <!-- <td style="text-align: right;width: 8%;"></td> -->
                                                    <td style="text-align: center;">{{ $d->address }} </td>
                                                    <td style="text-align: center;">{{ $d->location}} </td>
                                                    <td style="text-align: center;">
                                                        
                                                        {{ $d->species }}
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div class="users-edit dropdown-menu-list">
                                                            <a href="javascript:;" data-toggle="dropdown">
                                                                <img src="http://treespower.com.sg/treespower/public/managerpanel/images/th-icon.png"></a>
                                                                <div class="dropdown-menu">
                                                                    <!-- <a class="dropdown-item" href="{{ url('/adminpanel/addjob/'.$d->id) }}"><span><i class="fas fa-plus"></i></span>Create Task</a> -->
                                                                    <a class="dropdown-item" href="{{ url('/adminpanel/viewtree/'.$d->id) }}"><span><i class="fas fa-eye"></i></span>View</a>
                                                                    <a class="dropdown-item" href="{{ url('/adminpanel/edittree/'.$d->id) }}"><span><i class="fas fa-edit"></i></span>Edit</a>
                                                                    <a class="dropdown-item delete-confirm" href="{{ url('/adminpanel/deletetree/'.$d->id) }}"><span><i class="fas fa-trash-alt"></i></span>Delete</a>
                                                                    
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    <div class="admin-dashboard-bottom-dtl">
                                        <div class="admin-dashboard-bottom-left">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination">
                                                    
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
       
        
         <script src="{{ asset('managerpanel/js/jquery.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="{{ asset('managerpanel/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('managerpanel/js/slick.min.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript" src="{{ asset('managerpanel/js/jquery.dataTables.min.js') }}" charset="UTF-8"></script>
        <script type="text/javascript" src="{{ asset('managerpanel/js/dataTables.bootstrap4.min.js') }}" charset="UTF-8"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable({
                    "pageLength": 10,
                    "aLengthMenu": [[10, 20, 25, 50, 75, 100, 200, 500, -1], [10, 20, 25, 50, 75, 100, 200, 500, "All"]]
                });
            } );
        </script>
        <script type="text/javascript">
            $('#startDate').datepicker({
                uiLibrary: 'bootstrap4'
            });
            $('#endDate').datepicker({
                uiLibrary: 'bootstrap4'
            });
        </script>
        <script type="text/javascript">
            $('.delete-confirm').on('click', function (event) 
            {
                event.preventDefault();
                const url = $(this).attr('href');
                swal({
                    title: 'Are you sure?',
                    text: 'You Want to Delete this Tree!!',
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script type="text/javascript">var SITE_URL_TEST = "{{URL::to('/')}}";</script>
    <script type="text/javascript">
    var csv_treeReport = function()
    {     
        $table = $('#tree_example');   
        var $rows = $table.find('tr:has(td),tr:has(th)');
        tmpColDelim = String.fromCharCode(11), // vertical tab character
        tmpRowDelim = String.fromCharCode(0), // null character

        // actual delimiter characters for CSV format
        colDelim = '","',
        rowDelim = '"\r\n"',

        // Grab text from table into CSV formatted string
        csv = '"' + $rows.map(function (i, row) {
            var $row = jQuery(row), $cols = $row.find('td,th');

            return $cols.map(function (j, col) {
                len = jQuery(col).find("h1").length;
                
                if(len > 0){
                    var $col = jQuery(col), text = $col.find('h1').text();
                }else{
                    var $col = jQuery(col), text = $col.text();
                }
                text = text.trim();
                return text.replace(/"/g, '""'); // escape double quotes

            }).get().join(tmpColDelim);

        }).get().join(tmpRowDelim)
            .split(tmpRowDelim).join(rowDelim)
            .split(tmpColDelim).join(colDelim) + '"',
                
       
        csvData = encodeURIComponent(csv);
       
        var formElement = document.querySelector("form");
        var formdata = new FormData(formElement);

        var tdate = new Date();
        var dd = tdate.getDate();
        var MM = tdate.getMonth();
        var yyyy = tdate.getFullYear();
        var currentDate = dd + "-" + (MM + 1) + "-" + yyyy;
        filename = 'treeReport_'+currentDate+'.xlsx';
        formdata.append('filename', filename);
        formdata.append('file', csvData);
        $.ajaxSetup({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({            
            type: "POST",                   
            url:'exportCSV',                               
            data: formdata,
            processData: false,
            contentType: false,            
            success: function(data) {        
            window.open('https://treespower.com.sg/treespower/download_csv.php?file='+filename, '_blank');
            },
            error: function(data) {                
                alert("something wrong!");                
            }
        });
        /*$.ajax(
        {
            url: "exportCSV",
            type: 'POST',
            dataType: "JSON",
            data: {
                "id": 1,
            },
            success: function (response)
            {
                console.log(response);
            }   
        });*/
    }
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

