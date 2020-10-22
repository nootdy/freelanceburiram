@include('header.header')

<title>Freelance Buriram | Acccount )</title>
<!-- <head>
  <script type="text/javascript" src="//code.jquery.com/jquery-compat-git.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/normalize.css">
  <link rel="stylesheet" type="text/css" href="/css/result-light.css">
  <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head> -->


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
<body>
  <div class="container">
    <section class="content-header">
      <h1>
        <a href="{!!action('AuthController@getAccountPage',$id)!!}">โปรไฟล์</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active"><a href="{!!action('AuthController@getAccountPage',$id)!!}">โปรไฟล์</a></li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">


            <div class="box-body box-profile">

              @if(Auth::check())
                @if(Auth::user()->isFreelance())
                <div class="text-center">
                  @if($check_ident == false)
                  <h4><span class="label badge"><i class="fa fa-times-circle" aria-hidden="true"></i> ยังไม่ยืนยันตัวตน</span></h4>
                  @endif

                  @foreach($status as $stt)
                  @if($stt->status == 0)
                  <h4><span class="label badge"><i class="fa fa-times-circle" aria-hidden="true"></i> ยังไม่ยืนยันตัวตน</span></h4>
                  @else
                  <h4><span class="label badge" style="background-color:green;"><i class="fa fa-check-circle" aria-hidden="true"></i> ยืนยันตัวตนเรียบร้อย</span></h4>
                  @endif
                  @endforeach
                </div>
                <br>
              <center><img class="img-circle" src="/uploads/avatars/{!!Auth::user()->avatar!!} " alt="User's profile picture" width="150" height="150"></center>
                <h3 class="profile-username text-center">{!!Auth::user()->first_name!!} {!!Auth::user()->last_name!!}</h3>
              <!-- Profile Image -->
              <p class="text-muted text-center">ฟรีแลนซ์</p>
              <hr>
                @endif
              @endif

              @if(Auth::check())
                @if(Auth::user()->isEmployer())
                <div class="text-center">
                  @if($check_ident == false)
                  <h4><span class="label badge"><i class="fa fa-times-circle" aria-hidden="true"></i> ยังไม่ยืนยันตัวตน</span></h4>
                  @endif

                  @foreach($status as $stt)
                  @if($stt->status == 0)
                  <h4><span class="label badge"><i class="fa fa-times-circle" aria-hidden="true"></i> ยังไม่ยืนยันตัวตน</span></h4>
                  @else
                  <h4><span class="label badge" style="background-color:green;"><i class="fa fa-check-circle" aria-hidden="true"></i> ยืนยันตัวตนเรียบร้อย</span></h4>
                  @endif
                  @endforeach
                </div>
                <br>
                <center><img class="text-center img-circle" src="/uploads/avatars/{!!Auth::user()->avatar!!} " alt="User's profile picture" width="150" height="150"></center>
                <h3 class="profile-username text-center"></h3>
                <p class="text-muted text-center">ผู้ว่าจ้าง</p>
              <hr>
              @endif
            @endif
          </div>
        </div>

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">เกี่ยวกับ </h3>
            </div>
            @if(Auth::check())
              @if(Auth::user()->isFreelance())
            @foreach($freelanceinfo as $finfo)
            <div class="box-body">
              <strong><i class="fa fa-phone margin-r-5"></i> เบอร์ติดต่อ</strong>
              <p class="text-muted">{!!$finfo->f_tel!!}</p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> ที่อยู่</strong>
              <p class="text-muted">{!!$finfo->f_address!!}</p>
              <hr>
              <strong><i class="fa fa-pencil margin-r-5"></i> ทักษะงาน</strong>
              <p>
                <span class="label label-danger">{!!$finfo->f_job_skills!!}</span>
              </p>
              <hr>
              <strong><i class="fa fa-sign-in margin-r-5"></i> เข้าร่วมเมื่อ</strong>
              <p>{!!$finfo->created_at!!}</p>
            </div>
            @endforeach
              @endif
            @endif
            <!-- //###### -->
            @if(Auth::check())
              @if(Auth::user()->isEmployer())
              @foreach($employerinfo as $einfo)
            <div class="box-body">
              <strong><i class="fa fa-phone margin-r-5"></i> เบอร์ติดต่อ</strong>
              <p class="text-muted">{!!$einfo->e_comp_tel!!}</p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> ที่อยู่</strong>
              <p class="text-muted">{!!$einfo->e_comp_address!!}</p>
              <hr>
              <strong><i class="fa fa-sign-in margin-r-5"></i> เข้าร่วมเมื่อ</strong>
              <p>{!!$einfo->created_at!!}</p>
            </div>
              @endforeach
            @endif
            @endif
          </div>
      </div>

      <!-- /.col -->
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li><h4><b>แก้ไขข้อมูลส่วนตัว</b></h4></li>
          </ul>

          @foreach ($errors->all() as $error)
          <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p><strong>พบข้อผิดพลาด!</strong><li>{{ $error }}</li></p><br>
          </div>
          @endforeach
          @if (session('status'))
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>สำเร็จ!</strong> {{ session('status') }}
          </div>
          @endif


          <div class="tab-content">


            <div class="row text-center">
              @if($check_ident == false)
              <h4>สถานะ : <span class="label label-danger">ยังไม่ยืนยันตัวตน</span></h4>
              @endif

              @foreach($status as $stt)
              @if($stt->status == 0)
              <h4>สถานะ : <span class="label label-warning">รอการยืนยัน</span></h4>
              <p>** ระบบจะใช้เวลาไม่เกิน 7 วันในการตรวจสอบข้อมูลของท่าน **</p>
              @else
              <h4>สถานะ : <span class="label label-success">ยืนยันตัวตนเรียบร้อย</span></h4>
              @endif
              @endforeach

              @if($check_ident == false)
              <a href="{!! action('AuthController@user_identify',$id)!!}">
                <button type="button" class="btn btn-primary">ทำการยืนยันตัวตน</button>
              </a>
              @endif

            </div>
            <hr>


                    @if(Auth::check())
                      @if (Auth::user()->isEmployer())
                    <!-- แก้ไขข้อมูลผู้ว่าจ้าง -->
                    @foreach($employerinfo as $einfo)
                  <!-- /start แก้ไขข้อมูลส่วนตัว -->
                  <form class="form-horizontal" enctype="multipart/form-data"  action="{!! action('AuthController@updateEmployerAccount')!!}" method="post">
                      <input type="hidden" name="id" value="{!!Auth::user()->id!!}">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">ชื่อ</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="first_name" id="inputName" placeholder="" value="{!!Auth::user()->first_name!!}" title="ชื่อ" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">นามสกุล</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="last_name" id="inputName" placeholder="" value="{!!Auth::user()->last_name!!}" title="นามสกุล" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">เลขประจำตัวประชาชน</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="e_pid" id="inputName" placeholder="" value="{!!$einfo->e_pid!!}" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"    maxlength="13" pattern="[0-9]{13,}" title="เลขประจำตัวประชาชนต้องมี 13 หลัก" required>
                        </div>
                      </div>
                        <?php $option = $einfo->e_gender;  ?>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-4 control-label">เพศ</label>
                          <div class="col-sm-8">
                          <select class="form-control" value="{!!$einfo->e_gender!!}"  name="e_gender" id="select2" single="single"  style="width: 100%;">
                                                      @if ($einfo->e_gender ==  "M")
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
                          <input type="text" class="form-control" name="e_tel" id="inputName" placeholder="" value="{!!$einfo->e_tel!!}" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"    maxlength="10" pattern="[0-9]{10,}" title="เบอร์โทรต้องเป็น 10 ตัว" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">ชื่อบริษัท/กิจการ</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="e_comp_name" id="inputName" placeholder="" value="{!!$einfo->e_comp_name!!}" title="ชื่อบริษัท/กิจการ" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">ที่อยู่บริษัท/กิจการ</label>

                        <div class="col-sm-8">
                          <textarea class="form-control" name="e_comp_address" rows="4" cols="80" title="ที่อยู่บริษัท/กิจการ" required>{!!$einfo->e_comp_address!!}</textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">เบอร์ติดต่องาน</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="e_comp_tel" id="inputName" placeholder="" value="{!!$einfo->e_comp_tel!!}" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"    maxlength="10" pattern="[0-9]{10,9}" title="เบอร์โทรต้องเป็นตัวเลข" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">รูปโปรไฟล์</label>

                        <div class="col-sm-8">
                          <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-8">
                                    <img src="uploads/avatars/{!!Auth::user()->avatar!!}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;" >
                                  </br></br></br>
                                  <div class="input-group image-preview">
                                    <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                    <span class="input-group-btn">
                                      <!-- image-preview-clear button -->
                                      <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                        <span class="glyphicon glyphicon-remove"></span> Clear
                                      </button>
                                      <!-- image-preview-input -->

                                      <div class="btn btn-default image-preview-input">
                                        <span class="glyphicon glyphicon-folder-open"></span>
                                        <span class="image-preview-input-title">เลือกรูปใหม่</span>
                                        <input type="file" accept="image/png, image/jpeg, image/gif" name="avatar"/> <!-- rename it -->
                                      </div>
                                    </span>
                                  </div><!-- /input-group image-preview [TO HERE]-->
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  @endforeach
                @endif
              @endif
                    <!-- สิ้นสุด แก้ไขข้อมูลผู้ว่าจ้าง -->
<!-- ####################################################################################################################################################### -->
                    @if(Auth::check())
                      @if (Auth::user()->isFreelance())
                    <!-- เริ่ม แก้ไขข้อมูลฟรีแลนซ์ -->
                      @foreach($freelanceinfo as $finfo)
                    <!-- /start แก้ไขข้อมูลส่วนตัว -->
                      <section class="panel">
                        <div class="panel-body">
                          <form class="form-horizontal" enctype="multipart/form-data"  action="{!! action('AuthController@updateFreelanceAccount')!!}" method="post">
                              <input type="hidden" name="id" value="{!!Auth::user()->id!!}">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">ชื่อ</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="inputName" name="first_name" placeholder="" value="{!!Auth::user()->first_name!!}" title="ชื่อ" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">นามสกุล</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="inputName" name="last_name" placeholder="" value="{!!Auth::user()->last_name!!}" title="นามสกุล" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">เลขประจำตัวประชาชน</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="inputName" name="f_pid" placeholder="" value="{!!$finfo->f_pid!!}" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"    maxlength="13" pattern="[0-9]{13,}" title="เลขประจำตัวประชาชนต้องมี 13 หลัก" required>
                        </div>
                      </div>
                      <?php $option = $finfo->f_gender;  ?>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">เพศ</label>
                        <div class="col-sm-8">
                        <select class="form-control" value="{!!$finfo->f_gender!!}"  name="f_gender" id="select2" single="single"  style="width: 100%;">
                                                    @if ($finfo->f_gender ==  "M")
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
                          <input type="text" class="form-control" id="inputName" name="f_tel" value="{!!$finfo->f_tel!!}" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"    maxlength="10" pattern="[0-9]{10,}" title="เบอร์โทรต้องเป็น 10 ตัว" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">ที่อยู่</label>

                        <div class="col-sm-8">
                          <textarea class="form-control" name="f_address" rows="4" cols="80" title="ที่อยู่" required>{!!$finfo->f_address!!}</textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">ทักษะงาน</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="inputName" name="f_job_skills" value="{!!$finfo->f_job_skills!!}" title="ทักษะงาน" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">ความสามารถพิเศษ</label>

                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="inputName" name="f_personal_skills" placeholder="" value="{!!$finfo->f_personal_skills!!}" title="ความสามารถพิเศษ" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label">ประเภทงานที่ถนัด</label>
                        <div class="col-sm-8">
                          <?php
                          $Size = unserialize($finfo->f_job_categories);
                          if (sizeof($Size)>0):
                          ?>
                          <input type="text" disabled class="form-control text-center" value="
                            <?php
                              echo implode(' , ',$Size);
                            ?>
                          ">

                          <?php endif; ?>
                          <select class="form-control " name="f_job_categories[]" multiple="multiple" data-placeholder="เลือกประเภทงาน" title="ประเภทงาน" required>
                            @foreach($category as $cate)
                            <option value="{{$cate->name}}" >{{$cate->name}}</option>
                            @endforeach
                          </select>
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
                      @endif
                    @endif

                        {!! csrf_field() !!}
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success pull-right">แก้ไขข้อมูล</button>
                        </div>
                      </div>
                    </form>
                  </div>

                            </div>
                        </section>

                    <!-- สิ้นสุด แก้ไขข้อมูลฟรีแลนซ์  -->
                </div>
              </div>
            </div>
          </section>


     <script src="../../plugins/select2/select2.full.min.js"></script>
     <script type="text/javascript">
     $(function () {
       $(".select2").select2();
     });
     </script>


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

    @include('footer.footer')
