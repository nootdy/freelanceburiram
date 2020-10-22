@include('header.header')
<!DOCTYPE html>
<html>
<head></head>

<body>
  <div class="container">
    @foreach($title as $tt)
    <h3>รายชื่อฟรีแลนซ์ที่สมัครงาน <a href="{!!action('PostJobController@show',$tt->slug)!!}"><b>"{{$tt->title}}"</b></a></h3>
    @endforeach
    <hr>

        <div class="col-md-12">
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

          @if (session('status1'))
          <div class="alert alert-success alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                  <strong>สำเร็จ!</strong> {{ session('status1') }}
          </div>
          @endif

          @if (session('status2'))
          <div class="alert alert-danger alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                  <strong>พบข้อผิดพลาด!</strong> {{ session('status2') }}
          </div>
          @endif

          <h5>จำนวนทั้งหมด <b>@if(isset($count1)) {{$count1}} @else 0 @endif</b> คน</h5>
          <div class="table-responsive">
            <table id="mytable" class="table table-bordred table-striped">
              <thead>
                <th><input type="checkbox" id="checkall" /></th>
                <th>ตำแหน่งที่สมัคร</th>
                <th>รูป</th>
                <th>ชื่อ-สกุล</th>
                <th>สมัครเมื่อ</th>
              </thead>
              <tbody>
                @foreach($contact as $li)
                <form method="post" action="{!!action('ContactController@EmpAnswer')!!}" >
                <tr>
                  <td><input type="checkbox" name="id[]" value="{!!$li->id!!}" class="checkthis" /></td>
                  <td><a href="{!!($li->job_detail_id)!!}">{{$li->position}}</a></td>
                  <td><img src="/uploads/avatars/{{$li->avatar}} " class="img" width="30"></td>
                  <td><a href="{!!action('AuthController@show',$li->f_id)!!}">{{$li->first_name}} {{$li->last_name}}</a></td>
                  <td>{{$li->created_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <hr>
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="pull-left">
                   <a href="{!!action('AuthController@getAccountPage_Hire',$id)!!}"><input type="button" class="btn btn-warning" name="" value=" < ย้อนกลับ"></a>
              </div>
              <div class="pull-right">
                   <input type="submit" class="btn btn-danger" name="deny" value="ปฏิเสธ">
                   <input type="submit" class="btn btn-success" name="ok" value="ยอมรับ">
              </div>
            </form>
          </div>
        </div>


    <script type="text/javascript">
    $(document).ready(function(){
      $("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
          $("#mytable input[type=checkbox]").each(function () {
            $(this).prop("checked", true);
          });

        } else {
          $("#mytable input[type=checkbox]").each(function () {
            $(this).prop("checked", false);
          });
        }
      });

      $("[data-toggle=tooltip]").tooltip();
    });

    </script>

  </div>
</body>
</html>

@include('footer.footer')
