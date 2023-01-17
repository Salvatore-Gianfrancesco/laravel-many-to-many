@extends('layouts.admin')

@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Technologies</h1>

            <div>
                <form action="{{ Route('admin.technologies.store') }}" method="post">
                    @csrf

                    <div class="d-flex align-items-center gap-2">
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            placeholder="Add new Technology...">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </form>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ session('message') }}</strong>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($technologies as $technology)
                        <tr>
                            <td scope="row">{{ $technology->id }}</td>
                            <td>{{ $technology->name }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <form action="{{ Route('admin.technologies.update', $technology->id) }}" method="post">
                                        @csrf
                                        @method('put')

                                        <div class="mb-3 d-flex align-items-center gap-2">
                                            <input type="text" name="name" id="name" class="form-control h-2-5"
                                                value="{{ old('name') }}" placeholder="Type new name...">
                                            <button type="submit" class="btn btn-secondary text-nowrap h-2-5">Edit
                                                name</button>
                                        </div>
                                    </form>

                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger h-2-5" data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $technology->id }}">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modalId-{{ $technology->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId-{{ $technology->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId-{{ $technology->id }}">
                                                        Delete Technology?
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this technology? The action is
                                                    irreversible!
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>

                                                    <form
                                                        action="{{ Route('admin.technologies.destroy', $technology->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td scope="row">Nothing to show</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
