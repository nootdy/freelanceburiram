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
/*profile image input*/
.image-preview-input {
    position: relative;
	overflow: hidden;
	margin: 0px;
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
.image-preview-input input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
}
.image-preview-input-title {
    margin-left:2px;
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
      <span class="logo-lg"><b>Admini</b>FLB</span>
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
        <li class="treeview">
          <a href="/admin-ver">
            <i class="fa fa-user-times"></i>
            <span>ตรวจสอบสมาชิก</span>
          </a>
        </li>
        <li class="header">ข้อมูลผู้ดูแลระบบ</li>
        <li class="active"><a href="/admin-edit"><i class="fa fa-circle-o text-aqua"></i> <span>แก้ไขข้อมูลผู้ดูแลระบบ</span></a></li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        แก้ไขข้อมูลผู้ดูแลระบบ
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">แก้ไขข้อมูลผู้ดูแลระบบ</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
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
        <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="box box-primary">
              <div class="box-body">
                <div id="" >
                  <div class="box-body no-padding">

        @foreach($admininfo as $adinfo)
        <!-- /start แก้ไขข้อมูลส่วนตัว -->
            <form class="form-horizontal" enctype="multipart/form-data"  action="{!! action('AuthController@updateAdminAccount')!!}" method="post">
              <input type="hidden" name="id" value="{!!Auth::user()->id!!}">
              <div class="form-group">
                <label for="inputName" class="col-sm-4 control-label">ชื่อ</label>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputName" name="first_name" placeholder="" value="{!!Auth::user()->first_name!!}">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-4 control-label">นามสกุล</label>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputName" name="last_name" placeholder="" value="{!!Auth::user()->last_name!!}">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-4 control-label">เลขประจำตัวประชาชน</label>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputName" name="f_pid" placeholder="" value="{!!$adinfo->f_pid!!}">
                </div>
              </div>
              <?php $option = $adinfo->f_gender;  ?>
              <div class="form-group">
                <label for="inputName" class="col-sm-4 control-label">เพศ</label>
                <div class="col-sm-8">
                  <select class="form-control" value="{!!$adinfo->f_gender!!}"  name="f_gender" id="select2" single="single"  style="width: 100%;">
                    @if ($adinfo->f_gender ==  "M")
                    <option value="M" <?php echo 'selected="selected"'; ?>>ชาย</option>
                    <option value="F">หญิง</option>
                    @else
                    <option value="F" <?php echo 'selected="selected"'; ?>>หญิง</option>
                    <option value="M">ชาย</option>
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-4 control-label">เบอร์ส่วนตัว</label>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputName" name="f_tel" value="{!!$adinfo->f_tel!!}">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-4 control-label">ที่อยู่</label>

                <div class="col-sm-8">
                  <textarea class="form-control" name="f_address" rows="4" cols="80">{!!$adinfo->f_address!!}</textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="inputName" class="col-sm-4 control-label">รูปโปรไฟล์</label>

                <div class="col-sm-8">
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col-sm-8">
                        <img src="/uploads/avatars/{!!Auth::user()->avatar!!}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;" >
                      </br></br></br>
                      <div class="input-group image-preview">
                        <input type="text" class="form-control image-preview-filename" disabled="disabled">
                        <span class="input-group-btn">
                          <!-- image-preview-clear button -->
                          <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                            <span class="glyphicon glyphicon-remove"></span> Clear
                          </button>
                          <!-- image-preview-input  -->
                          <br>
                          <div class="btn btn-default image-preview-input">
                            <span class="glyphicon glyphicon-folder-open"></span>
                            <span class="image-preview-input-title">เลือกรูปใหม่</span>
                            <input type="file" accept="image/png, image/jpeg, image/gif" name="avatar"/>
                          </div>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            {!! csrf_field() !!}
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success pull-right">แก้ไขข้อมูล</button>
              </div>
            </div>
          </form>
      </div>
    </div>
    </div>
</div>
</div>
<div class="col-md-2"></div>

  </section>
</div>
<!-- /.row -->

    <!-- /.content -->

  <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Freelance</b> Buriram
      </div>
      <strong>Copyright &copy; 2017 <a href="http://www.google.com">Preeyanoot Suwannarat</a>.</strong> All rights
      reserved.
  </footer>


  <div class="control-sidebar-bg"></div>
</div>


  <!-- jQuery 2.2.3 -->
  <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="../../bootstrap/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../../plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/app.min.js"></script>

<!-- ./wrapper -->
<script>
  //profile image input
  $(document).on('click', '#close-preview', function(){
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        },
         function () {
           $('.image-preview').popover('hide');
        }
    );
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>รูป</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').text("ลบ").click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("เลือก");
    });
    // Create the preview image
    $(".image-preview-input input:file").change(function (){
        var img = $('<img/>', {
            id: 'dynamic',
            width:150,
            height:150
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("เปลี่ยน");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }
        reader.readAsDataURL(file);
    });
});
</script>

</body>
</html>
