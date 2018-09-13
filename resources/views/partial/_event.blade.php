<div class="item" id="event-{{$event->id}}">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2 >
                <span class="border-b">
                    {{$event->shop_name}}
                </span>
            </h2>
            <h4>
                <span class="border-b eq-w">
                    開催日時
                </span>
                <span class="item-ct">
                    {{$event->displayOpenDate()}}
                    @if($event->endTime())
                    〜 {{$event->endTime()}}
                    @endif
                </span>
            </h4>
            <h4>
                                                 <span class="border-b eq-w">
                                                    住　　所
                                                </span>
                <span class="item-ct">
                                                   {{$event->position}}
                                                </span>
            </h4>
            <h4>
                                                 <span class="border-b eq-w">
                                                    電話番号
                                                </span>
                <span class="item-ct">
                                                   {{$event->phone}}
                                                </span>
            </h4>
            <h4>
                                                 <span class="border-b eq-w">
                                                    コメント
                                                </span>
                <span class="item-ct">
                                                   {{$event->comment}}
                                                </span>

            </h4>

        </div>
        <div class="col-xs-12 col-md-6">
            <h3>
                {{$event->category ? $event->category->name :""}}
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="images">
            @foreach($event->medias as $media)
            <a href="javascript:void(0)">
                @if($media->type=="video")
                <video width="200" height="auto" controls>
                    <source src="{{url("/")."/upload/".$media->path}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                @else
                <img class="img" src="{{url("/")."/upload/".$media->path}}">
                @endif
            </a>
            @endforeach
        </div>
    </div>
    <div class="row no-print-btn">
        <br/>
        <div class="col-xs-6 col-md-6">
            <div style="padding-left: 8px">
                <a target="_blank" class="btn-map"
                   href="https://www.google.com/maps?q={{$event->lat}},{{$event->long}}">
                    Googleマップ
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-md-6">
            <div style="text-align: right;">
                <button class="btn-print"
                        data-lat="{{$event->lat}}"
                        data-long="{{$event->long}}"
                        data-print="event-{{$event->id}}">
                    {{"印刷する"}}
                </button>
            </div>
        </div>
    </div>
</div>