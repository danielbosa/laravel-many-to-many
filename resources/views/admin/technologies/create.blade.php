@extends('layouts.admin')

@section('title', 'Create Technology')

@section('content')
    <section>
        <h2>Create a new technology</h2>
        <form action="{{ route('admin.technologies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" minlength="3" maxlength="200" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- <div id="titleHelp" class="form-text text-white">Inserire minimo 3 caratteri e massimo 200</div> --}}
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Icon</label>
                <input type="file" accept="image/*"  class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon') }}" maxlength="255">
                @error('icon')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-danger">Create</button>
                <button type="reset" class="btn btn-secondary">Reset</button>

            </div>
        </form>


    </section>

@endsection