@extends('layouts.admin')

@section('title', 'Edit Technology')

@section('content')
    <section>
        <div class="d-flex justify-content-between align-items-center py-4">
            <h2>Edit technology: {{$technology->name}}</h2>
            <a href="{{route('admin.technologies.show', $technology->slug)}}" class="btn btn-danger">Show technology</a>
        </div>

        <form action="{{ route('admin.technologies.update', $technology->slug)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $technology->name) }}" minlength="3" maxlength="200" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- <div id="titleHelp" class="form-text text-white">Inserire minimo 3 caratteri e massimo 200</div> --}}
            </div>
            
            {{-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 
                Preview block 
            !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! --}}
            <div class="media me-4">
                @if($technology->icon)
                <img class="shadow" width="150" src="{{asset('storage/' . $technology->icon)}}" alt="{{$technology->title}}" id="uploadPreview">
                @else
                <img class="shadow" width="150" src="/images/placeholder.png" alt="{{$technology->title}}" id="uploadPreview">
                @endif
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Icon</label>
                <input type="file" accept="image/*" class="form-control @error('icon') is-invalid @enderror" id="image" name="icon" value="{{ old('icon', $technology->icon) }}" maxlength="255">
                @error('icon')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-danger">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>


    </section>

@endsection