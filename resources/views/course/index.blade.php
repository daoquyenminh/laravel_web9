@extends('layout.master')
@push('css')
    <link href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sb-1.4.2/sl-1.6.2/datatables.min.css" rel="stylesheet"/>
@endpush

@section('content')

    <a  href="{{route('courses.create')}}">
        <button class="btn btn-success">Thêm dữ liệu</button>
    </a>
    <table border="1" width="100%" class="table table-striped table-bordered" name="table-index" id="table-index" >
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Created at</th>
            <th>Sửa</th>
            <th>Delete</th>
        </tr>
        </thead>
    </table>

@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sb-1.4.2/sl-1.6.2/datatables.min.js"></script>
    <script>
        $(function () {
            $(document).on('click','.btn-delete', function (){
                let form = $(this).parents('form')
                $.ajax({
                    url : form.attr('action'),
                    type: 'post',
                    dataType: 'json',
                    data: from.serialize(),
                })
                .done(function() {
                    console.log("success");
                })
                .fail(function() {
                    console.log("error");
                });

            })

            var buttonCommon = {
                exportOptions: {
                    format: {
                        columns: ':visible :not(.not-export)'
                    }
                }
            };

            $('#table-index').DataTable({
                dom:'Blfrtip',
                select:'false',
                buttons: [
                    $.extend( true, {}, buttonCommon, {
                        extend: 'copyHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'csvHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'excelHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'pdfHtml5'
                    } ),$.extend( true, {}, buttonCommon, {
                        extend: 'print'
                    } ),
                    'colvis'
                ],
                processing: true,
                serverSide: true,
                ajax: '{!! route('courses.api')!!}',
                columnDefs: [
                    {className : "not-export","target":[ 3 ]}
                ],
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                    {
                        data: 'edit',
                        target: 3,
                        searchable:false,
                        orderable:false,
                        render: function (data, type, row, meta){
                            return `<a class="btn btn-primary" href="${data}" >Sửa</a>`;
                        }
                    },
                    {
                        data: 'destroy',
                        target: 4,
                        searchable:false,
                        orderable:false,
                        render: function (data, type, row, meta){
                            return `<form action="${data}" method="post">
                                    @csrf
                                    @method('DELETE')
                                        <button class="btn-delete btn btn-danger">Delete</button>
                                    </form>` ;
                        },
                    },
                ]
            });
        });
    </script>
@endpush

