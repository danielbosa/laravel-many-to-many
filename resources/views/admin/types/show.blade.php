@extends('layouts.admin')
@section('title', $type->name)

@section('content')
<section>
    <div class="d-flex justify-content-between align-items-center py-4">
        <h1>{{$type->name}}</h1>
        <div>
            <a href="{{route('admin.types.edit', $type->slug)}}" class="btn btn-secondary">Edit</a>
            <form action="{{route('admin.types.destroy', $type->slug)}}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button btn btn-danger"  data-item-title="{{ $type->name }}">
                Delete type</i>
                </button>
            </form>
        </div>
    </div>
    <div class="py-4">
        @if($type->icon)
        <img src="{{asset('storage/' . $type->icon)}}" class="shadow" width="150" alt="{{$type->title}}">
        @else
        <img src="/images/placeholder.png" alt="{{$type->title}}">
        @endif
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col" class="d-none d-md-table-cell">Created At</th>
                <th scope="col" class="d-none d-md-table-cell">Update At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($type->projects as $project)
            <tr>
                <td>{{$project->id}}</td>
                <td>{{$project->title}}</td>
                <td>{{$project->slug}}</td>
                <td class="d-none d-md-table-cell">{{$project->created_at}}</td>
                <td class="d-none d-md-table-cell">{{$project->updated_at}}</td>
                <td>
                    <a href="{{route('admin.projects.show', $project->slug)}}" title="Show" class="text-black px-2"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{route('admin.projects.edit', $project->slug)}}" title="Edit" class="text-black px-2"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button border-0 bg-transparent"  data-item-title="{{ $project->title }}" data-item-id = "{{ $project->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>

                    </form>


                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</section>
@include('partials.modal-delete')
@endsection