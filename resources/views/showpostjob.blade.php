@include('header.header')
<head>
    <meta charset="utf-8">
</head>

<style>

.badge {
  padding: 1px 9px 2px;
  font-size: 12.025px;
  font-weight: bold;
  white-space: nowrap;
  color: #ffffff;
  background-color: #999999;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}
.badge:hover {
  color: #ffffff;
  text-decoration: none;
  cursor: pointer;
}
.badge-error {
  background-color: #b94a48;
}
.badge-error:hover {
  background-color: #953b39;
}
.badge-warning {
  background-color: #f89406;
}
.badge-warning:hover {
  background-color: #c67605;
}
.badge-success {
  background-color: #468847;
}
.badge-success:hover {
  background-color: #356635;
}
.badge-info {
  background-color: #3a87ad;
}
.badge-info:hover {
  background-color: #2d6987;
}
.badge-inverse {
  background-color: #333333;
}
.badge-inverse:hover {
  background-color: #1a1a1a;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
/*comment*/
.edit:hover {
    background-color: #555555;
    color: white;
}
.delete:hover {
    background-color: #555555;
    color: white;
}
.apply:hover {
    background-color: #555555;
    color: white;
}
.contact:hover {
    background-color: #555555;
    color: white;
}
/*//comment*/

.panel-shadow {
    box-shadow: rgba(0, 0, 0, 0.3) 7px 7px 7px;
}
.panel-white {
  border: 1px solid #dddddd;
}
.panel-white  .panel-heading {
  color: #333;
  background-color: #fff;
  border-color: #ddd;
}
.panel-white  .panel-footer {
  background-color: #fff;
  border-color: #ddd;
}

.post .post-heading {
  height: 95px;
  padding: 20px 15px;
}
.post .post-heading .avatar {
  width: 60px;
  height: 60px;
  display: block;
  margin-right: 15px;
}
.post .post-heading .meta .title {
  margin-bottom: 0;
}
.post .post-heading .meta .title a {
  color: black;
}
.post .post-heading .meta .title a:hover {
  color: #aaaaaa;
}
.post .post-heading .meta .time {
  margin-top: 8px;
  color: #999;
}
.post .post-image .image {
  width: 100%;
  height: auto;
}
.post .post-description {
  padding: 15px;
}
.post .post-description p {
  font-size: 14px;
}
.post .post-description .stats {
  margin-top: 20px;
}
.post .post-description .stats .stat-item {
  display: inline-block;
  margin-right: 15px;
}
.post .post-description .stats .stat-item .icon {
  margin-right: 8px;
}
.post .post-footer {
  border-top: 1px solid #ddd;
  padding: 15px;
}
.post .post-footer .input-group-addon a {
  color: #454545;
}
.post .post-footer .comments-list {
  padding: 0;
  margin-top: 20px;
  list-style-type: none;
}
.post .post-footer .comments-list .comment {
  display: block;
  width: 100%;
  margin: 20px 0;
}
.post .post-footer .comments-list .comment .avatar {
  width: 35px;
  height: 35px;
}
.post .post-footer .comments-list .comment .comment-heading {
  display: block;
  width: 100%;
}
.post .post-footer .comments-list .comment .comment-heading .user {
  font-size: 14px;
  font-weight: bold;
  display: inline;
  margin-top: 0;
  margin-right: 10px;
}
.post .post-footer .comments-list .comment .comment-heading .time {
  font-size: 12px;
  color: #aaa;
  margin-top: 0;
  display: inline;
}
.post .post-footer .comments-list .comment .comment-body {
  margin-left: 50px;
}
.post .post-footer .comments-list .comment > .comments-list {
  margin-left: 50px;
}
</style>
<body>
  <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          @foreach($title as $tt)
          <h1>{!!$tt->title!!}</a></h1>
          <div class="col-lg-6">
            <p class="lead"><i class="fa fa-user"></i> โดย คุณ <a href="{!!action('AuthController@show',$tt->id)!!}">{!!$tt->first_name!!} {!!$tt->last_name!!}</a></p>
          </div><br><br>

          <div class="well well-sm">
            <div class="row">
              <div class="col-lg-12">
                <p class="pull-left"><i class="fa fa-calendar"></i> ประกาศเมื่อ {!!$tt->created_at!!}</p>
                <p class="pull-right"><i class="fa fa-calendar"></i> แก้ไขล่าสุดเมื่อ {!!$tt->updated_at!!}</p>
              </div>
            </div>
          </div>
          <hr>

        @endforeach

                <!-- //error part -->
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                  <p><strong>พบข้อผิดพลาด!</strong><li>{{ $error }}</li></p><br>
                </div>
                @endforeach

                @if (session('status'))
                <div class="alert alert-success alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                  <strong>สำเร็จ!</strong> {{ session('status') }}
                </div>
                @endif

                @if (session('status2'))
                <div class="alert alert-danger alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                  <strong>แจ้งเตือนจากระบบ!</strong> {{ session('status2') }} <a href="{!!action('AuthController@getAccountPage_Co',Auth::user()->id)!!}">คลิกที่นี่</a>
                </div>
                @endif

                @if (session('status3'))
                <div class="alert alert-danger alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                  <strong>พบข้อผิดพลาด!</strong> {{ session('status3') }}
                </div>
                @endif

                @if (session('status4'))
                <div class="alert alert-warning alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                  <strong>พบข้อผิดพลาด!</strong> {{ session('status4') }}
                </div>
                @endif
                <!-- //error part -->
                <div class="row">
                  <div class="col-lg-8">
                    <!-- //รายละเอียดงานแต่ละตำแหน่ง -->
                    @foreach($test as $tt)

                  <h4 style="background-color:#e4e4e4;"><i class="fa fa-hand-o-right" aria-hidden="true"></i> <b>ตำแหน่งงาน : {!!$tt->position!!} </b>
                    <b class="pull-right">จำนวน : {!!$tt->amount!!}  คน
                      <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Open</button> -->
                    </b>
                  </h4>


                    <p class="pull-right">เริ่มงาน :
                      <span class="badge">{{$tt->start_date}}</span>
                      สิ้นสุด : <span class="badge">  {{$tt->end_date}}</span>
                    </p>


                    <p><i class="fa fa-tags"></i> ประเภทงาน: <a href="">
                      <span class="badge">
                          {{$tt->name}}
                      </span></a>
                    </p>

                    <p class="pull-right">ค่าจ้าง :
                      <span class="badge">{{$tt->min_pay}}</span>
                      ถึง : <span class="badge">  {{$tt->max_pay}}</span> บาท
                    </p>

                    <p><strong>รายละเอียดงาน :</strong></p>
                    <div class="form-group">
                      <textarea  disabled class="form-control" style="background-color:#FFFFFF;" name="job_description" rows="5" cols="20"
                      id="" placeholder="" >{!!$tt->job_description!!}</textarea>
                    </div>
                    @endforeach


                    @if(Auth::check())
                    @if (Auth::user()->isFreelance())
                    <div class="row">
                      <div class="col-sm-7 pull-right">
                        <button type="submit" class="btn btn-warning apply" data-toggle="modal" data-target="#myModal"><a href="#">สมัครงานนี้ </a></button>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">กรุณาเลือกตำแหน่งงาน ที่ต้องการสมัคร</h4>
                              </div>
                              <div class="modal-body">
                                @foreach($job as $inf)
                                <form class="form-horizontal" method="post" action="{!!action('ContactController@apply',$inf->slug)!!}" >
                                  <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                                  <input type="checkbox" name="job_detail_id[]" value="{!!$inf->id!!}"> <label><b>id: {!!$inf->id!!} / ตำแหน่งงาน : {!!$inf->position!!} ({!!$inf->amount!!} คน)</b></label><br>
                                  @endforeach
                                  <hr>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-primary" name="save_apply" > บันทึกการสมัคร</button>
                                  </div>
                                </form>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                      </div>
                    </div>
                    @endif
                    @endif
                    <hr>
                    <!-- <h3>ฟรีแลนซ์ที่ตรงงาน :</h3> -->
                          @if(Auth::check())
                          @if(Auth::user()->isEmployer())
                          @if(Auth::user()->id == $tt->user_id)

                          <div class="row">
                            <div class="col-lg-12">
                            <h2>ฟรีแลนซ์ที่ใกล้เคียง</h2>


                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th class="text-center">รูป</th>
                                  <th>ชื่อ-สกุล</th>
                                  <th>ทักษะงานที่มี</th>
                                  <th>ประเภทงานที่ถนัด</th>
                                  <th class="text-center">จัดการ</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $match = DB::table('users')
                                ->WhereRaw("
                                MATCH(f_job_skills) AGAINST ('$tt->position' IN NATURAL LANGUAGE MODE) OR
                                MATCH(f_job_categories) AGAINST ('$tt->name' IN NATURAL LANGUAGE MODE)")
                                ->select('users.first_name','users.last_name','users.avatar','users.f_job_skills','users.id','users.f_job_categories')
                                ->get();
                                 ?>
                                @foreach($match as $mch)
                                <tr>
                                  <td class="text-center"><img src="/uploads/avatars/{{$mch->avatar}} " class="img" width="70"  height="70"></td>
                                  <td><a href="{!!action('AuthController@show',$mch->id)!!}"><b>{{$mch->first_name}} <br> {{$mch->last_name}}</b></a></td>
                                  <td>{{$mch->f_job_skills}}</td>
                                  <td>
                                    <?php
                                  $Size = unserialize($mch->f_job_categories);
                                  if (sizeof($Size)>0):
                                  ?>
                                  <h4><span class="label label-default">
                                    <?php
                                      echo implode('<br>',$Size);
                                    ?>
                                  </span></h4><br><br>

                                  <?php endif; ?>
                                </td>
                                <td class="text-center">
                                  <a href ="{{url('sendmail')}}">
                                    <button class="btn btn-success btn-sm" type="submit" name="hire" value="{{$mch->id}}"><i class="fa fa-paper-plane" aria-hidden="true"></i> จ้าง</button>
                                  </a>
                                </td>
                                </tr>
                              </tbody>
                              @endforeach
                            </table>
                          </div>
                          </div>
                          @endif
                          @endif
                          @endif

                    <hr>
                    <!-- <h3>ความคิดเห็น :</h3> -->
                    <div class="form-group">

                      <div class="well bs-component">
                        <div class="well well bs-component">
                          <form class="form-horizontal" method="post" action="{!!action("PostJobController@newComment")!!}" >


                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="post_id" value="{!! $tt->id !!}">

                            <fieldset>
                              <legend>แสดงความคิดเห็น</legend>
                              <div class="form-group">
                                <div class="col-lg-12">
                                  <textarea class="form-control" rows="3" id="content" name="content" required></textarea>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                  <button type="submit" class="btn btn-primary pull-right">โพสต์</button>
                                </div>
                              </div>
                            </fieldset>
                          </form>
                        </div>

                        @foreach($comments as $cm)
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="panel panel-white post panel-shadow">
                              <div class="post-heading">
                                <div class="pull-left image">
                                  <img src="/uploads/avatars/{!!$cm->avatar!!}  " class="img-circle avatar" alt="user profile image">
                                </div>
                                <div class="pull-left meta">
                                  <div class="title h5">
                                    <a href="{!!action('AuthController@show',$cm->user_id)!!}"><b>{!!$cm->first_name!!} {!!$cm->last_name!!}</b></a>
                                    ได้แสดงความคิดเห็น
                                  </div>
                                  <h6 class="text-muted time">เมื่อ {!!$cm->created_at!!}</h6>
                                </div>
                              </div>
                              <div class="post-description">
                                <p>{!!$cm->content!!}</p>
                              </div>
                            </div></br>
                          </div>
                        </div>
                        @endforeach
                      </br>
                    </div></br>
                  </div>
                </div>
              <div class="col-lg-4">
                @if(Auth::check())
                @if(Auth::user()->isEmployer())
                @if(Auth::user()->id == $tt->user_id)
                <div class="well">
                  <h4><i class="fa fa-cog"></i>&nbsp;จัดการประกาศงาน</h4>
                  <div class="row">
                    <div class="col-lg-12">
                      <li><span class="badge-default"> สถานะประกาศงาน : {!! $tt->status ? 'ปิด' : 'เปิด' !!}</span></li>
                      <hr>
                      <div class="col-lg-6">
                        <a href="{!! action('PostJobController@edit',$tt->slug)!!}">
                        <button type="submit" class="btn btn-info edit"><i class="fa fa-pencil">&nbsp;&nbsp;&nbsp;&nbsp; แก้ไข</i></button>
                        </a>
                      </div>
                      @if ($tt->status == 0)
                      <div class="col-lg-6">
                        <a href="{!! action('PostJobController@status',$tt->slug)!!}">
                          <button type="submit" class="btn btn-danger">ต้องการปิดงานนี้</button>
                        </a>
                      </div>
                      @else
                      <div class="col-lg-6">
                        <a href="{!! action('PostJobController@status',$tt->slug)!!}">
                          <button type="submit" class="btn btn-success">ต้องการเปิดงานนี้</button>
                        </a>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
                @endif
                @endif
                @endif
                <!-- /well -->


                <!-- /well -->
                <div class="well">
                  <h4><i class="fa fa-list-alt"></i> ติดต่อ :</h4>
                  <div class="row">
                    <div class="col-lg-12">
                      <ul class="list-unstyled">
                        @foreach($title as $tt)
                        <li><b>โปรไฟล์</b></li>
                        :: <span><a href="{!!action('AuthController@show',$tt->id)!!}">{!!$tt->first_name!!} {!!$tt->last_name!!}</a></span>
                        <li><b>ที่อยู่</b></li>
                        :: <span>{!!$tt->e_comp_address!!}</span>
                        <li><b>โทร</b></li>
                        :: <span>{!!$tt->e_comp_tel!!}</span>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
                <!-- /well -->
              </div>
            </div>
        <hr>
    </div>
  </section>
</body>


@include('footer.footer')
