@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6 text-blue-700">Partage de fichiers</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data" class="mb-8 flex flex-col sm:flex-row gap-2 items-center">
        @csrf
        <input type="file" name="file" class="border p-2 rounded flex-1" required>
        @error('file')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">Télécharger</button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-sm border rounded shadow">
            <thead>
                <tr class="bg-blue-50 border-b">
                    <th class="p-3 text-left">Nom du fichier</th>
                    <th class="p-3 text-left">Analyse IA</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $file)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 font-semibold">{{ $file->filename }}</td>
                        <td class="p-3">
                            @if($file->analysis_json)
                                @php $data = json_decode($file->analysis_json, true); @endphp
                                <table class="text-xs w-full border bg-gray-100 rounded">
                                    @foreach($data as $key => $value)
                                        <tr>
                                            <td class="px-2 py-1 font-semibold text-gray-700">{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                                            <td class="px-2 py-1">{{ is_array($value) ? implode(', ', $value) : $value }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <span class="text-gray-400 italic">Non analysé</span>
                            @endif
                        </td>
                        <td class="p-3 flex flex-col gap-1 sm:flex-row sm:items-center">
                            <a href="{{ route('files.download', $file->id) }}" class="text-blue-700 hover:underline">Télécharger</a>
                            @if(auth()->id() === $file->user_id)
                                <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                </form>
                            @endif
                            @if(!$file->analysis_json)
                                <a href="{{ route('files.analyze', $file->id) }}" class="text-purple-700 hover:underline">Analyser avec OpenAI</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $files->links() }}
    </div>
</div>
@endsection
