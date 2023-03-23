<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Manage Tree</title>
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
          .manager-task-list-name-left{
                width: 100%;
                justify-content: center;
          }
          .manager-task-list-part-main .admin-dashboard-list-box table thead th{
            font-weight: normal;
            font-size: 20px;
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
                                     <span class="search-icn"><img src="{{ asset('managerpanel/images/search.png') }}"></span>

                                    <form method="get" action="{{ route('managerpanel.tree.search') }}" enctype="multipart/form-data" style="display: flex;" id="search_form">
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
                                        
                                    </div>
                                    <div class="admin-dashboard-user-sm-list">
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="admin-dashboard-user-right-dtl">
                                    <!-- <div class="admin-dashboard-sing-plus-icon">
                                        <a href="{{ route('managerpanel.category.add') }}"><img src="{{ asset('managerpanel/images/plus.png') }}"></a>
                                       
                                    </div> -->
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
                            <div class="admin-list-part manager-task-list-part-main">
                                <div class="admin-dashboard-list-box">
                                    <div class="manager-task-list-name">
                                        <div class="manager-task-list-name-left">
                                            <h4>Tree:</h4>
                                        </div>
                                    </div>
                                    <div class="manageuser-new-tab-design">
                                        <div class="view-job-table">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;padding-left: 30px;">ID</th>
                                                        <th style="text-align: center;"></th>
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
                                                        <td style="text-align: center;padding-left: 20px;">{{ $d->treeid }}</td>
                                                        <td style="text-align: center;"></td>
                                                        <td style="text-align: center;">{{ $d->address }} </td>
                                                        <td style="text-align: center;">{{ $d->location}} </td>
                                                        <td style="text-align: center;">
                                                            
                                                            {{ $d->species }}
                                                        </td>
                                                        <td style="text-align: center;width: 24%">
                                                            <div class="users-edit dropdown-menu-list">
                                                                <a href="javascript:;" data-toggle="dropdown">
                                                                    <img src="http://treespower.com.sg/treespower/public/managerpanel/images/th-icon.png"></a>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="{{ url('/managerpanel/addjob/'.$d->id) }}"><span><i class="fas fa-plus"></i></span>Create Task</a>
                                                                        <a class="dropdown-item" href="{{ url('/managerpanel/viewtree/'.$d->id) }}"><span><i class="fas fa-eye"></i></span>View</a>
                                                                        <a class="dropdown-item" href="{{ url('/managerpanel/edittree/'.$d->id) }}"><span><i class="fas fa-edit"></i></span>Edit</a>
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
                                                    {{ $data->render() }}
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
    </body>
</html>

