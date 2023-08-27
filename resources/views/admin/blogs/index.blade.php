@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-primary mb-3" href="{{ route('blogs.create') }}">Add Blog</a>
                        <a class="btn btn-danger mb-3" href="{{ route('blogs.trashedIndex') }}">Trashed</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-center text-uppercase">
                        <h3>All Blogs</h3>
                    </div>
                    <div class="card-body">
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
                                                href="{{ route('blogs.edit', $item->id) }}">EDIT</a>
                                            <a class="btn btn-sm btn-warning" href="{{ route('blogs.trash', $item->id) }}"
                                                onclick="event.preventDefault(); document.getElementById('trash-form-{{ $item->id }}').submit();">
                                                TRASH
                                            </a>

                                            <form id="trash-form-{{ $item->id }}"
                                                action="{{ route('blogs.trash', $item->id) }}" method="POST"
                                                class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a class="btn btn-sm btn-danger btndelete"
                                                href="{{ route('blogs.trash', $item->id) }}"
                                                onclick="event.preventDefault(); showDeleteConfirmation('{{ $item->id }}')">
                                                DELETE
                                            </a>

                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('blogs.delete', $item->id) }}" method="POST"
                                                class="d-none">
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
    </div>

    <script>
        $(document).ready(function() {
            $('#data-table').DataTable();
        });

        function showDeleteConfirmation(itemId) {
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
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ).then(() => {
                        document.getElementById('delete-form-' + itemId).submit();
                    });
                }
            });
        }
    </script>
@endsection
