@extends('layouts.admin')
@section('title', 'Technologies')

@section('content')
<section id='index'>
    @if(session()->has('message'))
    <div class="alert alert-success">{{session()->get('message')}}</div>
    @endif
    <div class="d-flex justify-content-between align-items-center py-4">
        <h1>Technologies</h1>
        <a href="{{route('admin.technologies.create')}}" class="btn btn-danger">Create new technology</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                {{-- <th scope="col" class="d-none d-md-block">Slug</th> --}}
                <th scope="col">Icon</th>
                <th scope="col" class="d-none d-md-table-cell">Created At</th>
                <th scope="col" class="d-none d-md-table-cell">Update At</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($technologies as $technology)
            <tr>
                <td>{{$technology->id}}</td>
                <td>{{$technology->name}}</td>
                {{-- <td class="d-none d-md-table-cell">{{$technology->slug}}</td> --}}
                <td class="">
                    @if($technology->icon)
                    <img class="shadow" width="50" src="{{asset('storage/' . $technology->icon)}}" alt="{{$technology->name}}" id="">
                    @else
                    <img class="shadow" width="50" src="/images/logoDB.png" alt="{{$technology->name}}" id="">
                    @endif
                </td>
                <td class="d-none d-md-table-cell">{{$technology->created_at}}</td>
                <td class="d-none d-md-table-cell">{{$technology->updated_at}}</td>
                <td>
                    <a href="{{route('admin.technologies.show', $technology->slug)}}" title="Show" class="text-black px-2"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{route('admin.technologies.edit', $technology->slug)}}" title="Edit" class="text-black px-2"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{route('admin.technologies.destroy', $technology->slug)}}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        {{--
                            bottone ha classe delete-button perché mi serve per JS! Non per lo stile-scss
                            C'è anche attributo data-item-title --> è attributo che poi vado a mostrare nella modale!
                            --}}
                        <button type="submit" class="delete-button border-0 bg-transparent"  data-item-title="{{ $technology->name }}">
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