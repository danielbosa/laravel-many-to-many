@extends('layouts.admin')

@section('title', 'Create Project')

@section('content')
    <section>
        <h2>Create a new project</h2>
        <?php $old = session()->getOldInput();
        var_dump($old); 
        ?>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title') }}" minlength="3" maxlength="200"
                    {{-- required --}}
                    >
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- <div id="titleHelp" class="form-text text-white">Inserire minimo 3 caratteri e massimo 200</div> --}}
            </div>
            <div class="mb-3">
                <label for="type_id" class="form-label">Select Type</label>
                <select name="type_id" id="type_idtype_id" class="form-control @error('type_id') is-invalid @enderror">
                    <option value="">Select Type</option>
                    @foreach ($types as $type)
                    <option value="{{$type->id}}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                    @endforeach
                </select>
                @error('type_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                {{-- ALTERNATIVE SELECT via SELECT2 --}}
                    {{-- <select name="type_id" id="type_idtype_id" class="js-example-basic-multiple" multiple="multiple">
                        @foreach ($types as $type)
                        <option value="{{$type->id}}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                        @endforeach
                        <option value="WY">Wyoming</option>
                    </select> --}}
            </div>
            <div class="mb-3">
                <label for="type_id" class="form-label">Choose Technology</label>
                @foreach ($technologies as $technology)
                    <div>
                        <input type="checkbox" name="technologies[]" value="{{ $technology->id }}"
                        class="form-check-input" 
                        @if(old('technologies') != null)
                        {{ in_array($technology->id, old('technologies')) ? 'checked' : '' }}
                        @endif
                        >
                        <label for="{{$technology->name}}" class="form-check-label">{{ $technology->name }}</label>
                    </div>
                @endforeach
            </div>
            <div class="media me-4">
                @if($project->image)
                <img class="shadow" width="150" src="{{asset('storage/post_images/' . $project->image)}}" alt="{{$project->title}}" id="uploadPreview">
                @else
                <img class="shadow" width="150" src="/images/placeholder.png" alt="{{$project->title}}" id="uploadPreview">
                @endif
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" accept="image/*"  class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}" maxlength="255">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">Url</label>
                <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url') }}" maxlength="255">
                @error('url')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" required>
                {{ old('content') }}
                </textarea>
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div> --}}
            <div class="mb-3">
                <button type="submit" class="btn btn-danger">Create</button>
                <button type="reset" class="btn btn-secondary">Reset</button>

            </div>
        </form>


    </section>
    {{-- Script for NicEdit, for TextArea (to be added) --}}
    @include('partials.niceditor')

    {{-- <script>
        $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    </script> --}}
                            
@endsection