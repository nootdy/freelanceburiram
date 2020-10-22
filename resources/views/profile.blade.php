@include('header.header')

<title>Freelance Buriram | Acccount )</title>


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
   color: #ffd11a;
}
/*สีดาว #d17581*/
</style>
<body>
  <!-- <div class="container">
    <h1>โปรไฟล์</h1>
      <p>นี่คือโปรไฟล์ของ คุณ  <b>{{$user->first_name}} {{$user->last_name}}</b></p>

  </div> -->
  <div class="container">
    <section class="content-header">
      <h1>
        โปรไฟล์
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
            <div class="box-body box-profile">

              <div class="text-center">
                @if($check == false)
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

                <img class="img-responsive img-circle" src="/uploads/avatars/{{$user->avatar}} " alt="User's profile picture">
                <h3 class="profile-username text-center">{{$user->first_name}} {{$user->last_name}}</h3>
              <!-- Profile Image -->
              @foreach($user_info as $u_inf)
                  @if($u_inf->role_id == 1)

                    <p class="text-muted text-center">ฟรีแลนซ์</p>
                    <hr>
                    @if(Auth::check())
                    @if (Auth::user()->isEmployer())
                    <div class="text-center">
                      <a href ="{{url('sendmail')}}">
                        <button class="btn btn-success" type="submit" name="hire" value="{{$user->id}}"><i class="fa fa-paper-plane" aria-hidden="true"></i> สนใจจ้าง</button>
                      </a>
                    </div>
                    @endif
                    @endif

                    @else
                    <p class="text-muted text-center">ผู้ว่าจ้าง</p>
                    <p class="text-center">สถานประกอบการ : <span class="label label-primary">{{$user->e_comp_name}}</span></p>
                    <hr>
                    @if(Auth::check())
                    @if (Auth::user()->isFreelance())
                    <div class="text-center">
                      <form action="{!!action('MainController@search')!!}" method="post">
                        {!!csrf_field()!!}
                        <input type="hidden" name="company" value="{{$user->e_comp_name}}">
                      <button type="submit" class="btn btn-warning" name="from_profile">ประกาศงานของผู้ว่าจ้าง</button>
                    </form>
                    </div>
                    @endif
                    @endif
                    <hr>

                  @endif
              @endforeach
          </div>
        </div>

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">เกี่ยวกับ </h3>
            </div>
            @if($u_inf->role_id == 1)
            <div class="box-body">
              <strong><i class="fa fa-phone margin-r-5"></i> เบอร์ติดต่อ</strong>
              <p class="text-muted">{{$user->f_tel}}</p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> ที่อยู่</strong>
              <p class="text-muted">{{$user->f_address}}</p>
              <hr>
              <strong><i class="fa fa-pencil margin-r-5"></i> ทักษะงาน</strong>
              <p>
                <span class="label label-danger">{{$user->f_job_skills}}</span>
              </p>
              <hr>
              <strong><i class="fa fa-sign-in margin-r-5"></i> เข้าร่วมเมื่อ</strong>
              <p>{{$user->created_at}}</p>
            </div>
            @else
            <div class="box-body">
              <strong><i class="fa fa-phone margin-r-5"></i> เบอร์ติดต่อ</strong>
              <p class="text-muted">{{$user->e_comp_tel}}</p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> ที่อยู่</strong>
              <p class="text-muted">{{$user->e_comp_address}}</p>
              <hr>
              <strong><i class="fa fa-sign-in margin-r-5"></i> เข้าร่วมเมื่อ</strong>
              <p>{{$user->created_at}}</p>
            </div>
            @endif
          </div>
      </div>

        <div class="col-md-9">
          <div class="nav-tabs-custom">

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

            <div class="container">
              <div class="row">
                <div class="col-xs-12 col-md-8">
                  <div class="well well-sm">
                    <div class="row">
                      <div class="col-xs-12 text-center">
                        <span>เรทติ้งโดยเฉลี่ย</span>
                        <h1 class="rating-num">
                          <?php $avg = (round($rate_avg)); ?>
                          <?php echo $avg; ?>
                          </h1>
                          <div class="rating noHover">
                              <div class="stars starrr" data-rating="<?php echo $avg; ?>"></div>
                          </div>
                          <div>
                            <span class="glyphicon glyphicon-user"></span> รีวิว {{$count_reviewer}} คน
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @if($role == 1)
                <!-- หน้าฟรีแลนซ์ -->
                <!-- progress jobs -->
                <div class="row">
                  <div class="col-xs-12 col-md-8">
                  <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                      <i class="fa fa-list-alt"></i>

                      <p class="box-title">รายละเอียดการจ้างงานของคุณ : <i>{{$user->first_name}}</i></p>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><h5>คลิกดูรายละเอียด</h5>
                        </button>
                      </div>
                    </div>
                    <div class="box-body">
                      <div style="">
                        @if($fcontact == [])
                        <p class="text-center" style="color:red">** ยังไม่เกิดการจ้างงาน **</p>
                        @endif
                        <div class="nav-tabs-custom">
                          <table class="table table-striped">
                            <tr>
                              <th>ตำแหน่งงาน</th>
                              <th>ผู้ว่าจ้าง</th>
                              <th class="text-center">วันสิ้นสุดงาน</th>
                              <th class="text-center">สถานะ</th>
                            </tr>
                            <tr>
                              @foreach($fcontact as $fct)
                              <td><b>{{$fct->position}}</b></td>
                              <td><a href="{!!action('AuthController@show',$fct->user_id)!!}">{{$fct->e_comp_name}} <i>(คุณ {{$fct->first_name}} {{$fct->last_name}})</i></a></td>
                              <td class="text-center">{{$fct->end_date}}</td>
                              <td class="text-center">
                                <?php
                                $expire = strtotime($fct->end_date);
                                $today = strtotime("today midnight");
                                ?>
                                @if($today >= $expire)
                                <span class="label label-success">เสร็จงาน</span>
                                @else
                                <span class="label label-warning">กำลังทำ..</span>
                                @endif
                              </td>
                              <!-- if($fct->e_review_status == 0)
                              <td class="text-center"><span class="label label-warning">กำลังทำ..</span></td>
                              else
                              <td class="text-center"><span class="label label-success">เสร็จงาน</span></td>
                              endif -->
                            </tr>
                            @endforeach
                          </table>
                        </div>
                      </div>
                      <!-- /.box-body-->
                    </div>
                    <!-- /.box -->
                  </div>
                </div>
                </div>

                @elseif($role == 2)
                <!-- หน้าผู้ว่าจ้าง -->
                <div class="row">
                  <div class="col-xs-12 col-md-8">
                  <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                      <i class="fa fa-list-alt"></i>

                      <p class="box-title">รายละเอียดการจ้างงานของ : <i>{{$user->e_comp_name}}</i></p>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><h5>คลิกดูรายละเอียด</h5>
                        </button>
                      </div>
                    </div>
                    <div class="box-body">
                      <div style="">
                        @if($econtact == [])
                        <p class="text-center" style="color:red">** ยังไม่เกิดการจ้างงาน **</p>
                        @endif

                        <div class="nav-tabs-custom">
                          <table class="table table-striped">
                            <tr>
                              <th>ตำแหน่งงาน</th>
                              <th>รูป</th>
                              <th>ฟรีแลนซ์</th>
                              <th class="text-center">วันสิ้นสุดงาน</th>
                              <th class="text-center">สถานะ</th>
                            </tr>
                            <tr>
                            @foreach($econtact as $ect)
                              <td><b>{{$ect->position}}</b></td>
                              <td><img src="/uploads/avatars/{{$ect->avatar}} " class="img" width="30" alt="{!!$ect->first_name!!} {!!$ect->last_name!!}"></td>
                              <td><a href="{!!action('AuthController@show',$ect->f_id)!!}">{{$ect->first_name}} {{$ect->last_name}}</a></td>
                              <td class="text-center">{{$ect->end_date}}</td>
                              <td class="text-center">
                                <?php
                                $expire = strtotime($ect->end_date);
                                $today = strtotime("today midnight");
                                ?>
                                @if($today >= $expire)
                                <span class="label label-success">เสร็จงาน</span>
                                @else
                                <span class="label label-warning">กำลังทำ..</span>
                                @endif
                              </td>
                            </tr>
                            @endforeach

                          </table>
                        </div>
                      </div>
                      <!-- /.box-body-->
                    </div>
                    <!-- /.box -->
                  </div>
                </div>
                </div>
                @endif
      <h4><b>ความคิดเห็น</b></h4></br>
      @if($get_review == null)
      <div class="row">
        <div class="col-xs-12 col-md-8">
          <p class="text-center">**ยังไม่มีความคิดเห็นในระบบ**</p>
        </div>
      </div>
      @endif

      @foreach($get_review as $get_rev)
      <div class="row">
        <div class="col-xs-12 col-md-8">
          <div class="well well bs-component">
            <div class="post">
              <div class="user-block">
                <img class="img-circle img-bordered-sm" src="/uploads/avatars/{{$get_rev->avatar}}" alt="user image">

                <span class="description"><a href="{!!action('AuthController@show',$get_rev->reviewer)!!}">
                  <!-- แสดงชื่อบริษัทแทนชื่อจริง ถ้ามี -->
                  @if(isset($get_rev->e_comp_name))
                  <b>{{$get_rev->e_comp_name}}</b>
                  @else
                  <b>{{$get_rev->first_name}} {{$get_rev->last_name}}</b>
                  @endif
                </a> ได้แสดงความเห็นว่า <i class="pull-right"> เมื่อ {{$get_rev->created_at}} </i>
                  <br>
                  <span class="rating noHover stars starrr" data-rating="{{$get_rev->rate}}"></span>
                  <b class="pull-right">ตำแหน่ง : {{$get_rev->position}}</b><br>
              </div>
              <p>{{$get_rev->comment}}</p>
            </div>
          </div>
          <br>
        </div>
      </div>
      @endforeach
      </div>
    </div>
    </div>

    </div>
        <script type="text/javascript">
        (function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

        var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

        $(function(){

          var ratingsField = $('#ratings-hidden');


          $('.starrr').on('starrr:change', function(e, value){
            ratingsField.val(value);
          });
        });
        </script>
      </section>
    </div>
  </body>


    @include('footer.footer')
