@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-2xl shadow mt-6">
    <h1 class="text-2xl font-bold mb-6 text-blue-700">Nouvelle conversation</h1>
    <form action="{{ route('conversations.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <input type="text" name="title" class="w-full border rounded-xl px-3 py-2" placeholder="Titre de la conversation" required>
            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl">Créer</button>
    </form>
</div>
@endsection
