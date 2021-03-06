@extends('layouts.admin')

@section('title')
    {{"イベントリスト"}}
@endsection
@section("header")
    <link rel="stylesheet" href="{{asset("assets/jquery.dataTables.min.css")}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2>
                    {{"イベントリスト"}}
                </h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered" id="events-table">
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
                            {{"開催場所"}}
                        </th>
                        <th>
                            {{"連絡先"}}
                        </th>
                        <th>
                            {{"都道府県"}}
                        </th>
                        <th>

                        </th>
                        @if(Auth::user()->is_admin==1)
                            <th>

                            </th>
                        @endif
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section("footer")
    <script src="{{asset("assets/jquery.dataTables.min.js")}}"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#events-table').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ route('datatable/getdata') }}',
                    method: 'POST'
                },
                columns: [
                    {data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false, searchable: false},
                    {data: 'shop_name', name: 'shop_name'},
                    {data: 'category', name: 'category'},
                    {data: 'open_date', name: 'open_date'},
                    {data: 'position', name: 'position'},
                    {data: 'phone', name: 'phone'},
                    {data: 'province', name: 'province'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    @if(Auth::user()->is_admin==1)
                    {data: 'creator', name: 'creator', orderable: false, searchable: false},
                    @endif
                ],
                "order": [[ 3, 'desc' ]],
                "language": {
                    "url": "{{asset('assets/Japanese.json')}}"
                }
            });
        });
    </script>
    <style>
        #events-table > tbody > tr > td:nth-child(4){
            text-align: left;
        }
    </style>
@endsection