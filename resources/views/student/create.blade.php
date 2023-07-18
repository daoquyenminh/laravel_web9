
@extends('layout.master')
@section('content')


{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}



<form class="" action="{{route('students.store')}}" method="POST">
    <div class="form-group mx-sm-3 mb-2">
        @csrf
        <input type="text" name="name" class="form-control"  id="name" placeholder="Name" value="{{ old('name') }}">
    </div>
    Gioi tinh
    <input type="radio" name="gender" value="0" checked> Nam
    <input type="radio" name="gender" value="1"> Nu
    <br>
    birthdate
    <input type="date" name="birthdate" >
    <br>
    Status
    @foreach($arrStudentStatus as $option => $value)
        <input type="radio" name="status" value="{{ $value }}"
            @if($loop->first)
                checked
            @endif >
            {{ $option }}
            <br>
    @endforeach
    <br>
    Course
    <select name="course_id">
        @foreach($courses as $course)
            <option value="{{$course->id}}">
                {{ $course->name }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary mb-2">Thêm</button>
</form>
@endsection
