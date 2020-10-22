<!DOCTYPE html>
<html>
<body>
  <div class="container">
    <section class="content-header">
      <h1>
        <a href="{!!action('AuthController@getAccountPage',$id)!!}">โปรไฟล์</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">โปรไฟล์</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <br>
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
                <center><img class="img-circle" src="/uploads/avatars/{!!$fuser->avatar!!} " alt="user" width="150" height="150"></center>
                <br>
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
                <center><img class="img-circle" src="/uploads/avatars/{!!$user->avatar!!} " alt="user" width="150" height="150"></center>
                <br>
                <p class="text-muted text-center">ผู้ว่าจ้าง</p>
              <hr>
              @endif
            @endif
        </div>

          <!-- About Me Box -->
          <div class="box box-primary">
            <h4>ข้อมูลบัญชีผู้ใช้</h4>
            <div class="box-header with-border  pull-left">
              @if(Auth::user()->isEmployer())
              <p><a href="{!!action('AuthController@getAccountPage_Co',$user->id)!!}"><i class="fa fa-users"></i><span> รายชื่อผู้ร่วมงาน</span></a></p>
              <p><a href="{!!action('AuthController@getAccountPage_Hire',$user->id)!!}"><i class="fa fa-list-alt"></i><span> งานที่ประกาศ</span></a></p>
              @else
              <p><a href="{!!action('AuthController@getAccountPage_Co',$fuser->id)!!}"><i class="fa fa-users"></i><span> รายชื่อผู้ร่วมงาน</span></a></p>
              <p><a href="{!!action('AuthController@getAccountPage_Hire',$fuser->id)!!}"><i class="fa fa-list-alt"></i><span> งานที่สมัคร</span></a></p>
              @endif

              <hr>
              <p><a href="{!!action('MainController@getEditAccountPage')!!}"><i class="fa fa-pencil"></i><span> แก้ไขข้อมูลส่วนตัว</span></a></p>
            </div>
          </div>
      </div>
      <div class="col-md-9">
        <div class="container">
            @yield('content')
        </div>
      </div>



      </div>
    </section>
  </div>
  </br>
</body>
</br>
