@extends('layouts.admin')

@section('title')
    {{"イベント作成"}}
@endsection

@section('header')
    <link href="{{ asset('assets/bootstrap-3/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
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
                        <form method="post" action="" class="" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="shop_name">{{"ショップ名"}}</label>
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
                                        <label for="position">{{"住所"}}</label>
                                        <input type="text" class="form-control" value="{{$event->position}}"
                                               id="position" name="position" placeholder="住所">
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
                                    <div class="form-group">
                                        <label for="phone">{{"電話番号"}}</label>
                                        <input type="text" class="form-control" value="{{$event->phone}}"
                                               id="phone" name="phone" placeholder="電話番号">
                                    </div>
                                </div>

                            </div>
                            <!-- 開催時間-->
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label for="open_date">{{"開催日付"}}</label>
                                        <div class='input-group date' id='open_date'>
                                            <input type='text' class="form-control" name="open_date" value="{{$event->open_date}}" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-9">
                                    <div class="form-group">
                                        <label for="open_date">{{"時間"}}</label>
                                        <div >
                                            <input placeholder="10:00～12:00, 13:00～14:00" type='text' name="open_date_time" class="form-control" value="{{$event->open_date_time}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label for="open_date2">{{"開催日付"}}</label>
                                        <div class='input-group date' id='open_date2'>
                                            <input type='text' class="form-control" name="open_date2" value="{{$event->open_date2}}" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-9">
                                    <div class="form-group">
                                        <label for="open_date2">{{"時間"}}</label>
                                        <div >
                                            <input placeholder="10:00～12:00, 13:00～14:00" type='text' name="open_date_time2" class="form-control" value="{{$event->open_date_time2}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label for="open_date3">{{"開催日付"}}</label>
                                        <div class='input-group date' id='open_date3'>
                                            <input type='text' class="form-control" name="open_date3" value="{{$event->open_date3}}" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-9">
                                    <div class="form-group">
                                        <label for="open_date3">{{"時間"}}</label>
                                        <div >
                                            <input placeholder="10:00～12:00, 13:00～14:00" type='text' name="open_date_time3" class="form-control" value="{{$event->open_date_time3}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label for="open_date4">{{"開催日付"}}</label>
                                        <div class='input-group date' id='open_date4'>
                                            <input type='text' class="form-control" name="open_date4" value="{{$event->open_date4}}" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-9">
                                    <div class="form-group">
                                        <label for="open_date4">{{"時間"}}</label>
                                        <div >
                                            <input placeholder="10:00～12:00, 13:00～14:00" type='text' name="open_date_time4" class="form-control" value="{{$event->open_date_time4}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label for="open_date5">{{"開催日付"}}</label>
                                        <div class='input-group date' id='open_date5'>
                                            <input type='text' class="form-control" name="open_date5" value="{{$event->open_date5}}" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-9">
                                    <div class="form-group">
                                        <label for="open_date5">{{"時間"}}</label>
                                        <div >
                                            <input placeholder="10:00～12:00, 13:00～14:00" type='text' name="open_date_time5" class="form-control" value="{{$event->open_date_time5}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ./開催時間-->
                            <div class="row">
                                <div class="col-xs-12">
                                    <label>{{"メディア"}}</label>
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
                                                    <input accept=".jpg,.jpeg.,.png,.mov,.mp4"
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
                                    <div>
                                        <a class="btn btn-sm btn-primary"
                                           href="https://www.google.com/maps/"
                                           title="住所情報を取得するボタン" target="_blank">
                                            {{"住所情報を取得する"}}
                                        </a>
                                        <div class="map-link-input">
                                            <label>Googleマップのリンク</label>
                                            <input id="google_map_link" name="google_map_link"
                                                   value="{{$event->google_map_link}}"
                                                   class="form-control" placeholder="Googleマップのリンク">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-inline" style="margin-bottom: 20px">
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
                                    <div id="map"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <br/>
                                    <div class="form-group">
                                        <label for="comment">{{"コメント"}}</label>
                                        <textarea rows="4" placeholder="コメント" class="form-control" id="comment" name="comment">{{$event->comment}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <br>
                                <button class="btn btn-primary">{{"保存"}}</button>
                                <a id="delete" href="{{route("adminEventDelete",["id"=>$event->id])}}" class="btn btn-danger" style="float: right" >削除</a>
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
{{--<script src="{{asset("assets/vue.min.js")}}"></script>--}}
<script src="{{asset("assets/vue.js")}}"></script>
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
                  return this.medias.sort((a, b) => a.precedence < b.precedence );
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
                                maxDate: moment().add(60, 'days'),
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
            }
        });

    });
</script>
<script>
    var marker = false;
    var center = {lat: "{{$event->lat ? $event->lat : 35.652832 }}", lng: "{{$event->long ? $event->long : 139.839478}}"};
    center.lat = Number(center.lat);
    center.lng = Number(center.lng);

    function getLatLongFromUrl(url) {
        try{
            var indexA = url.indexOf("@");
            var lon = 0;
            var lat = 0;
            if(indexA >-1){
                url = url.substr(indexA+1);
                var indexFirst = url.indexOf(",");
                if(indexFirst > -1){
                    lat = url.substr(0,indexFirst);
                    url = url.substr(indexFirst+1);
                    var index2 = url.indexOf(",");
                    if(index2 > -1){
                        lon = url.substr(0,index2);
                    }
                }

            }
            if(lat!=0 && lon!=0){
                var __res = {
                    lat: Number(lat),
                    lng: Number(lon)
                };
                return __res;
            }
            return null;

        }catch (err){
            return null;
        }
    }

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 11,scrollwheel: false
        });
        marker = new google.maps.Marker({
            position: center,
            map: map,
            draggable: true
        });
        markerLocation();
        google.maps.event.addListener(marker, 'dragend', function(event){
            markerLocation();
        });
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.setCenter(pos);
                marker.setPosition(pos);
                markerLocation();
            }, function() {
            });
        } else {
        }
        google.maps.event.addListener(map, 'click', function(event) {
            var clickedLocation = event.latLng;
            marker.setPosition(clickedLocation);
            markerLocation();
        });
        function markerLocation(){
            var currentLocation = marker.getPosition();
            $("#lat").val(currentLocation.lat());
            $("#long").val(currentLocation.lng());
        }
        
        function onChangeGooleMapLink(__url) {
            var latLong = getLatLongFromUrl(__url);
            if(latLong){
                map.setCenter(latLong);
                marker.setPosition(latLong);
                $("#lat").val(latLong.lat);
                $("#long").val(latLong.lng);
                //markerLocation();
            }
        }

        $("#google_map_link").change(function () {
            var _url = $(this).val();
            onChangeGooleMapLink(_url);
        });
        $("#google_map_link").keyup(function () {
            var _url = $(this).val();
            onChangeGooleMapLink(_url);

        });
        function changeLatLong() {
            // prevent enter input submit
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    if($(event.target).attr("id")){
                        var id = $(event.target).attr("id");
                        if(id=="lat" || id == "long"){
                            var _pos = {
                                lat: Number($("#lat").val()),
                                lng: Number($("#long").val())
                            };
                            map.setCenter(_pos);
                            marker.setPosition(_pos);
                            markerLocation();
                        }
                    }
                    return false;
                }
            });
        }
        changeLatLong();
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{Config::get('app.google_map_key')}}&callback=initMap">
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