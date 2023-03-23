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
    <link href="{{ asset('adminpanel/css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/gijgo.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpanel/css/responsive.css') }}" rel="stylesheet">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


</head>
<body>

<div id="sitemain">

    <!-- BEGIN :: DASHBOARD -->

    <div class="dashboard-main" id="dashboard">

    	@include('adminpanel.include.sidebar')

        <div class="dashboard-right-side-main">

            @include('adminpanel.include.header')

            <div class="top-dashboard-title">
                <div class="d-code-main">
                    <div class="d-title">
                        <h4><strong>{{ $username }}</strong><!-- <span>|</span>#XRS-45670 --></h4>
                    </div>
                </div>
                <div class="action-btn">
                    <!-- <input id="datepicker" width="150" /> -->
                </div>
            </div>

            <div class="dashboard-content-main">
                <div class="dashboard-content-left-main" style="width: 100%;">
                    <div class="row">
                        
                    </div>
                    <div class="row">
                    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<canvas id="myChart" style="width:100%;max-width:600px"></canvas>				
							<?php
							$class = App\Models\Tree::where('treeId',$treeId)->get();

                            $name[] = "";
                            $studyplan_newnew[] = "";
							foreach($class as $s)
							{
								$ar[] = $s->id;
								$name[] = "'$s->created_at'";
								
                                //$studyplan_newnew[] = "'$s->treeId'";
								$studyplan_newnew[] = App\Models\Tree::where('treeId',$s->treeId)->where('created_at',$s->created_at)->count(); 
							}

							$class_name = implode(',',$name);
							$studyplan_count = implode(',',$studyplan_newnew);
							?>
							<script>
							var xValues = [<? echo $class_name;?>];
							var yValues = [<? echo $studyplan_count;?>];
							var barColors = ["red", "green","blue","orange","brown","yellow","cyan","red", "green","blue","orange","brown","yellow","cyan","red", "green","blue","orange","brown","yellow","cyan","red", "green","blue","orange","brown","yellow","cyan","red", "green","blue","orange","brown","yellow","cyan","red", "green","blue","orange","brown","yellow","cyan","red", "green","blue","orange","brown","yellow","cyan","red", "green","blue","orange","brown","yellow","cyan"];

							new Chart("myChart", {
							  type: "bar",
							  data: {
								labels: xValues,
								datasets: [{
								  backgroundColor: barColors,
								  data: yValues
								}]
							  },
							  options: {
								legend: {display: false},
								title: {
								  display: true,
								  text: "Charging Data"
								}
							  }
							});
							</script>
						</div>
                    </div>
                </div>
                
            </div>

        </div>

    </div>

    <!-- END** :: DASHBOARD -->

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


<script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>

</body>
</html>