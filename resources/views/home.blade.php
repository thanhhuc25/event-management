<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>イベント情報</title>

    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- OGP -->
    <meta property="og:locale" content="ja_JP">
    <meta property="og:title" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:site_name" content="">
    <meta property="og:description" content="">

    <!-- Can not edit for framework. -->
    <link href="{{asset("css/common/css/fw.css")}}" rel="stylesheet">

    <!-- Can not edit for module. -->
    <link href="{{asset("css/common/css/module.css")}}" rel="stylesheet">

    <!-- Please set appropriate font for each country. -->
    <link href="{{asset("css/common/css/font.css")}}" rel="stylesheet">

    <!-- Please create a css file for each page. -->
    <!-- <link href="/common/css/page/***.css" rel="stylesheet"> -->

    <link href="{{asset("css/index.css")}}" rel="stylesheet">


</head>

<body class="fw">


<header id="header" >
    <div class="header-bar">

        <a title="ホームページ" href="https://www.hikoki-powertools.jp" class="header-logo"><img src="{{asset("css/common/images/common/logo/logo.png")}}" alt="HIKOKI"></a>

    </div>

</header>
<!-- /#header -->

<div id="container" class="no-print">

    <div class="f-inner">
	<section class="f-section_m">
	    <div class="f-flex12 f-flex12_s">
	        <div class="a-txt_center">
	            <img src="css/common/images/banner.jpg" alt="HiKOKIイベント情報" width="100%">
	        </div>
	    </div>
	</section>
	<main id="contents" class="f-max">
            <div class="f-section f-section--home">
                <ul class="m-list_box f-flex f-flex_mb30">
                    <li class="f-flex6 f-flex12_s">
                        <div class="bg-white a-txt_center">
                            <label>
                                {{"エリア"}}
                            </label>
                            <select class="sl" id="area">
                                <option value="">選択してください</option>
                                @foreach($areas as $area)
                                    <option value="{{$area->id}}">
                                        {{$area->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <li class="f-flex6 f-flex12_s">
                        <div class="bg-white a-txt_center">
                            <label>
                                {{"都道府県"}}
                            </label>
                            <select class="sl" id="provinces">
                                <option value="">選択してください</option>
                                @foreach($provinces as $province)
                                    <option value="{{$province->id}}">
                                        {{$province->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <input type="hidden" id="category" class="sl" value="">
<!--
                    <li class="f-flex4 f-flex12_s">
                        <div class="bg-white">
                            <label>
                                {{"カテゴリー"}}
                            </label>
                            <select id="category" class="sl">
                                <option value="">選択してください</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </li>
-->
                </ul>
            </div>
            <div class="res" id="res">
                @foreach($events as $event)
                    @include('partial._event', [
                          'event'=>$event
                    ])
                @endforeach
            </div>

        </main>
        <!-- /#contents -->

    </div>

</div>
<!--print-->
<div class="print-me" >
    <div class="container" >

    </div>
    <div class="center print-pd-right">
        <img style="width: 100%; max-width: 100%; margin: auto" id="map-img"
             src="">
    </div>
</div>

<!-- /#container -->
<footer id="footer" class="no-print">
    <div class="footer-bottom footer-section">
        <div class="f-inner">
            <p class="footer-copyright">&copy; Koki Holdings Co., Ltd. All rights reserved.</p>
        </div>
    </div>
    <!-- /.footer-bottom -->
</footer>
<!-- /footer -->

<!-- Can not edit for module. -->
{{--<script src="./common/js/main.js"></script>--}}

<!-- Please create a javascript file for each page. -->
<!-- <script src="/common/js/***.js"></script> -->

<script src="{{asset("js/jquery.min.js")}}"></script>
<script>
    $(document).ready(function () {
        var provinces = [<?php echo json_encode($provinces) ?>][0];
        function doSearch() {
            var _cat = $("#category").val(),
                _province = $("#provinces").val(),
                _area = $("#area").val();
            $.ajax({
                type: "POST",
                url: "{{route('search')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { category: _cat, province: _province, area: _area}
            }).done(function (data) {
                var $_html = $(data);
                $("#res").html($_html.find("#res").html());
            });
        }
        $("#area").change(function () {
            var areaId = $(this).val();
            if(areaId){
                $("#provinces").html("<option value=''>選択してください</option>");
                for(var _i = 0, _l = provinces.length; _i < _l; _i++){
                    if(provinces[_i].area_id==areaId){
                        $("#provinces").append("<option value='"+provinces[_i].id+"'>"+provinces[_i].name+"</option>");
                    }
                }
            }
            doSearch();
        });
        $("#category, #provinces").change(function () {
            doSearch();
        });
        // click print
        $(document).on("click", ".btn-print", function () {
            var _id = $(this).data("print");
            var $pp = $(".print-me > .container");
            $pp.html($("#"+_id).html());
            $pp.find(".no-print-btn").remove();
            var _pos = {
                lat: parseFloat($(this).data("lat")),
                lng: parseFloat($(this).data("long"))
            };

            var result_lat = $.isNumeric(_pos.lat);
            var result_lng = $.isNumeric(_pos.lng);
            var _urlMap = "https://maps.googleapis.com/maps/api/staticmap?zoom=16&size=500x300&key={{Config::get('app.google_map_key')}}";

            //短縮URLが存在するかチェック
            var short = $(this).data("short");
            if(short.length>0 && $(this).data("maplink")){
                //ajaxで短縮URLから緯度経度取得
                $.ajax({
                    type: "GET",
                    async : false,
                    url: "/?map_url="+short,
                    dataType: "json",
                    success: function(data, dataType){
                        //data.latとdata.lngに値があるか、数値かチェック
                        _urlMap+="&center="+data.lat+","+data.lng;
                        _urlMap+="&markers=olor:red%7Clabel:G%7C"+data.lat+","+data.lng+"";
                    }
                });
            }else{
                //DBのlatlngから地図生成
                if(result_lat == true && result_lng == true ){
                    _urlMap+="&center="+_pos.lat+","+_pos.lng;
                    _urlMap+="&markers=olor:red%7Clabel:G%7C"+_pos.lat+","+_pos.lng+"";

                }else{
                    //地図の情報取得不可

                }
            }


/*
            if(result_lat == true && result_lng == true ){
                _urlMap+="&center="+_pos.lat+","+_pos.lng;
                _urlMap+="&markers=olor:red%7Clabel:G%7C"+_pos.lat+","+_pos.lng+"";

            }else{
                var short = $(this).data("short");
                $.ajax({
                    type: "GET",
                    async : false,
                    url: "/?map_url="+short,
                    dataType: "json",
                    success: function(data, dataType){
                        _urlMap+="&center="+data.lat+","+data.lng;
                        _urlMap+="&markers=olor:red%7Clabel:G%7C"+data.lat+","+data.lng+"";
                    }
                });
            }
*/

            $("#map-img").attr("src",_urlMap);
            if($(this).data("maplink")){
                $("#map-img").show();
            }else{
                $("#map-img").hide();
            }
            setTimeout(function () {
                window.print();
            },1500);

        });


    });
</script>
</body>

</html>
