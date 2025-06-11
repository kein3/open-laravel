@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-2xl p-8 mt-6">
    <h1 class="text-3xl font-bold mb-8 text-blue-700">Partage de fichiers</h1>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 text-green-800 p-4 mb-8 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data"
        class="mb-10 flex flex-col sm:flex-row gap-4 items-center">
        @csrf
        <input type="file" name="file" class="border border-gray-300 rounded-xl px-4 py-2 flex-1" required>
        @error('file')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        <button type="submit"
            class="bg-blue-600 text-white px-6 py-2 rounded-xl shadow hover:bg-blue-700 transition text-base font-semibold">
            Télécharger
        </button>
    </form>

    <div class="overflow-x-auto rounded-2xl shadow-sm">
        <table class="w-full text-base bg-white rounded-2xl overflow-hidden">
            <thead>
                <tr class="bg-blue-50">
                    <th class="p-5 text-left font-semibold">Nom du fichier</th>
                    <th class="p-5 text-left font-semibold">Analyse IA</th>
                    <th class="p-5 font-semibold text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $file)
                    <tr class="border-b last:border-b-0 hover:bg-gray-50 transition">
                        <td class="p-5 align-top font-medium text-gray-800">{{ $file->filename }}</td>
                        <td class="p-5 align-top">
                            @if($file->analysis_json)
                                @php $data = json_decode($file->analysis_json, true); @endphp
                                <div class="bg-gray-50 rounded-xl p-4 shadow-inner">
                                    <dl class="space-y-2">
                                        @foreach($data as $key => $value)
                                            <div class="flex flex-col sm:flex-row">
                                                <dt class="font-semibold text-gray-700 w-40 shrink-0">
                                                    {{ ucfirst(str_replace('_', ' ', $key)) }}
                                                </dt>
                                                <dd class="ml-2 text-gray-800 flex-1">
                                                    {{ is_array($value) ? implode(', ', $value) : $value }}
                                                </dd>
                                            </div>
                                        @endforeach
                                    </dl>
                                </div>
                            @else
                                <span class="text-gray-400 italic">Non analysé</span>
                            @endif
                        </td>
                        <td class="p-5 align-top text-center">
                            <div class="flex flex-col gap-3 items-center">
                                <a href="{{ route('files.download', $file->id) }}"
                                   class="bg-blue-600 text-white px-5 py-2 rounded-xl shadow hover:bg-blue-700 transition text-sm font-medium">
                                    Télécharger
                                </a>
                                @if(auth()->id() === $file->user_id)
                                    <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-5 py-2 rounded-xl shadow hover:bg-red-600 transition text-sm font-medium">
                                            Supprimer
                                        </button>
                                    </form>
                                @endif
                                @if(!$file->analysis_json)
                                    <a href="{{ route('files.analyze', $file->id) }}"
                                       class="bg-purple-600 text-white px-5 py-2 rounded-xl shadow hover:bg-purple-700 transition text-sm font-medium">
                                        Analyser avec OpenAI
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8 flex justify-center">
        {{ $files->links() }}
    </div>
</div>
@endsection
