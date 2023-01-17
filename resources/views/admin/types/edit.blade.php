@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4">Editing Type: {{$type->name}}</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{Route('admin.types.update', $type->id)}}" method="post">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $type->name)}}" placeholder="Type name...">
        </div>

        <button type="submit" class="btn btn-primary">Conferma</button>
    </form>
</div>
@endsection