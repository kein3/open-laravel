@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Partage de fichiers</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data" class="mb-6">
        @csrf
        <input type="file" name="file" class="border p-2 w-full mb-2" required>
        @error('file')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Télécharger</button>
    </form>

    <table class="w-full border-collapse">
        <thead>
            <tr class="border-b">
                <th class="p-2 text-left">Nom du fichier</th>
                <th class="p-2 text-left">Analyse IA</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
                <tr class="border-b">
                    <td class="p-2">{{ $file->filename }}</td>
                    <td class="p-2">
                        @if($file->analysis_json)
                            @php $data = json_decode($file->analysis_json, true); @endphp
                            <table class="text-sm border bg-gray-50 rounded">
                                @foreach($data as $key => $value)
                                    <tr>
                                        <td class="px-2 py-1 font-semibold">{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                                        <td class="px-2 py-1">
                                            {{ is_array($value) ? implode(', ', $value) : $value }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <span class="text-gray-500 italic">Non analysé</span>
                        @endif
                    </td>
                    <td class="p-2 space-x-2">
                        <a href="{{ route('files.download', $file->id) }}" class="text-blue-600 hover:underline">Télécharger</a>
                        @if(auth()->id() === $file->user_id)
                            <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        @endif
                        @if(!$file->analysis_json)
                            <!-- Bouton Analyser seulement si pas d'analyse enregistrée -->
                            <a href="{{ route('files.analyze', $file->id) }}" class="text-purple-600 hover:underline">Analyser avec OpenAI</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $files->links() }}
    </div>
</div>
@endsection
