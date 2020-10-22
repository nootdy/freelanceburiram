<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | FreelanceBuriram</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">


</head>
<style>
.progress-new {
  background-color: #708090;
}
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>F</b>LB</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>FLB</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/uploads/avatars/{{Auth::user()->avatar}} " class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="{{ route('logout') }}"><span class="glyphicon glyphicon-log-in" data-toggle="tooltip" data-placement="left" title="ออกจากระบบ"></span></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/uploads/avatars/{{Auth::user()->avatar}} " class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">เมนู</li>
        <li class="active">
          <a href="/admin">
            <i class="fa fa-pie-chart"></i> <span>ข้อมูลสถิติ</span>
          </a>
        </li>
        <li class="treeview">
          <a href="/admin-ver">
            <i class="fa fa-user-times"></i>
            <span>ตรวจสอบสมาชิก</span>
          </a>
        </li>

        <li class="header">ข้อมูลผู้ดูแลระบบ</li>
        <li><a href="/admin-edit"><i class="fa fa-circle-o text-aqua"></i> <span>แก้ไขข้อมูลผู้ดูแลระบบ</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ข้อมูลสถิติ
        <small>(ของระบบ)</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="/admin"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        @foreach ($errors->all() as $error)
        <div class="col-xs-12 col-md-9">
        <div class="alert alert-danger alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
          <p><strong>พบข้อผิดพลาด!</strong><li>{{ $error }}</li></p><br>
        </div>
        </div>
        @endforeach

        @if (session('status'))
        <div class="col-xs-12 col-md-9">
        <div class="alert alert-success alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
          <strong>สำเร็จ!</strong> {{ session('status') }}
        </div>
        </div>
        @endif
      </div>
      <div class="row">
        <div class="col-md-6">
          <!-- Line chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-user-plus"></i>

              <h3 class="box-title">ฟรีแลนซ์ มาใหม่</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div id="" style="height: 400px;">
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    @foreach($new_f as $f)
                    <li>
                      <img src="/uploads/avatars/{{$f->avatar}}" alt="User Image" width="130"  height="130">
                      <a class="users-list-name" href="{!!action('AuthController@show',$f->id)!!}">{{$f->first_name}} {{$f->last_name}}</a>
                      <span class="users-list-date">{{$f->f_job_skills}}</span>
                      <span class="users-list-date">{{$f->created_at}}</span>
                    </li>
                    @endforeach
                  </ul>


                  <!-- /.users-list -->
                </div>
              </div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->

          <!-- Area chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-list-alt"></i>

              <h3 class="box-title">ประกาศงานทั้งหมด
                <span class="label label-primary"> {{$jobs}} งาน</span>
                <span class="label label-primary"> {{$j_all}} ตำแหน่ง</span>
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div style="height: 300px;">

                <!-- //กราฟแท่ง -->

                  <!-- //กราฟแท่ง -->

                <div class="box-footer no-padding">
                  @foreach ($ctgr as $cate)
                  <ul class="nav nav-stacked">
                    <li style="background-color:#DCDCDC;"><a>{{$cate->name}} <span class="pull-right badge bg-grey">{{$cate->count_ct}} </span></a></li>
                  </ul>
                  @endforeach
                </div>

              </div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-building"></i>

              <h3 class="box-title">ผู้ว่าจ้าง มาใหม่</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div id="" style="height: 400px;">
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    @foreach($new_e as $e)
                    <li>
                      <img src="/uploads/avatars/{{$e->avatar}} " alt="User Image">
                      <a class="users-list-name" href="{!!action('AuthController@show',$e->id)!!}">{{$e->first_name}} {{$e->last_name}}</a>
                      <span class="users-list-date">{{$e->e_comp_name}}</span>
                      <span class="users-list-date">{{$e->created_at}}</span>
                    </li>
                    @endforeach

                  </ul>
                  <!-- /.users-list -->
                </div>
              </div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->

          <!-- Donut chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-users"></i>

              <h3 class="box-title">สมาชิกทั้งหมด <span class="label label-primary"> {{$all}} คน</span></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div>
                <h5 class="pull-left"> ผู้ว่าจ้าง <span class="badge"> {{$employers}} </span> คน</h5> <h5 class="pull-right"> ฟรีแลนซ์  <span class="badge"> {{$freelances}} </span> คน</h5>
              </div>
              <div id="donut-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
      </div>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Freelance</b> Buriram
      </div>
      <strong>Copyright &copy; 2017 <a href="http://www.google.com">Preeyanoot Suwannarat</a>.</strong> All rights
      reserved.
  </footer>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- FLOT CHARTS -->
<script src="../../plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="../../plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="../../plugins/flot/jquery.flot.pie.min.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="../../plugins/flot/jquery.flot.categories.min.js"></script>

<!-- Page script -->

<script>
  $(function () {

    /*
     * DONUT CHART
     * -----------
     */

    var donutData = [
      {label: "ฟรีแลนซ์", data: <?php echo $f_per ?>, color: "#FF9900"},
      {label: "ผู้ว่าจ้าง", data: <?php echo $e_per ?>, color: "#7f7f7f"},
    ];
    $.plot("#donut-chart", donutData, {
      series: {
        pie: {
          show: true,
          radius: 1,
          innerRadius: 0.5,
          label: {
            show: true,
            radius: 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    });
    /*
     * END DONUT CHART
     */

  });

  /*
   * Custom Label formatter
   * ----------------------
   */
  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
        + label
        + "<br>"
        + Math.round(series.percent) + "%</div>";
  }
</script>
<!-- // -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "ประเภทงานที่นิยมประกาศ"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",

		dataPoints: [
      <?php foreach ($ctgr as $key => $cate): ?>
      <?php
        if ($cate->id == 1) {
          $name1 = $cate->name;
          $co1 = $cate->count_ct;
        }
        elseif ($cate->id == 2) {
          $name2 = $cate->name;
          $co2 = $cate->count_ct;
        }
        elseif ($cate->id == 3) {
          $name3 = $cate->name;
          $co3 = $cate->count_ct;
        }
        elseif ($cate->id == 4) {
          $name4 = $cate->name;
          $co4 = $cate->count_ct;
        }
        elseif ($cate->id == 5) {
          $name5 = $cate->name;
          $co5 = $cate->count_ct;
        }
        elseif ($cate->id == 6) {
          $name6 = $cate->name;
          $co6 = $cate->count_ct;
        }
        elseif ($cate->id == 7) {
          $name7 = $cate->name;
          $co7 = $cate->count_ct;
        }
      ?>
      <?php endforeach; ?>

			{ label: "<?php echo $name1 ?>", y: <?php echo $co1 ?> },
      { label: "<?php echo $name2 ?>", y: <?php echo $co2 ?> },
      { label: "<?php echo $name3 ?>", y: <?php echo $co3 ?> },
      { label: "<?php echo $name4 ?>", y: <?php echo $co4 ?> },
      { label: "<?php echo $name5 ?>", y: <?php echo $co5 ?> },
      { label: "<?php echo $name6 ?>", y: <?php echo $co6 ?> },
      { label: "<?php echo $name7 ?>", y: <?php echo $co7 ?> }



		]

	}]
});
chart.render();

}
</script>

</body>
</html>
