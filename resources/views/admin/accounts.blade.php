@extends('layouts.admin')
@section("header")
    <link rel="stylesheet" href="{{asset("assets/jquery.dataTables.min.css")}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2>
                    {{"アカウントリスト"}}
                </h2>
                <table class="table table-bordered" id="events-table">
                    <thead>
                    <tr>
                        <th class="text-center">
                            #
                        </th>
                        <th>
                            {{"ユーザー名"}}
                        </th>
                        <th>
                            {{"役割"}}
                        </th>
                        <th></th>
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
                    url: '{{ route('datatable-user/getdata') }}',
                    method: 'POST'
                },
                columns: [
                    {data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false, searchable: false},
                    {data: 'username', name: 'username'},
                    {data: 'role', name: 'role'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "language": {
                    "url": "{{asset('assets/Japanese.json')}}"
                }
            });
        });
    </script>
@endsection