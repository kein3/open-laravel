@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow mt-6">
    <h1 class="text-3xl font-bold mb-6 text-blue-700">Conversations</h1>
    <a href="{{ route('conversations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl mb-4 inline-block">Nouvelle conversation</a>
    <ul class="divide-y divide-gray-200">
        @foreach($conversations as $conversation)
            <li class="py-4">
                <a href="{{ route('conversations.show', $conversation->id) }}" class="text-lg text-blue-600 hover:underline">
                    {{ $conversation->title }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
