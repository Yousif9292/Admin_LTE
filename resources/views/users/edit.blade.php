@extends('layouts.app');
@section('content')

{{$errors}}
    <form method="POST" style="border: 1px solid black" action="{{route('users.update', $users->id)}}">
        @method('PUT')
        @csrf
            <h3 style="text-align: center"><b>User Record</b></h3>
            <div >
                <label for="name">Name:</label><br/>
                <input type="text" class="block mt-1 w-full" name="name" value={{$users->name}}><br/>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value={{$users->email}}><br/>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Role:</strong>
                    <select name="roles[]" class="form-control">
                        @foreach($roles as $roleId => $roleName)
                            <option value="{{ $roleId }}">{{ $roleName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        <button type="submit" style="background-color: blue; margin-left:485px " class="btn btn-primary"  >Update</button>
    </form>


@endsection
