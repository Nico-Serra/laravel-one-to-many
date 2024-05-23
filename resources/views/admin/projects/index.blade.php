@extends('layouts.admin')


@section('content')
    <section class="bg-light py-3">
        <div class="container d-flex align-items-center justify-content-between py-3">
            <h1>Projects</h1>

            <a href="{{ route('admin.projects.create') }}" class="btn btn-secondary  ">Add Project</a>
        </div>



        <div class="container">
            @include('partials.message')

            <div class="table-responsive">
                <table class="table table-secondary">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Cover Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Site</th>
                            <th scope="col">Code</th>
                            <th scope="col">Project Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                            <tr class="">
                                <td scope="row">{{ $project->id }}</td>
                                @if (Str::startsWith($project->cover_image, 'https://'))
                                    <td><img src="{{ $project->cover_image }}" alt="" width="150"></td>
                                @else
                                    <td><img src="{{ asset('storage/' . $project->cover_image) }}" alt=""
                                            width="150"></td>
                                @endif
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->slug }}</td>
                                <td><a href="{{ $project->link }}" class="btn btn-dark btn-sm ">🌍 Site</a></td>
                                <td><a href="{{ $project->link_code }}" class="btn btn-dark btn-sm ">Code</a></td>
                                <td>{{ $project->project_date }}</td>
                                <td>
                                    <a href="{{ route('admin.projects.show', $project) }}"
                                        class="btn btn-dark btn-sm">👁‍🗨View</a>
                                    <a href="{{ route('admin.projects.edit', $project) }}"
                                        class="btn btn-dark btn-sm">🖊Edit</a>
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $project->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId-{{ $project->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId-{{ $project->id }}">
                                                        You want to delete this project
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">{{ $project->name }}</div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <form action="{{ route('admin.projects.destroy', $project) }}"
                                                        method="post">
                                                        @csrf

                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger">
                                                            Delete
                                                        </button>


                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Optional: Place to the bottom of scripts -->
                                    <script>
                                        const myModal = new bootstrap.Modal(
                                            document.getElementById("modalId-{{ $project->id }}"),
                                            options,
                                        );
                                    </script>


                                </td>
                            </tr>
                        @empty

                            <tr class="">
                                <td scope="row" colspan="8">Nothing Found</td>

                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            {{ $projects->links('pagination::bootstrap-5') }}
        </div>


    </section>
@endsection
