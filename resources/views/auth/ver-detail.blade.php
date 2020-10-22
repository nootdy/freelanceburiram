@include('header.header')

<title>Freelance Buriram | Acccount )</title>
<head>
</head>


<style>
#myBtn {
  display: none;
  position: fixed;
  bottom: 60px;
  right: 30px;
  z-index: 99;
  border: none;
  outline: none;
  background-color: grey;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 10px;
}

#myBtn:hover {
  background-color: #555;
}
</style>
<body>
  <div class="container">
    <section class="content-header">
      <h1>
        ตรวจสอบข้อมูล <small>(เพื่อยืนยันตัวตน)</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li><a href="{!!action('AuthController@getAdminPage_Verify')!!}">ตรวจสอบสมาชิก</a></li>
        <li class="active">รายละเอียดข้อมูล</li>
      </ol>
      <hr>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
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

          <div class="col-lg-6 text-center">
            @foreach($data as $dt)
            <p><img src="/uploads/avatars/{{$dt->avatar}}" class="img"  width="180px" height="180px" alt="{!!$dt->first_name!!} {!!$dt->last_name!!}"></p>

            <h4>ชื่อ - สกุล : {{$dt->first_name}} {{$dt->last_name}}</h4>

            @if($role_id == 2)
            <h4>สถานประกอบการ : {{$dt->e_comp_name}}</h4>
          </div>

          <div class="col-lg-6">
            <h4>ที่อยู่</h4>
            <p>{{$dt->e_comp_address}}</p>

            <h4>เบอร์โทร</h4>
            <p>{{$dt->e_comp_tel}}</p>

            <h4>เลขบัตรประจำตัวประชาชน</h4>
            <p>{{$dt->e_pid}}</p>

            @else
            <h4>ทักษะงาน : {{$dt->f_job_skills}}</h4>
            <h4>ความสามารถพิเศษ : {{$dt->f_personal_skills}}</h4>

              <?php
              $Size = unserialize($dt->f_job_categories);
              if (sizeof($Size)>0):
              ?>
              <h4>ประเภทงานที่ถนัด : <span class="label label-default">
                <?php
                  echo implode('<br>',$Size);
                ?>
              </span></h4><br>

              <?php endif; ?>


          </div>

          <div class="col-lg-6">
            <h4>ที่อยู่</h4>
            <p>{{$dt->f_address}}</p>

            <h4>เบอร์โทร</h4>
            <p>{{$dt->f_tel}}</p>

            <h4>เลขบัตรประจำตัวประชาชน</h4>
            <p>{{$dt->f_pid}}</p>
            @endif

            <hr>
            <div class="row">
              <form class="" action="{!! action('AuthController@getAdminPage_Verify_Detail_Answer',$dt->id) !!}" method="post">
                  {{ csrf_field() }}
                <button class="form-group pull-right btn btn-success" type="submit" name="yes" value="1">ยืนยันข้อมูลถูกต้อง</button>
                <button class="form-group pull-left btn btn-warning" type="submit" name="no" value="0">ข้อมูลไม่ครบ</button>
              </form>
            </div><br>
            <p class="text-center">** ข้อมูลไม่ครบ ระบบจะส่งอีเมลแจ้งไปยังสมาชิกให้ทำการอัพโหลดไฟล์ใหม่ **</p>
          </div>
          @endforeach



          <div class="col-lg-12">
            <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up" aria-hidden="true"></i> กลับข้างบน</button>
            <hr>
          </div>
          <div class="col-lg-12">
            @foreach($pics as $pcs)
            <?php
            $phpdate = strtotime( $pcs->created_at );
            $mysqldate = date( 'd-m-Y', $phpdate );
             ?>
             @endforeach
            <h4>ภาพที่อัพโหลด<small> (อัพโหลดเมื่อ : {{$mysqldate}})</small></h4>
            @foreach($pics as $pcs)
            <div class="text-center">
              <img src="/uploads/identified/{{$pcs->i_pic_path}} " class="img" width="680px" height="1020px" alt="{!!$dt->first_name!!} {!!$dt->last_name!!}">
            </div>
            @endforeach
          </div>
        </div>
        <br>

    </section><br>
  </div>
  <script>
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      document.getElementById("myBtn").style.display = "block";
    } else {
      document.getElementById("myBtn").style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>
</body>
    @include('footer.footer')
