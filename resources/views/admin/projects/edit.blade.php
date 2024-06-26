@extends('layouts.admin')

@section('content')
    <h2 class="my-3">Edit Project</h2>

    <form class="mb-3" action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Project Name</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="name"
                value="{{ old('name', $project->name) }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="exampleInput" class="form-label">Client Name</label>
            <input type="text" class="form-control" id="exampleInput" name="client_name"
                value="{{ old('client_name', $project->client_name) }}">
            @error('client_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                <input class="form-control" type="file" id="formFile" name="cover_image">
                @if ($project->cover_image)
                    <div class="w-25 my-3">
                        <img class="w-100" src="{{ asset('storage/' . $project->cover_image) }}"
                            alt="{{ $project->name }}">
                    </div>
                @else
                    <small>No image uploaded.</small>
                @endif
            </div>

            <div class="mb-3">
                <label for="form-select" class="form-label">Types</label>
                <select id="form-select" class="form-select" aria-label="Default select example" name='type_id'>
                    <option value="">Select Type</option>
                    @foreach ($types as $type)
                        <option @selected($type->id == old('type_id', $project->type_id)) value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <h6>Technologies</h6>

                @foreach ($technologies as $technology)
                    <div class="form-check">
                        @if ($errors->any())
                            <input @checked(in_array($technology->id, old('technologies', []))) class="form-check-input" type="checkbox"
                                value="{{ $technology->id }}" id="{{ $technology->id }}" name="technologies[]">
                        @else
                            <input @checked($project->technologies->contains($technology)) class="form-check-input" type="checkbox"
                                value="{{ $technology->id }}" id="{{ $technology->id }}" name="technologies[]">
                        @endif
                        <label class="form-check-label" for="{{ $technology->id }}">{{ $technology->name }}</label>
                    </div>
                @endforeach
                @error('technologies')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mt-4">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="summary"
                    style="height: 100px">{{ old('title', $project->summary) }}</textarea>
                <label for="floatingTextarea2">Summary </label>
                @error('summary')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-circle-up"></i></button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary btn-sm" tabindex="-1" role="button"
            aria-disabled="true"><i class="fa-regular fa-rectangle-list"></i></a>
    </form>
@endsection
