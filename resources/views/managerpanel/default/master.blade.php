<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="{{ asset('adminpanel/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/highcharts.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/gijgo.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" media="screen">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/tagsinput.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/style2.css') }}" rel="stylesheet">
    
</head>
<body>

<div id="sitemain">

    <!-- BEGIN :: DASHBOARD -->

    <div class="dashboard-main" id="dashboard">

    	@include('managerpanel.include.sidebar')

        <div class="dashboard-right-side-main">

            @include('managerpanel.include.header')

            @yield('content')
            
            @include('managerpanel.include.footer')

        </div>

    </div>
    <!-- END** :: DASHBOARD -->
    @if(isset($formRoute) && $formRoute != '')
        {{ Form::open(array('route' => $formRoute, 'method' => 'post', 'enctype' => 'multipart/form-data')) }}
            {{ Form::hidden(
            'receiverid', 0,
            [
                'id' => 'receiverid'
            ]
            ) 
        }}
        <div id="smsText" class="modal fade" style="z-index:10000">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="task"></h4>
                    </div>
                    <div class="modal-body" id="Add_Common_Task_Form_Popup_Body">
                        <div class="row">
                                <div class="col-md-12">
                                    <label for="primary_contact_number">Message:</label>
                                    <div class="input-group" style="width: 100%;">
                                        <textarea name="msg" id="msg" class="form-control" style="height: 100px !important;margin-bottom: 15px;"></textarea>
                                        
                                    </div>
                                </div>
                                
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" id="btn_add_common_task">SEND</button>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    @endif

</div>


<script src="{{ asset('adminpanel/js/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="{{ asset('adminpanel/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminpanel/js/slick.min.js') }}"></script>
<script src="{{ asset('adminpanel/js/highcharts.js') }}"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="{{ asset('adminpanel/js/gijgo.min.js') }}"></script>
<script src="{{ asset('adminpanel/js/custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('adminpanel/js/jquery.dataTables.min.js') }}" charset="UTF-8"></script>
<script type="text/javascript" src="{{ asset('adminpanel/js/dataTables.bootstrap4.min.js') }}" charset="UTF-8"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('adminpanel/js/bootstrap-multiselectsplitter.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.2.5/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="{{ asset('adminpanel/js/tagsinput.js') }}"></script>
<script src="{{ asset('adminpanel/js/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('adminpanel/js/file-upload.js') }}"></script>  
<script src="{{ asset('adminpanel/ckeditor/ckeditor.js') }}"></script>  

<script>
        $(".dropdown-menu li a").click(function(){
          var selText = $(this).text();
          $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
        });
$('#startDate').datepicker({
            uiLibrary: 'bootstrap4'
            
        });
        $('#endDate').datepicker({
            uiLibrary: 'bootstrap4'
        });
        
    </script>
 <script>
        CKEDITOR.replace( 'description' );
    </script>
</body>
</html>