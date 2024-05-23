@extends('layouts.admin')

@section('content')
    <div class="container py-5 text-center text-center">
        <div class="col">
            @if (Str::startsWith($project->cover_image, 'https://'))
                <img src="{{ $project->cover_image }}" alt="" class="img-fluid ">
            @else
                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="" class="img-fluid ">
            @endif
        </div>
        <div class="col text-center">
            <h2 class="mb-3">{{ $project->name }}</h2>
            <a href="{{ $project->link }}" class="btn btn-dark btn-sm mb-3">🌍Site</a>
            <a href="{{ $project->link_code }}" class="btn btn-dark btn-sm mb-3">Code</a>
            <div class="mb-3">
                Project Date : <strong>{{ $project->project_date }}</strong>
            </div>
        </div>
    </div>

    <section>
        <div class="container text-center">
            <h2>Actions</h2>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-warning ">⬅ Go Back</a>
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning ">🖊Edit</a>
        </div>
    </section>
@endsection
