
@extends('layout.master')
@section('content')


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{--<form class="" action="{{route('courses.store')}}" method="POST">--}}
{{--    Name--}}
{{--    @csrf--}}
{{--    <input type="text" name="name" value="{{ old('name') }}">--}}
{{--    @if($errors->has('name'))--}}
{{--        <span class="error">--}}
{{--            {{$errors->first('name') }}--}}
{{--        </span>--}}
{{--    @endif--}}
{{--    <br>--}}
{{--    <button>--}}
{{--        Thêm--}}
{{--    </button>--}}
{{--</form>--}}


<form class="form-inline" action="{{route('courses.store')}}" method="POST">
    <div class="form-group mx-sm-3 mb-2">
        @csrf
        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
        @if($errors->has('name'))
            <span class="error">
            {{$errors->first('name') }}
        </span>
        @endif
    </div>
    <button type="submit" class="btn btn-primary mb-2">Thêm</button>
</form>
@endsection
