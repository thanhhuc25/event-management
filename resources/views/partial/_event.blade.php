<div class="item-x" id="event-{{$event->id}}">
    <h2 class="a-ttl_h2 a-ttl_border a-ttl_border_bg a-ttl_main h2-no-mr-bottom" >
        {{$event->shop_name}}
        <div class="a-ttl_txt">
            {{$event->category ? $event->category->name :""}}
        </div>
        <div class="a-ttl_txt">
            開催日時：
            <span>
                    {{$event->displayOpenDate()}}
                @if($event->endTime())
                    〜 {{$event->endTime()}}
                @endif
                </span>
        </div>
        <div class="a-ttl_txt">
            住　　所：
            <span>
                  {{$event->position}}
                </span>
        </div>
        <div class="a-ttl_txt">
            電話番号：
            <span>
                  {{$event->phone}}
                </span>
        </div>
        <div class="a-ttl_txt">
            {{$event->comment}}
        </div>
    </h2>
    <div class="f-section f-section--home">
        <ul class="m-list_box f-flex f-flex_mb30">
            @foreach($event->medias as $media)
                <li class="f-flex3 f-flex12_s">
                    @if($media->type=="video")
                        <video width="200" height="auto" controls>
                            <source src="{{url("/")."/upload/".$media->path}}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <img class="" src="{{url("/")."/upload/".$media->path}}">
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <div class="f-section">
        <ul class="m-list_box f-flex f-flex_mb30 no-print-btn">
            <li class="f-flex6">
                <div class="bg-white">
                    <a target="_blank" class="a-btn a-btn_arrow a-btn_sub"
                       href="https://www.google.com/maps?q={{$event->lat}},{{$event->long}}">
                        Googleマップ
                    </a>
                </div>
            </li>
            <li class="f-flex6">
                <div class="bg-white" style="text-align: right;">
                    <button class="a-btn a-btn_arrow a-btn_main btn-print"
                            data-lat="{{$event->lat}}"
                            data-long="{{$event->long}}"
                            data-print="event-{{$event->id}}">
                        {{"印刷する"}}
                    </button>
                </div>
            </li>
        </ul>
    </div>


</div>
