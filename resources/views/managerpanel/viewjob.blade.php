<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Details</title>
    <link rel="stylesheet" href="{{ asset('managerpanel/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/fontawesome-all.css') }}" >
    <link rel="stylesheet" href="{{ asset('managerpanel/css/searchboxstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/style.css?')}}"<?php echo time(); ?> >
    <link rel="stylesheet" href="{{ asset('managerpanel/css/responsive.css') }}" >
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
                                        <h2>Task Details:</h2>
                                        <!--<button type="button" class="close" data-dismiss="modal"><img src="{{ asset('managerpanel/images/close-icn.png') }}"></button>-->
                                    </div>
                                    <div class="user-personla-dtl">
                                        <div class="add-users-form">
                                            @foreach ($assignUser as $d) 
                                                <table class="table table-striped table-bordered" style="width:100%">
                                                    <th colspan="4" align="center"><h4>View Job Users</h4></th>
                                                    <tr>
                                                        <td width="15%"><strong>Job Title</strong></td>
                                                        <td width="15%">{{ $d->job_title }}</td>
                                                        <td width="15%" rowspan="3"><strong>Description</strong></td>
                                                        <td width="15%" rowspan="3">{{ $d->description }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="15%"><strong>Address</strong></td>
                                                        <td width="15%">{{ $d->address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="15%"><strong>Location</strong></td>
                                                        <td width="15%">{{ $d->location }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="15%"><strong>Date</strong></td>
                                                        <td width="15%">{{ $d->job_date }}</td>
                                                        <td width="15%"><strong>Start and End Time</strong></td>
                                                        <td width="15%">{{ $d->start_time }}-{{ $d->end_time }}</td>
                                                    </tr>                       
                                                    <tr>
                                                        <td width="15%"><strong>Tree Operator Name</strong></td>
                                                        <td width="15%">{{ $d->firstName }}</td>
                                                        <td width="15%"><strong>Manager Name</strong></td>
                                                        <td width="15%">{{ $d->first_name }}</td>
                                                    </tr>  
                                                </table>
                                            
                                            <div class="add-users-fr-sec-inp">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="add-users-sm-inp form-group">
                                                        <table class="table table-striped table-bordered" style="width:100%">
                                                            <tr>
                                                        <td width="15%" colspan="2"><h4>
                                                                    <a href="{{ url('/managerpanel/viewtree/'.$d->tree_id) }}">View Tree Detail</a>
                                                                </h4></td>
                                                        <td width="15%"><h4>
                                                                    <a href="{{ route('managerpanel.dashboard') }}">SUBMIT REPORT</a>
                                                                </h4></td>
                                                    </tr> 
                                                        </table>
                                                        @endforeach
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