@extends('layouts.app')

@section('title')
    Nouveau livre
@endsection

@section('h1')
    Nouveau livre
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('store')}}" method="post">
            @csrf
            <div class="form-group my-3">
                <label for="book_name">Nom du livre</label>
                <input type="text" name="book_name" id="book_name" class="form-control" value="{{ old('book_name')}}">
                <div class="text-danger"> {{ $errors->first("book_name", ":message")}}</div>
            </div>

            <div class="form-group my-3">
                <label for="author_name">Nom de l'auteur</label>
                <input type="text" name="author_name" id="author_name" class="form-control" value="{{ old('author_name')}}">
                <div class="text-danger"> {{ $errors->first("author_name", ":message")}}</div>
            </div>

             <div class="form-group my-3">
                <label for="opinion">Avis</label>
                <textarea  name="opinion" id="opinion" class="form-control" rows="4">{{ old('opinion')}}</textarea>
                <div class="text-danger"> {{ $errors->first("opinion", ":message")}}</div>
            </div>

            <div class="form-group my-3">
                <label for="note">Note</label>
                <input type="text" name="note" id="note" class="form-control" value="{{ old('note')}}">
                <div class="text-danger"> {{ $errors->first("note", ":message")}}</div>
            </div>

            <div class="form-group my-3 text-center">
               <input type="submit" class="btn btn-success">
            </div>
        </form>
    </div>
@endsection
