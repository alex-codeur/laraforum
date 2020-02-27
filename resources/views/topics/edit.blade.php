@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $topic->title }}</h1>
        <hr>

        <form action="{{ route('topics.update', $topic) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="title">Titre du topic</label>
                <input type="text" value="{{ $topic->title }}" class="form-control @error('title') is-invalid @enderror" name="title" id="title">

                @error('title')
                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Titre du topic</label>
                <textarea class="form-control @error('title') is-invalid @enderror" name="content" id="content">{{ $topic->content }}</textarea>

                @error('content')
                    <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Modifier mon topic</button>
        </form>
    </div>
@endsection