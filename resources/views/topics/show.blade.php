@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $topic->title }}</h5>
                <p>{{ $topic->content }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small>Posté le {{ $topic->created_at->format('d/m/Y à H:m') }}</small>
                    <span class="badge badge-primary">{{ $topic->user->name }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    @can('update', $topic)
                        <a href="{{ route('topics.edit', $topic) }}" class="btn btn-warning">Editer un topic</a>
                    @endcan
                    
                    @can('delete', $topic)
                        <form action="{{ route('topics.destroy', $topic) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Supprimer un topic</button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>

        <hr>
        <h5>Commentaires</h5>

        @forelse($topic->comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    {{ $comment->content }}
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Posté le {{ $comment->created_at->format('d/m/Y à H:m') }}</small>
                        <span class="badge badge-primary">{{ $comment->user->name }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">Aucun commentaire pour ce topic</div>
        @endforelse

        <form action="{{ route('comments.store', $topic) }}" method="POST" class="mt-3">
            @csrf

            <div class="form-group">
                <label for="content">Votre commentaire</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content"></textarea>

                @error('content')
                    <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Soumettre mon commentaire</button>
        </form>
    </div>
@endsection