@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-danger mb-3" href="{{ route('blogs.trashedIndex') }}">Trashed</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-center text-uppercase">
                        <h3>All Blogs</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <label for="name" class="control-label m-auto p-auto">TITLE:</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="TITLE" value="{{ $blog->title }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">UPDATE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
