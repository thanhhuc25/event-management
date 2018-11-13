@extends('layouts.admin')

@section('title')
    {{"イベント作成"}}
@endsection

@section('header')
    <link href="{{ asset('assets/bootstrap-3/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <script src="//ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <style>
        #position_master_container {
            padding-left: 30px;
        }
        #position_master_container label{
            display: block;
        }
        #position_detail {
            display: inline-block;
            width: 300px;
            display: none;
        }
        #position_master_container_error {
            color: #a94442; padding-left: 0;
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container" id="app">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{$event->id == 0 ? "イベント作成" : "イベント編集"}}
                        </h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" class="" enctype="multipart/form-data" id="form-save">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group" id="shop_name-container">
                                        <label for="shop_name">{{"ショップ名"}}*</label>
                                        <input type="text" class="form-control" value="{{$event->shop_name}}"
                                               id="shop_name" name="shop_name" placeholder="ショップ名">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="category">{{"カテゴリー"}}</label>
                                        <select id="category" name="category" class="form-control">
                                            <option value="">選択してください</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{ $category->id == $event->category_id ? "selected" : "" }}>
                                                    {{$category->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label>郵便番号</label>
                                        <div>
                                            〒
                                            <input value="{{$event->zip01}}" maxlength="3" type="text" id="zip01" name="zip01" pattern="\d*" class="form-control zip-c" placeholder="141">
                                            -
                                            <input value="{{$event->zip02}}" maxlength="4" type="text" id="zip02" name="zip02" pattern="\d*" class="form-control zip-c" placeholder="0032">
                                            <button class="btn bn-sm btn-success" id="btn-auto-zip">郵便番号から住所を自動取得</button>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="province_id">{{"都道府県"}}</label>
                                        <select id="province_id" name="province_id" class="form-control">
                                            <option value="">選択してください</option>
                                            @foreach($provinces as $province)
                                                <option value="{{$province->id}}"
                                                        {{ $province->id == $event->province_id ? "selected" : "" }}>
                                                    {{$province->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group" >
                                        <label for="position">{{"開催場所"}}</label>
                                        <input type="text" class="form-control" value="{{$event->position}}"
                                               id="position" name="position" placeholder="開催場所">
                                    </div>
                                    <div class="form-group" id="position_master_container">
                                        <div id="position_master_container_error" style="">選択してください</div>
                                        <label class="">
                                            <input type="radio" value="店頭" name="position_master" {{$event->position_master=="店頭" ? "checked" : ""}}>
                                            店頭
                                        </label>
                                        <label class="">
                                            <input type="radio" value="倉庫" name="position_master" {{$event->position_master=="倉庫" ? "checked" : ""}}>
                                            倉庫
                                        </label>
                                        <label class="">
                                            <input type="radio" value="事務所" name="position_master" {{$event->position_master=="事務所" ? "checked" : ""}}>
                                            事務所
                                        </label>
                                        <label class="">
                                            <input type="radio" value="その他" name="position_master" {{$event->position_master=="その他" ? "checked" : ""}}>
                                            その他
                                            <input style="font-weight: normal" type="text" class="form-control" value="{{$event->position_detail}}"
                                                   id="position_detail" name="position_detail" placeholder="">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">

                                    <div class="form-group">
                                        <label for="phone">{{"連絡先"}}</label>
                                        <input type="text" class="form-control" value="{{$event->phone}}"
                                               id="phone" name="phone" placeholder="連絡先">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone2">{{"当日のお問合せ先"}}</label>
                                        <input type="text" class="form-control" value="{{$event->phone2}}"
                                               id="phone2" name="phone2" placeholder="当日のお問合せ先">
                                    </div>
                                </div>

                            </div>
                            <!-- 開催時間-->
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="row">
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            <label for="open_date">{{"開催日（".$i."日目）"}}</label>
                                            <div class='input-group date' id='open_date{{$i==1?"":$i}}'>
                                                <input type='text' class="form-control" name="open_date{{$i==1?"":$i}}"
                                                       value="{{$event["open_date".($i==1?"":$i)]}}" placeholder="2018-10-01" />
                                                <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-9">
                                            <div class="form-group" id="check-times-{{$i}}">
                                                <label for="open_date{{$i==1?"":$i}}">{{"開催時間（最大5件登録できます）"}}</label>
                                                <div>
                                                    @for ($j = 1; $j <= 5; $j++)
                                                        <div class="hour-minute-items">
                                                            <label>{{$j}}回目：</label>
                                                            <select class="form-control" name="opentime_day_hour_start_{{$i}}_{{$j}}" >
                                                                <option value="">時</option>
                                                                @for($h=0; $h<=24; $h++)
                                                                    <option value="{{$h}}"
                                                                            {{ $event[("opentime_day_hour_start_".$i."_".$j)]!="" && $event[("opentime_day_hour_start_".$i."_".$j)]==$h ? "selected" : ""}} >
                                                                        {{$h<10 ? "0".$h : $h}}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                            <select class="form-control" name="opentime_day_minute_start_{{$i}}_{{$j}}">
                                                                <option value="">分</option>
                                                                @for($m=0; $m<=30; $m+=30)
                                                                    <option value="{{$m}}"
                                                                            {{ $event[("opentime_day_minute_start_".$i."_".$j)]!="" && $event[("opentime_day_minute_start_".$i."_".$j)]==$m ? "selected" : ""}}>{{$m<10 ? "0".$m : $m}}</option>
                                                                @endfor
                                                            </select>
                                                            <label>〜</label>
                                                            <select class="form-control"  name="opentime_day_hour_end_{{$i}}_{{$j}}">
                                                                <option value="">時</option>
                                                                @for($h=0; $h<=24; $h++)
                                                                    <option value="{{$h}}"
                                                                            {{$event[("opentime_day_hour_end_".$i."_".$j)]!=""&& $event[("opentime_day_hour_end_".$i."_".$j)]==$h ? "selected" : ""}}>{{$h<10 ? "0".$h : $h}}</option>
                                                                @endfor
                                                            </select>
                                                            <select class="form-control" name="opentime_day_minute_end_{{$i}}_{{$j}}">
                                                                <option value="">分</option>
                                                                @for($m=0; $m<=30; $m+=30)
                                                                    <option value="{{$m}}"
                                                                            {{
                                                                            $event[("opentime_day_minute_end_".$i."_".$j)]!=""&&
                                                                            $event[("opentime_day_minute_end_".$i."_".$j)]==$m ? "selected" : ""}}>{{$m<10 ? "0".$m : $m}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    @endfor
                                                </div>
                                                <div>
                                                    <textarea placeholder="備考" class="form-control" name="comment_day_{{$i}}">{{$event[("comment_day_".$i)]}}</textarea>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            <br/>

                            @endfor

                            <!-- ./開催時間-->
                            <div class="row">
                                <div class="col-xs-12">
                                    <label>{{"画像アップロード"}}</label>
                                    <div id="form-upload" style="display: none">
                                        <div>
                                            <a id="upload" class="btn btn-success btn-sm" @click="upload()">
                                                {{"アップロード"}}
                                            </a>
                                        </div>
                                        <div class="flex-c">
                                            <div class="flex-c-i" v-for="(media, index) in medias"
                                                 v-bind:key="index" v-show="media.path">
                                                <div class="text-center photo-c">
                                                    <input accept=".jpg,.jpeg.,.png"
                                                           @change="changeFile(index, $event)"
                                                           type="file" v-bind:name="('upload_file_'+index)"
                                                           v-bind:id="('upload_file_'+index)"
                                                           style="visibility: hidden"/>
                                                    <video v-if="media.type=='video'" width="320" height="240" controls>
                                                        <source v-bind:src="media.path" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                    <img v-else class="media-image" v-bind:src="media.path"/>
                                                    <input v-if="media.remove" v-bind:value="media.id" type="hidden" v-bind:name="('delete_upload_file_'+index)">
                                                    <div class="upload-control">
                                                        <a @click="deleteFile(index)"
                                                           class="btn btn-sm btn-danger" title="削除する">
                                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file_count" v-bind:value="medias.length">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <br/>
                                    <label>マップ</label>
                                    <div class="form-inline" style="margin-bottom: 20px">
					<div class="small" style="padding-left:10px;">
						Googleマップの「共有リンク」を入力してください。
					</div>
                                    </div>
                                    <div>
                                        <a class="btn btn-sm btn-primary"
                                           href="https://www.google.com/maps/"
                                           title="住所情報を取得するボタン" target="_blank">
                                            {{"住所情報を取得する"}}
                                        </a>
                                        <div class="map-link-input">
                                            <label>Googleマップの「共有リンク」を入力</label>
                                            <input id="google_map_link" name="google_map_link"
                                                   value="{{$event->google_map_link}}"
                                                   class="form-control" placeholder="Googleマップの「共有リンク」を入力（https://goo.gl/maps/ZxTPPu4aAZ82　など）">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-inline" style="margin-bottom: 20px; display:none;">
                                        <div class="form-group">
                                            <label for="lat">Latitude</label>
                                            <input type="text" class="form-control"
                                                   id="lat" name="lat" placeholder="Latitude">
                                        </div>
                                        <div class="form-group">
                                            <label for="lat">Longitude</label>
                                            <input type="text" class="form-control"
                                                   id="long" name="long" placeholder="Longitude">
                                        </div>
                                    </div>
                                    <div id="map" style="display:none;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <br/>
                                    <div class="form-group">
                                        <label for="comment">{{"コメント"}}</label>
                                        <textarea rows="4" placeholder="コメント"
                                                  class="form-control" id="comment" name="comment">{{$event->comment}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <br>
                                <button class="btn btn-primary">{{"保存"}}</button>
                                @if ($event->id != 0)
                                    <a id="delete" href="{{route("adminEventDelete",["id"=>$event->id])}}" class="btn btn-danger" style="float: right" >削除</a>
                                @endif
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("footer")
<script src="{{asset("assets/moment.min.js")}}">
</script>
<script src="{{asset("assets/bootstrap-datetimepicker.js")}}">
</script>
<script src="{{asset("assets/vue.min.js")}}"></script>
{{--<script src="{{asset("assets/vue.js")}}"></script>--}}
<script>
    $(document).ready(function () {

        var app = new Vue({
            el: '#app',
            delimiters: ['[[', ']]'],
            data: {
                medias: []
            },
            computed: {
              sortedMedias: function () {
                  return this.medias.sort(function (a,b) {
                      return a.precedence < b.precedence;
                  });
              }
            },
            methods: {
                upload: function () {
                    var newMedia = {path: "", precedence: this.medias.length+1, remove: 0, id: 0};
                    this.medias.push(newMedia);
                    var self = this;
                    setTimeout(function () {
                        $("#upload_file_"+(self.medias.length-1)).trigger("click");
                    },500);
                },
                changeFile: function (index, input) {
                    if(input.target.files && input.target.files.length > 0){
                        var name = input.target.files[0].name;
                        if ( /\.(jpe?g|png|gif)$/i.test(name) === false ) {
                            // video
                            this.medias[index].path = "{{asset('images/video-placeholder.png')}}";

                        } else{
                            var reader = new FileReader();
                            var self = this;
                            reader.onload = function(e) {
                                self.medias[index].path = e.target.result;
                            };
                            reader.readAsDataURL(input.target.files[0]);
                        }
                    }
                },
                deleteFile: function (index) {
                    this.medias[index].path = null;
                    this.medias[index].remove = "1";
                }
            },
            mounted: function () {
                for(var i = 1; i <=5 ; i++){
                    var id = '#open_date' + (i==1 ? '' : i);
                    var val = $(id).find(">input").val();
                    if(val){
                        try{
                            $(id).datetimepicker({
                                format: 'YYYY-MM-DD',
                                minDate: moment(val).subtract(1, "days"),
                                maxDate: moment(val).add(60, 'days'),
                                useCurrent: false,
                                defaultDate: moment(val).format("YYYY-MM-DD")
                            });
                        }catch (er){
                            $(id).datetimepicker({
                                format: 'YYYY-MM-DD',
                                useCurrent: false
                            });
                        }

                    }else{
                        try{
                            $(id).datetimepicker({
                                format: 'YYYY-MM-DD',
                                minDate: moment().format("YYYY-MM-DD 00:00:00"),
                                maxDate: moment().add(365, 'days'),
                                useCurrent: false
                            });
                        }catch (err){
                            $(id).datetimepicker({
                                format: 'YYYY-MM-DD',
                                useCurrent: false
                            });
                        }
                    }
                }
                $("#form-upload").show();
                var self = this;
                $.ajax({
                    "url": "{{route("adminEventMedias",["id"=>$event->id])}}",
                }).done(function (res) {
                    if(res && res.length > 0){
                        for(var i = 0; i< res.length;i++){
                            res[i].path = "{{url('/')}}/upload/" + res[i].path;
                        }
                    }
                    self.medias = res;
                });
                $("#delete").click(function () {
                    var result = confirm("削除すますか?");
                    if (!result) {
                        return false;
                    }
                });
                // auto zip
                $('#btn-auto-zip').click(function(e) {
                    e.preventDefault();
                    AjaxZip3.zip2addr('zip01', 'zip02', 'province_id', 'position');
                });
                // change radio
                $("input[name='position_master']").change(function () {
                   if($(this).val()=="その他"){
                       $("#position_detail").show();
                   } else{
                       $("#position_detail").hide();
                   }
                });
                @if($event->position_master=="その他")
                    $("#position_detail").show();
                @endif

            }
        });

        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                if($(event.target).prop("tagName").toLocaleLowerCase()=="textarea"){
                    return true;
                }
                event.preventDefault();
                return false;
            }
        });
        // form validate
        $("#form-save").on("submit", function (e) {
           if($("#shop_name").val().length < 1){
               $("#shop_name-container").addClass("has-error");
               $('html, body').animate({
                   scrollTop: $("#shop_name-container").offset().top
               }, 1000);
               e.preventDefault();
               return false;
           }
//           $("#position_master_container_error").hide();
//           if($("input[name='position_master']:checked").length < 1){
//               $("#position_master_container_error").show();
//               $('html, body').animate({
//                   scrollTop: $("#position_master_container").offset().top
//               }, 1000);
//               e.preventDefault();
//               return false;
//           } else{
//           }

           var isHasDate = false;
           for(var _i = 1; _i <= 5; _i++){
               var selector = "open_date";
               if(_i!=1){
                   selector+=_i;
               }
               if($("input[name='"+selector+"']").val()){
                   var checkTimesSelector = "#check-times-"+_i;
                   for(var _j=1; _j <=5; _j++){
                       var $startHour = $(checkTimesSelector).find("select[name='opentime_day_hour_start_"+_i+"_"+_j+"']");
                       var $startMinute = $(checkTimesSelector).find("select[name='opentime_day_minute_start_"+_i+"_"+_j+"']");
                       if($startHour.val() && $startMinute.val()){
                           isHasDate = true;
                           break;
                       }
                   }
               }
           }
           if(!isHasDate){
               $("#open_date").addClass("has-error");
               $("select[name='opentime_day_hour_start_1_1']").css("border-color", "#a94442");
               $("select[name='opentime_day_minute_start_1_1']").css("border-color", "#a94442");
               $('html, body').animate({
                   scrollTop: $("#open_date").offset().top
               }, 1000);
               e.preventDefault();
               return false;
           }
           return true;
        });

    });
</script>
<style>
    .media-image{
        max-width: 100%;
        height: auto;
        margin: auto;
    }
    .upload-control{
        padding: 5px;
    }
    #map {
        height: 400px;
        width: 100%;
    }
    .photo-c{
        padding: 10px;
        border:1px solid #ccc;
        border-radius: 4px;
        padding-bottom: 40px;
        position: relative;
        height: 100%;
    }
    .upload-control{
        position: absolute;
        bottom:0;
        width: 100%;
        left: 0;
    }

</style>
@endsection