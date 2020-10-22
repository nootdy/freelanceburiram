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

</style>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
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
        <li>
          <a href="/admin">
            <i class="fa fa-pie-chart"></i> <span>ข้อมูลสถิติ</span>
          </a>
        </li>
        <li class="treeview active">
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
        ระบบตรวจสอบข้อมูลสมาชิก
        <small>(โดยเช็คจากหลักฐานแสดงตัวตน)</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">ตรวจสอบสมาชิก</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @if (session('status'))
      <div class="alert alert-success alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
              <strong>สำเร็จ!</strong> {{ session('status') }}
      </div>
      @endif

      @if (session('status2'))
      <div class="alert alert-warning alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
              <strong>สำเร็จ!</strong> {{ session('status2') }}
      </div>
      @endif
      <div class="row">
        <div class="col-md-12">
          <!-- Donut chart -->
          <div class="box box-primary">
            <div class="box-body">
              <div>
                <h4 class="pull-left"> รอตรวจสอบ <span class="badge">{{$count_ident}}</span> คน</h4>
                <h4 class="pull-right"> ตรวจสอบแล้ว  <span class="badge">{{$count_identified}}</span> คน</h4>
              </div>
              <div id="donut-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-6">
          <div class="box  box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">ผู้ว่าจ้างที่รอตรวจสอบ  <span class="badge">{{count($employers)}}</span> คน</h3>
            </div>

            <div class="box-body table-responsive no-padding">
              <table class="table table">
                <tr>
                  <th class="text-center">รหัส</th>
                  <th>ชื่อ-สกุล</th>
                  <th>วันที่อัพโหลด</th>
                  <th class="text-center">จัดการ</th>
                </tr>
                <tr>
                @foreach($employers as $emps)

                  <td class="text-center">{{$emps->id}}</td>
                  <td>{{$emps->first_name}} {{$emps->last_name}}</td>
                  <td>{{$emps->created_at}}</td>
                  <td class="text-center"><a href="{!! action('AuthController@getAdminPage_Verify_Detail',$emps->id) !!}" class="btn-xs btn-danger glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="ดูข้อมูล"></a></td>
                </tr>
                  @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <!-- ข้างบน ผู้ว่าจ้าง ล่าง ฟรีแลนซ์----------------------------->

        <div class="col-md-6">
          <div class="box   box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">ฟรีแลนซ์ที่รอตรวจสอบ <span class="badge">{{count($freelances)}}</span> คน</h3>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table">
                <tr>
                  <th class="text-center">รหัส</th>
                  <th>ชื่อ-สกุล</th>
                  <th>วันที่อัพโหลด</th>
                  <th class="text-center">จัดการ</th>
                </tr>
                <tr>
                @foreach($freelances as $fln)
                  <td class="text-center">{{$fln->id}}</td>
                  <td>{{$fln->first_name}} {{$fln->last_name}}</td>
                  <td>{{$fln->created_at}}</td>
                  <td class="text-center">
                    <a href="{!! action('AuthController@getAdminPage_Verify_Detail',$fln->id) !!}" class="btn-xs btn-danger glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="ดูข้อมูล"></a>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>

      <!-- ตรวจสอบแล้ว -->
      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">สมาชิกที่ตรวจสอบแล้ว  <span class="badge">{{count($users_done)}}</span> คน</h3>
          </div>

          <div class="box-body table-responsive no-padding">
            <table class="table table">
              <tr>
                <th class="text-center">วันที่ยืนยัน</th>
                <th class="text-center">รหัส</th>
                <th class="text-center">รูป</th>
                <th>ชื่อ-สกุล</th>
                <th>บทบาท</th>
              </tr>
              <tr>
              @foreach($users_done as $u_done)
                <td class="text-center">{{$u_done->status_created}}</td>
                <td class="text-center">{{$u_done->id}}</td>
                <td class="text-center"><img src="/uploads/avatars/{{$u_done->avatar}} " class="img" width="30" alt="{!!$u_done->first_name!!} {!!$u_done->last_name!!}"></td>
                <td>{{$u_done->first_name}} {{$u_done->last_name}}</td>
                @if($u_done->role_id == 2)
                <td><h5><span class="label label-default">ผู้ว่าจ้าง</span></h5></td>
                @else
                <td><h5><span class="label label-warning">ฟรีแลนซ์</span></h5></td>
                @endif
              </tr>
              @endforeach
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- ตรวจสอบแล้ว -->


      </div>
    </section>
  </div>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Freelance</b> Buriram
      </div>
      <strong>Copyright &copy; 2017 <a href="http://www.google.com">Preeyanoot Suwannarat</a>.</strong> All rights
      reserved.
  </footer>


  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>

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
    {label: "ตรวจสอบแล้ว", data: <?php echo $done_per ?>, color: "#00CC66"},
    {label: "รอตรวจสอบ", data: <?php echo $wait_per ?>, color: "#FF6633"},
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



</body>
</html>
