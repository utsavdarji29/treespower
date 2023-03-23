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
                                        <a href="{{ route('managerpanel.report.manage') }}" class="active">
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
                                           @foreach ($report as $r) 
                                                <table class="table table-striped table-bordered" style="width:100%">
                                                    <tr>
                                                        <td width="15%"><strong>Report Date</strong></td>
                                                        <td width="15%">{{ $r->date }}</td>
                                                        <td width="15%"><strong>Time</strong></td>
                                                        <td width="15%">{{ $r->time }}</td>
                                                    </tr>                       
                                                    <tr>
                                                        <td width="15%"><strong>Subject</strong></td>
                                                        <td width="15%">{{ $r->subject }}</td>
                                                        <td width="15%"><strong>Location</strong></td>
                                                        <td width="15%">{{ $r->location }}</td>   
                                                    </tr>
                                                    <tr>
                                                        <td width="15%"><strong>Report Detail</strong></td>
                                                        <td width="15%">{{ $r->issue_details }}</td>
                                                        <td width="15%"><strong>Report Satus</strong></td>
                                                        <td width="15%">{{ $r->status }}</td>
                                                    </tr>
                                                    @if($r->task_id)
                                                    <tr>
                                                        <td><a href="{{ url('/managerpanel/viewjob/'.$r->task_id) }}">View Task</a></td>
                                                        <td>Report submitted from Task</td>
                                                        @if($r->checked_by != '0')
                                                        <td><strong>Checked by</strong></td>
                                                        <td>{{ $checkedbymanagernm }}</td>
                                                        @endif
                                                    </tr>
                                                    @elseif($r->tree_id)
                                                    <tr>
                                                        <td><a href="{{ url('/managerpanel/viewtree/'.$r->tree_id) }}">View Tree</a></td>
                                                        <td>Report submitted from Tree</td>
                                                        @if($r->checked_by != '0')
                                                        <td><strong>Checked by</strong></td>
                                                        <td>{{ $checkedbymanagernm }}</td>
                                                        @endif
                                                    </tr>
                                                    @endif
                                                </table>
                                            @endforeach
                                            
                                            
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