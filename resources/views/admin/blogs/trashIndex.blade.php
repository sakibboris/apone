@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary mb-3" href="{{ route('blogs.index') }}">ALL Blogs</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-center text-uppercase">
                        <h3>All Trashed Blogs</h3>
                    </div>

                    <table id="data-table" class="display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Posted By</th>
                                <th>Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->postedByUser->name }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('blogs.recover', $item->id) }}">Recover</a>
                                        <a class="btn btn-sm btn-danger btndelete"
                                            href="{{ route('blogs.delete', $item->id) }}"
                                            onclick="event.preventDefault(); showDeleteConfirmation();">
                                            DELETE
                                        </a>

                                        <form id="delete-form" action="{{ route('blogs.delete', $item->id) }}"
                                            method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#data-table').DataTable();
        });
        $(document).on('click', '.btndelete', function(event) {
            event.preventDefault();
            showDeleteConfirmation();
        });

        function showDeleteConfirmation() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('.btn').disabled = true;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ).then(() => {
                        document.querySelector('.btn').disabled = false;
                        document.getElementById('delete-form').submit();
                    });
                }
            });
        }
    </script>
@endsection