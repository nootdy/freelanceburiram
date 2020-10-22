<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Top nav -->
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
/*ไม่แสดงสี link*/
a {
  color:inherit;
  text-decoration: none;
 }
.navbar-brand {
  background-color: grey;
}
</style>

<body class="hold-transition skin-blue layout-top-nav">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="/" class="navbar-brand"><b>Freelance</b>Buriram</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="{{ route('freelancesboard') }}">บอร์ดฟรีแลนซ์</a></li>
            <li><a href="{{ route('jobsboard') }}">บอร์ดประกาศงาน</a></li>
          </ul>
        </div>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            @if(!Auth::check())
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">ลงทะเบียน <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li class="divider"></li>
                <li><a href="{{ route('freelanceregister') }}">ลงทะเบียนฟรีแลนซ์</a></li>
                <li class="divider"></li>
                <li><a href="{{ route('employerregister') }}">ลงทะเบียนผู้ว่าจ้าง</a></li>
              </ul>
            </li>
            <li><a href="{{ route('login') }}">เข้าสู่ระบบ</a></li>
            @elseif (Auth::user()->isEmployer())
            <!-- //แสดงเมนู สร้างประกาศงานให้ผู้ว่าจ้าง -->
            <li><a href="{{ route('postjob') }}">สร้างประกาศงาน</a></li>
            <li class="dropdown">
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="/uploads/avatars/{!!Auth::user()->avatar!!}" class="user-image" alt="User Image">

                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">{!!Auth::user()->first_name!!}</span><span class="caret"></span>
                </a>
                <ul class="dropdown-menu with-border">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="/uploads/avatars/{!!Auth::user()->avatar!!}" class="img-circle" alt="User Image">

                    <p>
                      {!!Auth::user()->first_name!!} {!!Auth::user()->last_name!!} - ผู้ว่าจ้าง
                      <small>เข้าร่วมเมื่อ : {!!Auth::user()->created_at!!}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="row">
                      <div class="col-xs-4 text-center">
                        <a href="{!!action('AuthController@getAccountPage_Co',Auth::user()->id)!!}">
                          <i class="fa fa-users" data-toggle="tooltip" data-placement="top" title="ผู้ร่วมงาน"></i>
                        </a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="{!!action('AuthController@getAccountPage_Hire',Auth::user()->id)!!}">
                          <i class="fa fa-list-alt" data-toggle="tooltip" data-placement="top" title="งานที่ประกาศ"></i>
                        </a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="{!!action('MainController@getEditAccountPage',Auth::user()->id)!!}">
                          <i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูลส่วนตัว"></i>
                        </a>
                      </div>
                    </div>
                    <!-- /.row -->
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer" style="background-color: darkgrey;">
                    <div class="pull-left">
                      <a href="{!!action('AuthController@getAccountPage',Auth::user()->id)!!}" class="btn btn-primary btn-flat">โปรไฟล์</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('logout') }}" class="btn btn-danger btn-flat">ออกจากระบบ</a>
                    </div>
                  </li>
                </ul>
              </li>
          </li>
          @else
          <!-- //เป็นฟรีแลนซ์ -->
          <li class="dropdown">
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="/uploads/avatars/{!!Auth::user()->avatar!!}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{!!Auth::user()->first_name!!}</span><span class="caret"></span>
              </a>
              <ul class="dropdown-menu  with-border">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="/uploads/avatars/{!!Auth::user()->avatar!!}" class="img-circle" alt="User Image">

                  <p>
                    {!!Auth::user()->first_name!!} {!!Auth::user()->last_name!!} - ฟรีแลนซ์
                    <small>เข้าร่วมเมื่อ : {!!Auth::user()->created_at!!}</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="{!!action('AuthController@getAccountPage_Co',Auth::user()->id)!!}">
                        <i class="fa fa-users" data-toggle="tooltip" data-placement="top" title="ผู้ร่วมงาน"></i>
                      </a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="{!!action('AuthController@getAccountPage_Hire',Auth::user()->id)!!}">
                        <i class="fa fa-list-alt" data-toggle="tooltip" data-placement="top" title="งานที่สมัคร"></i>
                      </a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="{!!action('MainController@getEditAccountPage',Auth::user()->id)!!}">
                        <i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูลส่วนตัว"></i>
                      </a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer" style="background-color: darkgrey;">
                  <div class="pull-left">
                    <a href="{!!action('AuthController@getAccountPage',Auth::user()->id)!!}" class="btn btn-primary btn-flat">โปรไฟล์</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-flat">ออกจากระบบ</a>
                  </div>
                </li>
              </ul>
            </li>
        </li>
            @endif
        <!-- /.navbar-custom-menu -->
        <!-- /.navbar-custom-menu -->
      </div>
</div>
</nav>
</header>




<!-- Topnav scripts -->
<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<!-- header scripts -->
<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>


<!-- index dropdown ploblem -->
<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->




</body>
</html>
