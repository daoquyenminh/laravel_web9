@extends('layout.master')
@push('css')
    <link href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sb-1.4.2/sl-1.6.2/datatables.min.css" rel="stylesheet"/>
@endpush

@section('content')

    <div class="card">
        <div class="card-header">
            Khoá học
        </div>
        <div class="card-body">

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
        </div>
    </div>

@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sb-1.4.2/sl-1.6.2/datatables.min.js"></script>
    <script>
        $(function () {
            var urlData = '{!! route('courses.api')!!}';
            $('#table-index').DataTable({
                dom:'Blfrtip',
                processing: true,
                serverSide: true,
                ajax: urlData,
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                    {
                        data: 'edit',
                        name: 'edit',
                        target: 3,
                        searchable:false,
                        orderable:false,
                        render: function (data, type, row, meta){
                            return `<a class="btn btn-primary" href="${data}" >Sửa</a>`
                        }
                    }
                ]
            });
        });
    </script>
@endpush

