<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{"イベント情報"}}</title>
    <link href="{{asset("css/bootstrap-grid.min.css")}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="{{asset("css/index.css")}}" rel="stylesheet">
</head>
<body>
<noscript>
    <div style="text-align: center">JavaScriptを有効にしてください</div>
</noscript>
<div class="no-print">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="center h1">
                    イベント情報
                </h1>
                <div class="row">
                    <div class="col-xs-12 col-md-3 col-md-offset-3">
                        <div class="">
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

                    </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="">
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

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                        <div class="cat">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <div class="res" id="res">
                            @foreach($events as $event)
                                @include('partial._event', [
                                      'event'=>$event
                                ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--modal-->
    <div id="myModal" class="modal-s">
        <!-- Modal content -->
        <div class="modal-s-content">
            <span class="close-s">&times;</span>
            <div id="print-content">
                <div class="container" style="width: 100%; padding-bottom: 10px">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="print-me">
    <div class="container" >

    </div>
    <div class="center">
        <img style="width: 80%; margin: auto" id="map-img"
             src="">
    </div>
</div>

<script src="{{asset("js/jquery.min.js")}}"></script>
<script>
    $(document).ready(function () {
        var provinces = [<?php echo json_encode($provinces) ?>][0];
        function doSearch() {
            var _cat = $("#category").val(),
                _province = $("#provinces").val(),
                _area = $("#area").val();
            $.ajax({
                url: "{{route('search')}}?category="+_cat + "&province="+_province+"&area="+_area
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
            var _urlMap = "https://maps.googleapis.com/maps/api/staticmap?zoom=16&size=500x300&key={{Config::get('app.google_map_key')}}";
            _urlMap+="&center="+_pos.lat+","+_pos.lng;
            _urlMap+="&markers=olor:red%7Clabel:G%7C"+_pos.lat+","+_pos.lng+"";
            $("#map-img").attr("src",_urlMap);
            setTimeout(function () {
                window.print();
            },1500);

        });

    });
</script>
</body>
</html>