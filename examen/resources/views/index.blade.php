@extends('layouts.app')

@section('title')
    Accueil
@endsection

@section('h1')
    Welcome
@endsection

@section('content')

    @component('layouts.components.alert')
        {{ session('message') }}
    @endcomponent


    <div class="d-flex justify-content-center align-items-center">
        <a href="{{ route('create') }}" class="btn btn-primary">Ajouter un livre</a>
    </div>

    @if (count($livres) == 0)
        <h2 class="text-center mt-5">Aucun livre existe </h2> 
    @else
        <div class="table-responsive">
            <table class="text-center table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Livre</th>
                        <th>Auteur</th>
                        <th>Avis</th>
                        <th>Note</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($livres as $livre)
                        <tr>
                            <td>{{ $livre->book_name }}</td>
                            <td>{{ $livre->author_name }}</td>
                            <td>{{ $livre->opinion }}</td>
                            <td>{{ $livre->note }}</td>
                
                            <td>
                                <a href="{{ route('edit', $livre->id )}}" class="btn btn-sm btn-secondary">Modifier</a>
                                <form action="{{ route('delete', $livre->id )}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-sm btn-danger" value="supprimer" onclick="return confirm('Confirmer la suppression ?')">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif


    
@endsection
