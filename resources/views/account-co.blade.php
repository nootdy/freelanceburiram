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
   color: #ffd11a;
}
/*สีดาว #d17581*/

.iVote,.iVote li{
    display:block;
    margin:0px;
    padding:0px;
    list-style:none;
    float:left;
}
.iVote{
    clear:both;
    float:left;
}
.iVote li,.iVote li.VoteD{
    display:block;
    width:16px;
    height:15px;
    position:relative;
    background: url(images/jquery.ui.stars.gif) no-repeat 0 0;
    background-position: 0 -32px;
    margin-right:2px;
    cursor:pointer;
}
.iVote li.VoteD{
    background-position: 0 -64px;
}
.iVote li.VoteD2{
  background-position: 0 -48px;
}
span.showVoteText{
    padding-left:5px;
    font-style:italic;
}
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
</style>
  @section('content')


@if(Auth::user()->isEmployer())
<h4><b>รายชื่อผู้ร่วมงาน ({{ count($contact)}} คน)</b> </h4></br>
@else
<h4><b>รายชื่อผู้ร่วมงาน ({{ count($fcontact)}} คน)</b> </h4></br>
@endif

@foreach ($errors->all() as $error)
<div class="col-xs-12 col-md-9">
<div class="alert alert-danger alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
  <p><strong>พบข้อผิดพลาด!</strong><li>{{ $error }}</li></p><br>
</div>
</div>
@endforeach

@if (session('status'))
<div class="col-xs-12 col-md-9">
<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
  <strong>สำเร็จ!</strong> {{ session('status') }}
</div>
</div>
@endif

@if (session('status2'))
<div class="col-xs-12 col-md-9">
<div class="alert alert-danger alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
  <strong>พบข้อผิดพลาด!</strong> {{ session('status2') }}
</div>
</div>
@endif

<div class="row">
  @if(Auth::user()->isEmployer())
  <div class="col-xs-12 col-md-9">
    <table class="table table-striped">
      <tr>
        <!-- <th class="text-center">เลือก</th> -->
        <th>งาน</th>
        <th>รูป</th>
        <th>ตำแหน่ง</th>
        <th>ชื่อ-สกุล</th>
        <th class="text-center">หมายเหตุ</th>
        <th class="text-center">รีวิว</th>
      </tr>

      @if(count($contact) == 0)
      <p class="text-center" style="color:red">** ยังไม่มีรายชื่อผู้ร่วมงาน **</p>
      @endif

      @foreach($contact as $ct)
      <form accept-charset="UTF-8" action="{!!action('AuthController@reviews')!!}" method="post">
      <tr>
        <!-- @if(!$ct->e_review_status)
        <td class="text-center"><input type="radio"  name="contact_id[]" value="" /></td>
        @else
        <td class="text-center"><input type="radio" disabled/></td>
        @endif -->
        <td><a href="{!!action('PostJobController@show',$ct->slug_id)!!}" data-toggle="tooltip" data-placement="left" title="{!!$ct->title!!}"><b>{!!$ct->slug_id!!}</b></a></td>
        <td><img src="/uploads/avatars/{{$ct->avatar}} " class="img" width="30" alt="{!!$ct->first_name!!} {!!$ct->last_name!!}"></td>
        <td>{!!$ct->position!!}</td>
        <td><a href="{!!action('AuthController@show',$ct->f_id)!!}">{!!$ct->first_name!!} {!!$ct->last_name!!}</a></td>
        <td class="text-center">
          @if(!$ct->e_review_status)
          <span class="label label-danger">ยังไม่รีวิว</span>
          @else
          <span class="label label-success">รีวิวแล้ว</span>
          @endif
        </td>

        <!-- The Modal Zoom IMG-->
        <div id="myModal" class="modal">
          <span class="close">&times;</span>
          <img class="modal-content" id="img01">
          <div id="caption"></div>
        </div>

        <td class="text-center">
          @if(!$ct->e_review_status)
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <input name="slug_id" type="hidden" value="{!!$ct->slug_id!!}">
          <input name="reviewer" type="hidden" value="{!!Auth::user()->id!!}">
          <input name="reviewed" type="hidden" value="{!!$ct->f_id!!}">
          <input type="hidden" name="j_detail_id" value="{!!$ct->id!!}">

          <div class="box box-default collapsed-box">
              <div class="text-center">
                <i class="fa fa-minus" data-widget="collapse"></i>
              </div>
            <div class="box-body">
              <textarea class="form-control animated" cols="50" name="comment" placeholder="เขียนความคิดเห็นที่นี่" rows="3" required></textarea>
              <div class="pull-left">
                <p>กรุณาเลือกคะแนนเรทติ้ง</p>
                <input type="radio" name="rating" value="1" >1
                <input type="radio" name="rating" value="2" >2
                <input type="radio" name="rating" value="3" >3
                <input type="radio" name="rating" value="4" >4
                <input type="radio" name="rating" value="5" checked>5
              </div>
              <br>
              <div class="pull-right">
                <button type="reset" class="btn btn-danger btn-sm" >ยกเลิก</button>
                <button type="submit" class="btn btn-success btn-sm" >รีวิว</button>
              </div>
            </div>
          </div>
            <!-- /.box-body-->
          </div>
          @else
          @foreach($get_review as $rev)
            @if($rev->reviewed == $ct->f_id && $rev->job_detail_id == $ct->id )
            <span class="rating noHover stars starrr" data-rating="{!!$rev->rate!!}"></span>
            @endif
          @endforeach
          @endif
        </td>

        </form>
      </tr>

      @endforeach
      </table>

      </div>







    <!-- //ถ้าเป็นฟรีแลนซ์ -->
    @else
    <div class="col-xs-12 col-md-9">
      <table class="table table-striped">
        <tr>
          <!-- <th class="text-center">เลือก</th> -->
          <th>งาน</th>
          <th>ตำแหน่งงาน</th>
          <th class="text-center">ผู้ว่าจ้าง</th>
          <th class="text-center">ชื่อ-สกุล</th>
          <th class="text-center">หมายเหตุ</th>
          <th class="text-center">รีวิว</th>
        </tr>

          @if(count($fcontact) == 0)
          <p class="text-center" style="color:red">** ยังไม่มีรายชื่อผู้ร่วมงาน **</p>
          @endif

          @foreach($fcontact as $ct)
          <form accept-charset="UTF-8" action="{!!action('AuthController@reviews')!!}" method="post">
          <tr>
          @if(!$ct->f_review_status)
          <!-- <td class="text-center"><input type="radio"  id="freelance" name="contact_id[]" value="" /></td> -->
          @else
          <!-- <td class="text-center"><input type="radio" disabled /></td> -->
          @endif
          <td for="freelance"><a href="{!!action('PostJobController@show',$ct->slug)!!}" data-toggle="tooltip" data-placement="left" title="{!!$ct->title!!}"><b>{!!$ct->slug!!}</b></a></td>
          <td>{!!$ct->position!!}</td>
          <td class="text-center"><a href="{!!action('AuthController@show',$ct->user_id)!!}"><b>{!!$ct->e_comp_name!!}</b></a></td>
          <td class="text-center"><a href="{!!action('AuthController@show',$ct->user_id)!!}">{!!$ct->first_name!!} {!!$ct->last_name!!}</a></td>
          <td class="text-center">
            @if(!$ct->f_review_status)
            <span class="label label-danger">ยังไม่รีวิว</span>
            @else
            <span class="label label-success">รีวิวแล้ว</span>
            @endif
          </td>
          <td class="text-center">
            @if(!$ct->f_review_status)
            <input name="slug_id" type="hidden" value="{!!$ct->slug!!}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <input name="reviewer" type="hidden" value="{!!Auth::user()->id!!}">
            <input name="reviewed" type="hidden" value="{!!$ct->user_id!!}">
            <input type="hidden" name="j_detail_id" value="{!!$ct->id!!}">

            <div class="box box-default collapsed-box">
                <div class="text-center">
                  <!-- <input type="radio"  id="freelance" name="contact_id[]" data-widget="collapse" checked="checked" value="" /> -->
                  <i class="fa fa-minus" data-widget="collapse"></i>
                </div>
              <div class="box-body">
                <textarea class="form-control animated" cols="50" name="comment" placeholder="เขียนความคิดเห็นที่นี่" rows="3" required></textarea>
                <div class="pull-left">
                  <p>กรุณาเลือกคะแนนเรทติ้ง</p>
                  <input type="radio" name="rating" value="1" >1
                  <input type="radio" name="rating" value="2" >2
                  <input type="radio" name="rating" value="3" >3
                  <input type="radio" name="rating" value="4" >4
                  <input type="radio" name="rating" value="5" checked>5
                </div>
                <br>
                <div class="pull-right">
                  <button type="reset" class="btn btn-danger btn-sm" >ยกเลิก</button>
                  <button type="submit" class="btn btn-success btn-sm" >รีวิว</button>
                </div>
              </div>
            </div>
              <!-- /.box-body-->

            @else
              @foreach($get_review as $rev)
                @if($rev->reviewed == $ct->user_id )
                <span class="rating noHover stars starrr" data-rating="{!!$rev->rate!!}"></span>
                @endif
              @endforeach
            @endif
          </td>

        </form>
        </tr>
      @endforeach
      </table>
  </div>
  @endif


  <!-- FastClick -->
  <script src="../../plugins/fastclick/fastclick.js"></script>


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

@endsection

@include('footer.footer')
