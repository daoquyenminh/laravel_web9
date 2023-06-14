<form action="{{route('courses.update',$each)}}" method="POST">
    Name
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{$each->name}}">
    @if($errors->has('name'))
        <span class="error">
            {{$errors->first('name') }}
        </span>
    @endif
    <br>
    <button>
        Update
    </button>
</form>
