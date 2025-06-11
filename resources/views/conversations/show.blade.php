@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow mt-6">
    <h1 class="text-2xl font-bold mb-4">{{ $conversation->title }}</h1>
    <div class="space-y-4 mb-8">
        @foreach($messages as $message)
            <div class="border rounded-xl p-4">
                <div class="text-sm text-gray-500 mb-2">{{ $message->user->name }} - {{ $message->created_at->format('d/m/Y H:i') }}</div>
                <p class="mb-2">{{ $message->content }}</p>
                @if($message->attachments->count())
                    <ul class="list-disc ms-5">
                        @foreach($message->attachments as $att)
                            <li>
                                {{ $att->filename }}
                                @if(!$att->analysis_json)
                                    <a href="{{ route('attachments.analyze', $att->id) }}" class="text-purple-600 hover:underline ms-2">Analyser</a>
                                @else
                                    <a href="{{ route('attachments.analyze', $att->id) }}" class="text-green-600 hover:underline ms-2">Voir analyse</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>

    <form action="{{ route('conversations.message.store', $conversation->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea name="content" rows="3" class="w-full border rounded-xl px-3 py-2 mb-3" placeholder="Votre message..." required></textarea>
        @error('content')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        <input type="file" name="attachments[]" multiple class="border mb-3">
        @error('attachments.*')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl">Envoyer</button>
    </form>
</div>
@endsection
