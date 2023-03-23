<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('global.sitetitle') }} Adminpanel</title>
    <link href="{{ asset('adminpanel/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/highcharts.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/gijgo.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/tagsinput.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/style2.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/responsive.css') }}" rel="stylesheet">
</head>

<body>

    <div id="sitemain">

        <!-- BEGIN :: DASHBOARD -->

        <div class="dashboard-main" id="dashboard">

            @include('adminpanel.include.sidebar')

            <div class="dashboard-right-side-main">
                
                @include('adminpanel.include.header')

                <?php
                $label = "Create";
                $name = "";
                $userImage = "";
                $email = "";
                $password = "";
                $id = "";
                $isError = false;
                $formRoute = 'adminpanel.user.save';
                if(isset($data['error'])) {
                    $isError = true;
                    if($data['type']=="Edit") {
                        $label = "Edit";
                        $formRoute = 'adminpanel.user.update';
                    }
                    $name = $data['input']['name'];
                    $userImage = $data['input']['userImage'];
                    $email = $data['input']['email'];
                } else { 
                    if($data['type'] == "edit") {
                        $label = "Edit";
                        $name = $data['input'][0]->name;
                        $userImage = $data['input'][0]->userImage;
                        $email = $data['input'][0]->email;
                        $formRoute = 'adminpanel.user.update';
                    }
                } 
                ?>
                <div class="top-dashboard-title">
                    <div class="d-code-main">
                        <div class="d-title">
                            <h4><strong>{{ $label }} User</strong><span>|</span>Enter user details and submit </h4>
                        </div>
                    </div>
                    <!-- <div class="action-btn">
                        <a href="#" class="btn-main">Actions<span><img src="images/b.png"></span></a>
                    </div> -->
                </div>

                <div class="dashboard-content-main add-user-main">
                    <div class="add-user-one-main-content">
                        <!-- <div class="add-user-one-main-content-top">
                            <div class="add-user-one-main-content-top-left">
                                <h1>1</h1>
                            </div>
                            <div class="add-user-one-main-content-top-right">
                                <h1>Profile</h1>
                                <p>User’s Personal Information</p>
                            </div>
                        </div> -->
                        @if($errors->any())
                            <div class="error-message-box">                    
                                <p>{{$errors->first()}}</p>
                            </div>
                        @endif
                        @if($isError)
                            <div class="error-message-box">
                                <?php foreach($data['error']->all() as $error) {
                                    echo "<p>". $error . "</p>";
                                } ?>
                            </div>
                        @endif
                        {{ Form::open(array('route' => $formRoute, 'method' => 'post', 'enctype' => 'multipart/form-data')) }}
                            {{ Form::hidden(
                                'id', $id
                                ) 
                            }}
                            <div class="user-pro-detail-main-content">
                                <div class="user-pro-detail-sub-content">
                                    <div class="user-pro-detail-main-content-title">
                                        <h1>User management:</h1>
                                    </div>
                                    <div class="user-pro-detail-content">
                                        <div class="user-pro-detail-content-dt-one">
                                            <div class="user-pro-detail-content-left">
                                                <label>Enter firstname</label>
                                            </div>
                                            <div class="user-pro-detail-content-right">
                                                {{ Form::text(
                                                    'name', $name, 
                                                    [
                                                        'class' => 'form-control', 
                                                        'placeholder' => 'Enter Username',
                                                        'required' => false
                                                    ]
                                                    ) 
                                                }}
                                            </div>
                                        </div>
                                        
                                        <div class="user-pro-detail-content-dt-one">
                                            <div class="user-pro-detail-content-left">
                                                <label>Enter email address</label>
                                            </div>
                                            <div class="user-pro-detail-content-right">
                                                {{ Form::email(
                                                    'email', $email, 
                                                    [
                                                        'class' => 'form-control', 
                                                        'placeholder' => 'Enter email address',
                                                        'required' => false
                                                    ]
                                                    ) 
                                                }}
                                            </div>
                                        </div>

                                        <?php

                                        if($label == "Create") 
                                        {
                                            ?>
                                            <div class="user-pro-detail-content-dt-one">
                                                <div class="user-pro-detail-content-left">
                                                    <label>Enter password</label>
                                                </div>
                                                <div class="user-pro-detail-content-right">
                                                    {{ Form::password(
                                                        'password',  
                                                        [
                                                            'class' => 'form-control', 
                                                            'placeholder' => 'Enter password',
                                                            'required' => false
                                                        ]
                                                        ) 
                                                    }}
                                                </div>
                                            </div>
                                            <?php
                                        }

                                        ?>
                                    <div class="next-step-btn-main">
                                        {{ Form::button(
                                            'Save',
                                            [
                                                'class' => 'next-step',
                                                'type' => 'submit'
                                            ]
                                            )
                                        }}
                                    </div>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>

                @include('adminpanel.include.footer')

            </div>

        </div>

        <!-- END** :: DASHBOARD -->

    </div>

    <div class="index-top-text-main">
        <div class="container">
            <div class="row">
                <div class="index-top-text-sub">
                    <h1></h1>
                    <p></p>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('adminpanel/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="{{ asset('adminpanel/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminpanel/js/bootstrap-multiselectsplitter.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.2.5/jquery.bootstrap-touchspin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="{{ asset('adminpanel/js/slick.min.js') }}"></script>
    <script src="{{ asset('adminpanel/js/gijgo.min.js') }}"></script>
    <script src="{{ asset('adminpanel/js/tagsinput.js') }}"></script>
    <script src="{{ asset('adminpanel/js/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('adminpanel/js/file-upload.js') }}"></script>
    <script src="{{ asset('adminpanel/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('adminpanel/js/custom.js') }}"></script>

    <script>
        CKEDITOR.replace( 'description' );
    </script>

    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });

        $('#datepicker1').datepicker({
            uiLibrary: 'bootstrap4'
        });

        // $('.datepicker1').datepicker({
        //     uiLibrary: 'bootstrap4'
        // });

        // $('#datepicker2').datepicker({
        //     uiLibrary: 'bootstrap4'
        // });

        // $('#datepicker3').datepicker({
        //     uiLibrary: 'bootstrap4'
        // });

        $('#startDate').datepicker({
            uiLibrary: 'bootstrap4'
        });
        $('#endDate').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>

    <script>
        $('#datetimepicker1').datetimepicker({

        });
    </script>
    <script>
        $(".dropdown-menu li a").click(function(){
          var selText = $(this).text();
          $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
        });

        $("#addChild").click(function() {
            var child_counter = $("#child_counter");
            var child_counter_val = child_counter.val();
            child_counter_val = parseInt(child_counter_val)+parseInt(1);
            child_counter.val(child_counter_val);
            var childContainer = $("#childContainer");
            var childForm = '<div class="user-pro-detail-content-dt-one" id="cfnameContainer'+child_counter_val+'"><div style="position: absolute; right: 25px; cursor: pointer;"><img onclick="funRemoveChild('+child_counter_val+')" title="Remove child" alt="Remove child" src="{{ asset('/adminpanel/images/close-circle-outline.png') }}" width="25" height="25" ></div><div class="user-pro-detail-content-left"><label>Enter child firstname</label></div><div class="user-pro-detail-content-right"><input type="text" name="cfname'+child_counter_val+'" class="form-control" placeholder="Enter child firstname" ></div></div>';
            childForm += '<div class="user-pro-detail-content-dt-one" id="clnameContainer'+child_counter_val+'"><div class="user-pro-detail-content-left"><label>Enter child lastname</label></div><div class="user-pro-detail-content-right"><input type="text" name="clname'+child_counter_val+'" class="form-control" placeholder="Enter child lastname" ></div></div>';
            childForm += '<div class="user-pro-detail-content-dt-one" id="cgenderContainer'+child_counter_val+'"><div class="user-pro-detail-content-left"><label>Select child gender</label></div><div class="user-pro-detail-content-right"><label class="ki-radio ki-radio-bold ki-radio-brand"><input checked="checked" name="cgender'+child_counter_val+'" type="radio" value="M"> Male<span></span></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label class="ki-radio ki-radio-bold ki-radio-brand"><input name="cgender1" type="radio" value="F"> Female<span></span></label></div></div>';
            childForm += '<div class="user-pro-detail-content-dt-one" id="cbdateContainer'+child_counter_val+'"><div class="user-pro-detail-content-left"><label>Select child birthdate</label></div><div class="user-pro-detail-content-right"><input class="form-control" id="datepicker'+child_counter_val+'" placeholder="Select child birthdate" name="cbdate'+child_counter_val+'" type="text" value="" ></div></div>';
            childForm += '<div class="user-pro-detail-content-dt-one" id="chrContainer'+child_counter_val+'" style="padding-bottom: 0;"><hr style="width: 90%;"></div>';
            childForm += '<script id="scriptContainer'+child_counter_val+'">$("#datepicker'+child_counter_val+'").datepicker({uiLibrary: "bootstrap4"});<\/script>';
            childContainer.append(childForm);
        });

        var funRemoveChild = function(id) {
            console.log("ID: " + id);
            $("#cfnameContainer"+id).remove();
            $("#clnameContainer"+id).remove();
            $("#cgenderContainer"+id).remove();
            $("#cbdateContainer"+id).remove();
            $("#chrContainer"+id).remove();
            $("#scriptContainer"+id).remove();
        }
    </script>

</body>

</html>