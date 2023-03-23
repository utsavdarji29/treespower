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
                                     <form method="post" enctype="multipart/form-data" style="display: flex;" id="search_form">
                                    @csrf
                                </form>
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
                            <div class="admin-dashboard-box-main tree-report-page-main">
                                
                                <div class="user-details-modal-main add-users-sub-dtl view-job-dtl-main">
                                    <input type='button' id='btn' value='Print' onclick='printDiv();'>
                                    <div class="user-details-sub-dtl" id='DivIdToPrint'>
                                        <div class="user-details-head" style="align-self: center;">
                                            @foreach ($data as $d)
                                                <h4>Tree Id:{{ $d->treeid }}</h4>
                                            @endforeach
                                        
                                        <div class="user-details-head">
                                            @foreach ($data as $d)
                                                <img src="{{ asset('/qrDemo/QrImage/'.$d->qrImage ) }}" style="width: 450px">
                                            @endforeach
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
    
    <script>
            $('.first-button').on('click', function () {
                $('.animated-icon1').toggleClass('open');
                $('.admin-dashboard-leftsidebar').toggleClass('sidebar-open');
                $('body').toggleClass('res-menu-open');
            }); 
    </script>
    <script type="text/javascript">
        function printDiv() 
        {

          var divToPrint=document.getElementById('DivIdToPrint');

          var newWin=window.open('','Print-Window');

          newWin.document.open();

          newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

          newWin.document.close();

          setTimeout(function(){newWin.close();},10);

        }
    </script>
    </body>
</html>

