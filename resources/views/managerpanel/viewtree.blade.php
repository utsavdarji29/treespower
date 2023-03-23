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
                                    <form method="get" action="{{ route('managerpanel.category.search') }}" enctype="multipart/form-data" style="display: flex;" id="search_form">
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
                            <div class="admin-dashboard-box-main">
                        <div class="user-details-modal-main add-users-sub-dtl">
                            <div class="user-details-sub-dtl">
                                <div class="user-details-head">
                                    <h2>Tree Report:</h2>
                                    @foreach ($tree as $d)
                                        <button class="btn-main"><a href="{{ url('/managerpanel/edittree/'.$d->id) }}"><span><i class="fas fa-edit"></i></span>Edit</a></button>
                                    @endforeach
                                </div>
                                <div class="user-personla-dtl">
                                        <div class="add-users-form">
                                            <div class="view-tree-table-scroll">
                                                @foreach ($tree as $d) 
                                                <table class="table table-striped table-bordered" style="width:100%">
                                                <tr>
                                                    <td width="15%"><strong>Id</strong></td>
                                                    <td width="15%">{{ $d->treeid }}</td>
                                                    <td width="15%"><strong>Address</strong></td>
                                                    <td width="15%">{{ $d->address }}</td>
                                                </tr>                       
                                                <tr>
                                                    <td width="15%"><strong>Location</strong></td>
                                                    <td width="15%">{{ $d->location }}</td>
                                                    <td width="15%"><strong>Species</strong></td>
                                                    <td width="15%">{{ $d->species }}</td>   
                                                </tr>
                                                <tr>
                                                    <td width="15%"><strong>Age range</strong></td>
                                                    <td width="15%">{{ $d->age_range }}</td>
                                                    <td width="15%"><strong>Vitality</strong></td>
                                                    <td width="15%">{{ $d->vitality }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="15%"><strong>Soil Type</strong></td>
                                                    <td width="15%">{{ $d->soil_type }}</td>
                                                    <td width="15%"><strong>Height (meter)</strong></td>
                                                    <td width="15%">{{ $d->height }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="15%"><strong>Trunk diameter(meter)</strong></td>
                                                    <td width="15%">{{ $d->trunk_diameter }}</td>
                                                    <td width="15%"><strong>Date Planted</strong></td>
                                                    <td width="15%">{{ $d->date_planted }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="15%"><strong>Comments</strong></td>
                                                    <td width="15%">{{ $d->comments }}</td>
                                                    <td width="15%"><strong>Last Updated By The Person Name, Date and Time</strong></td>
                                                    <td width="15%">{{ $d->updated_id}}<br/>{{ $d->updated_at}}</td>
                                                </tr>
                                                <!-- <tr>
                                                        <td><a href="{{ url('/qrtree/'.$d->id) }}">View Qr Code</a></td>
                                                </tr> -->
                                                </table>
                                                @endforeach
                                            </div>
                                            <div class="view-tree-table-scroll">
                                                <table class="table table-striped table-bordered" style="width:100%">
                                                <th colspan="5" align="center"><h4>Tree Images</h4></th>   
                                                <tr>
                                                    
                                                    <?php 
                                                        $i=0;
                                                        ?>
                                                        @foreach ($treeimage as $j) 
                                                        
                                                            <?php
                                                                if ($i%5==0) 
                                                                {
                                                                    echo "</tr><tr>";
                                                                }
                                                            ?>
                                                    <td>
                                                        <span class="user-img-main" style="display: flex; flex-direction: row; align-items: center; justify-content: center;">
                                                            <?php
                                                                $profile_picture = URL::asset('images/default-user.jpg');
                                                                if($j->treeImage!="" && $j->treeImage!=null) 
                                                                {
                                                                    if(file_exists(public_path()."/uploads/Tree_Images/".$j->treeImage)) 
                                                                    {
                                                                        $profile_picture = URL::asset('uploads/Tree_Images/'.$j->treeImage);
                                                                    }
                                                                }
                                                            ?>
                                                            <span><img src="{{ $profile_picture }}" height="100px" width="100px"><br/>{{ $j->treeimage_date }}</span>
                                                        </span>
                                                    </td> 
                                                    <?php
                                                        $i++;
                                                         
                                                    ?>
                                                      
                                                    @endforeach
                                                </tr>
                                                </table>
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
        
        
        <!-- User Details -->
        <script src="{{ asset('managerpanel/js/jquery.min.js') }}"></script>
        <script src="{{ asset('managerpanel/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('managerpanel/js/slick.min.js') }}"></script>
        <!-- <script>
            $(window).on('load', function() {
                $('#user-detailsModal').modal('show');
            });
        </script> -->
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