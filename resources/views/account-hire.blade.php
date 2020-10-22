@include('header.header')
@extends('layouts.side')
<style>
/*review ไม่ให้แก้ไขดาวตรงหน้าหลักได้*/
.noHover{
    pointer-events: none;
}
/*review*/
.animated {
   -webkit-transition: height 0.2s;
   -moz-transition: height 0.2s;
   transition: height 0.2s;
}

.stars
{
   margin: 20px 0;
   font-size: 24px;
   color: #d17581;
}
</style>
  @section('content')

@if(Auth::user()->isFreelance())
<h4><b>งานที่สมัคร ({{ count($get_freelance)}} งาน)</b></h4></br>
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
<div class="row">
  <div class="col-xs-12 col-md-9">
    <table class="table table-striped">
      <tr>
        <th>หัวข้อ</th>
        <th>ตำแหน่ง</th>
        <th>ผู้ว่าจ้าง</th>
        <th>สมัครเมื่อ</th>
        <th class="text-center">สถานะ</th>
      </tr>
      <tr>
        @if($c == 0)
        <p class="text-center" style="color:red">** ยังไม่มีงานที่สมัครในระบบ **</p>
        @endif
        @foreach($get_freelance as $f_hire)
        <td><a href="{!!action('PostJobController@show',$f_hire->slug_id)!!}" data-toggle="tooltip" data-placement="left" title="{!!$f_hire->title!!}">{!!$f_hire->slug_id!!}</a></td>
        <td><b>{!!$f_hire->position!!}</b></td>
        <td><a href="{!!action('AuthController@show',$f_hire->user_id)!!}"><b>{!!$f_hire->e_comp_name!!}</b></a></td>
        <td>{!!$f_hire->created_at!!}</td>
        <td  class="text-center">
          @if($f_hire->status == 1)
          <span class="badge bg-green">รับแล้ว</span>
          @else
          <span class="badge bg-red">ยังไม่รับ</span>
          @endif
        </td>
      </tr>
      @endforeach
    </table>
  </div>



<!-- ฟรีแลนซ์ -->
@else
<!-- ผู้ว่าจ้าง -->




<h4><b>งานที่ประกาศ ({{ count($hire)}} งาน)</b></h4></br>
@if (session('status1'))
<div class="col-xs-12 col-md-9">
  <div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>สำเร็จ!</strong> {{ session('status1') }}
  </div>
</div>
@endif
@if (session('status2'))
<div class="col-xs-12 col-md-9">
  <div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>สำเร็จ!</strong> {{ session('status2') }}
  </div>
</div>
@endif
<div class="row">
  <div class="col-xs-12 col-md-9">
    <table class="table table-striped">
      <tr>
        <th class="text-center">สถานะงาน</th>
        <th>ประกาศเมื่อ</th>
        <th>หัวข้อ</th>
        <th>ผู้สมัครงาน</th>
      </tr>
      <tr>

        @foreach($hire as $hi)
        <td class="text-center">
          @if($hi->status == 0)
          <div class="btn-group btn-toggle">
            <button class="btn btn-xs btn-success active">เปิด</button>
            <a href="{!! action('AuthController@status',$hi->slug)!!}"><button class="btn btn-xs btn-default">ปิด</button></a>
          </div>
          @else
          <div class="btn-group btn-toggle">
            <a href="{!! action('AuthController@status',$hi->slug)!!}"><button class="btn btn-xs btn-default">เปิด</button></a>
            <button class="btn btn-xs btn-danger active">ปิด</button>
          </div>
          @endif
        </td>
        <td>{!!$hi->created_at!!}</td>
        <td>
            <a href="{!!action('PostJobController@edit',$hi->slug)!!}"><i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="left" title="แก้ไข"></i></a>
            | <a href="{!!action('PostJobController@show',$hi->slug)!!}"><b>{{$hi->title}} </b></a></td>
        <td>
          <a href="{!! action('ContactController@ContactStatus',$hi->slug)!!}" class="btn-xs btn-info glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="ดูรายชื่อผู้สมัคร"></a>


          @foreach($check_apply as $c_app)
              @if($hi->slug == $c_app->slug_id)
                  <i class="fa fa-user"></i>
              @endif
          @endforeach
        </td>

      </tr>
      @endforeach



    </table>
  </div>
  @endif


@endsection
@include('footer.footer')
