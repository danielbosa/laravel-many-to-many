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
</section>
@include('partials.modal-delete')
@endsection