@extends('layouts.admin')

@section('content')
    <div class="container">
        {{--<div class="row">--}}
            {{--<div class="col-xs-12 col-md-3">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-body-2 p-3 text-center">--}}
                        {{--<div class="text-right text-green">--}}
                        {{--</div>--}}
                        {{--<div class="h1 m-0">{{$count}}</div>--}}
                        {{--<div class="text-muted mb-4">{{"総イベント"}}</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="card">--}}
                    {{--<div class="card-body-2 p-3 text-center">--}}
                        {{--<div class="text-right text-green">--}}
                        {{--</div>--}}
                        {{--<div class="h1 m-0">{{$count}}</div>--}}
                        {{--<div class="text-muted mb-4">{{"総イベント"}}</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-xs-12 col-md-3"></div>--}}
            {{--<div class="col-xs-12 col-md-3"></div>--}}
        {{--</div>--}}
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered">
                    <caption>
                        {{"最近イベント"}}
                    </caption>
                    <thead>
                    <tr>
                        <th class="text-center">
                            #
                        </th>
                        <th>
                            {{"ショップ名"}}
                        </th>
                        <th>
                            {{"カテゴリー"}}
                        </th>
                        <th>
                            {{"開催日時"}}
                        </th>
                        <th>
                            {{"住所"}}
                        </th>
                        <th>
                            {{"電話番号"}}
                        </th>
                        <th>
                            {{"都道府県"}}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recentEvents as $event)
                        <tr>
                            <td class="text-center">
                                <a href="{{route("adminEventEdit", ["id"=>$event->id])}}" title="詳細">
                                    {{$loop->iteration}}
                                </a>
                            </td>
                            <td>
                                {{$event->shop_name}}
                            </td>
                            <td>
                                @if($event->category)
                                    {{$event->category->name}}
                                @endif
                            </td>
                            <td>
                                {{$event->displayOpenDate()}}
                            </td>
                            <td>
                                {{$event->position}}
                            </td>
                            <td>
                                {{$event->phone}}
                            </td>
                            <td>
                                {{$event->province ? $event->province->name : ""}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2" class="td-total text-left">
                            総イベント：<b>{{$count}}</b>
                        </td>
                        <td colspan="5" class="text-right" style="border-left: 0px">
                            @if(count($recentEvents)<1)
                                {{"イベントなし"}}
                            @else
                                <a href="{{route("adminEventList")}}" title="すべてのイベント" class="btn btn-sm btn-primary">
                                    {{"すべてのイベント"}}
                                </a>
                            @endif
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection