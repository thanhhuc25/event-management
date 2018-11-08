<div class="item-x" id="event-{{$event->id}}">
    <h2 class="a-ttl_h2 a-ttl_border a-ttl_border_bg a-ttl_main h2-no-mr-bottom" >
        {{$event->shop_name}}
<!--
        <div class="a-ttl_txt">
            {{$event->category ? $event->category->name :""}}
        </div>
-->
        <div class="a-ttl_txt flex-times">
            <div>開催日時：</div>
            <div>
                    {!! $event->displayOpenDates() !!}

            </div>
        </div>
        <div class="a-ttl_txt flex-times">
            <div>開催場所：</div>

            <div>
                @if ($event->position_master!="その他")
                    <div>{{$event->position_master}}</div>
                @endif
                  {{$event->province ? $event->province->name : ""}}{{$event->position}}
            </div>
        </div>
        <div class="a-ttl_txt">
            連絡先&nbsp;&nbsp;&nbsp;&nbsp;：
            <span>
                  {{$event->phone}}
                </span>
        </div>
        <div class="a-ttl_txt">
            当日のお問合せ：
                <span>
                  {{$event->phone2}}
                </span>
        </div>
        <div class="a-ttl_txt">
            {!! nl2br( $event->comment) !!}
        </div>
    </h2>
    @if($event->medias)
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
    @endif
    <div class="f-section_s">
        <ul class="m-list_box f-flex f-flex_mb30 no-print-btn">
            <li class="f-flex6 bg-white no-bg">
                @if($event->google_map_link)
                <div class="bg-white no-bg">
                    <a target="_blank" class="a-btn a-btn_arrow a-btn_sub"
                       href="{{$event->google_map_link}}">
                        Googleマップ
                    </a>
                </div>
                @endif
            </li>
            <li class="f-flex6 f-display_m">
                <div class="bg-white f-display_m" style="text-align: right;">
                    <a class="a-btn a-btn_arrow a-btn_main btn-print"
                            data-short="{{$event->google_map_link ? $event->google_map_link : 'https://www.google.com/maps?q='.$event->lat.','.$event->long}}"
                            data-lat="{{$event->lat}}"
                            data-long="{{$event->long}}"
                            data-maplink="{{$event->google_map_link ? $event->google_map_link : ""}}"
                            data-print="event-{{$event->id}}">
                        {{"印刷する"}}
                    </a>
                </div>
            </li>
        </ul>
    </div>


</div>
