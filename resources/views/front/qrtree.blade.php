<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tree Details</title>
        <link rel="stylesheet" href="{{ asset('managerpanel/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/fontawesome-all.css') }}" >
        <link rel="stylesheet" href="{{ asset('managerpanel/css/searchboxstyle.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('managerpanel/css/style.css') }}" >
        <link rel="stylesheet" href="{{ asset('managerpanel/css/responsive.css') }}" >
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
                        @if (Auth::guard('admin')->check())
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
                        @elseif (Auth::guard('manager')->check())
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
                                            <a href="{{ route('managerpanel.job.manage') }}">
                                                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                                            <span>Manage Task</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('managerpanel.tree.manage') }}" class="active">
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
                        @endif
                        <div class="admin-dashboard-right">
                            <div class="admin-dashboard-searchbar-part">
                                <div class="admin-dashboard-searchbar">
                                     <form method="post" enctype="multipart/form-data" style="display: flex;" id="search_form">
                                    @csrf
                                </form>
                                </div>
                                @if (Auth::guard('admin')->check())
                                <div class="admin-dashboard-right-dtl">
                                    <?php 
                                        $adminName = "";
                                        $adminimage = "";
                                        $loginUserId1 = AUTH::user()->id;
                                        $admin = App\Models\Admin::where('id','=',$loginUserId1)->get(); 

                                        if (count($admin)>0) 
                                        {
                                            $adminName = $admin[0]->first_name." ".$admin[0]->last_name;
                                            if ($admin[0]->userImage != "" && $admin[0]->userImage != null) 
                                            {
                                                if(file_exists(public_path()."/uploads/userImages/".$admin[0]->userImage))
                                                {
                                                    $adminimage = asset('uploads/userImages/'.$admin[0]->userImage);
                                                }
                                            }
                                        }
                                    ?>
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
                                @elseif (Auth::guard('manager')->check())
                                <div class="admin-dashboard-right-dtl">
                                    <?php 
                                        //$adminName = "";
                                        $managerimage = "";
                                        $loginUserId = AUTH::user()->id;
                                        $manager = App\Models\Manager::where('id','=',$loginUserId)->get(); 

                                        if (count($manager)>0) 
                                        {
                                            $managerName = $manager[0]->first_name." ".$manager[0]->last_name;
                                            if ($manager[0]->managerImage != "" && $manager[0]->managerImage != null) 
                                            {
                                                if(file_exists(public_path()."/uploads/managerImages/".$manager[0]->managerImage))
                                                {
                                                    $managerimage = asset('uploads/managerImages/'.$manager[0]->managerImage);
                                                }
                                            }
                                        }
                                    ?> 
                                    <h4>Hi {{ $managerName }} You are Manager</h4>
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
                                @endif
                            </div>
                            
       
                            <div class="admin-dashboard-box-main tree-report-page-main">
                        <div class="user-details-modal-main add-users-sub-dtl view-job-dtl-main">
                            <div class="user-details-sub-dtl">
                                <div class="user-details-head">
                                    @foreach ($data as $d)
                                        <img src="{{ asset('/qrDemo/QrImage/'.$d->qrImage ) }}" style="width: 450px">
                                    @endforeach
                                </div>
                                <div class="user-personla-dtl view-job-personla-dtl tree-report-main-part">
                                        <div class="add-users-form">
                                            <div class="view-job-table">
                                            
                                                <table class="table table-striped table-bordered" style="width:100%">
                                                    
                                                </table>
                                           
                                            </div>
                                                <div class="tree-images-table">
                                                    
                                                </div>
                              
                                                <div class="add-users-fr-sec-inp">
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp form-group">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp form-group">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-users-fr-sec-inp">
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp form-group">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp form-group">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-users-fr-sec-inp">
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp form-group">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-users-fr-sec-inp">
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp form-group">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp form-group">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-users-fr-sec-inp">
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp form-group">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp form-group">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-users-fr-sec-inp">
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp form-group">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="add-users-sm-inp form-group">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
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
                            </div> 
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Details -->
        
        
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
            var $rows = $table.find('tr:has(td),tr:has(th)'),
        
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) 
            {
                var $row = jQuery(row), $cols = $row.find('td,th');

                return $cols.map(function (j, col) 
                {
                    len = jQuery(col).find("h1").length;
                
                    if(len > 0)
                    {
                        var $col = jQuery(col), text = $col.find('h1').text();
                    }
                    else
                    {
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
            filename = 'treeReport_'+currentDate+'.csv';
            formdata.append('filename', filename);
            formdata.append('file', csvData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({            
                type: "POST",                   
                url:'/treespower/adminpanel/exportCSV',                               
                data: formdata,
                processData: false,
                contentType: false,            
                success: function(data) 
                {              
                    //window.open(SITE_URL_TEST+'/download_csv.php?file='+filename, '_blank');
                    window.open('http://treespower.com.sg/treespower/download_csv.php?file='+filename, '_blank');
            
                },
                error: function(data) 
                {                
                    alert("something wrong!");                
                }
            });
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

