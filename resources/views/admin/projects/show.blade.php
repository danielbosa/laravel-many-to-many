@extends('layouts.admin')
@section('title', $project->title)

@section('content')
<section>
    <div class="py-4">
        <h1>{{$project->title}}</h1>
        @if($project->name)
        <h2>{{$project->type->name}}</h2>
        @else
        <h2>No type</h2>
        @endif
        <div class="py-4">
            @if($project->image)
            <img src="{{asset('storage/' . $project->image)}}" class="shadow" width="150" alt="{{$project->title}}">
            @else
            <img src="/images/placeholder.png" alt="{{$project->title}}">
            @endif
        </div>
        <div>
            <a href="{{route('admin.projects.edit', $project->slug)}}" class="btn btn-secondary">Edit</a>
            <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button btn btn-danger"  data-item-title="{{ $project->title }}">
                Delete Project</i>
                </button>
            </form>
        </div>

    </div>


    <p>{{$project->content}}</p>
</section>
@include('partials.modal-delete')
@endsection