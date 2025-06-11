@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Analyse OpenAI du fichier : {{ $attachment->filename }}</h1>

    @if($extracted)
        <div class="mb-4">
            <strong>Champs extraits :</strong>
            <table class="w-full bg-white border border-gray-300 rounded mt-2 mb-6">
                <tbody>
                @foreach($extracted as $key => $value)
                    <tr class="border-b">
                        <th class="text-left px-3 py-2 bg-gray-100 w-1/3 capitalize">
                            {{ str_replace('_', ' ', $key) }}
                        </th>
                        <td class="px-3 py-2">
                            {{ is_array($value) ? implode(', ', $value) : $value }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="mb-4">
            <strong>Résumé/Analyse brute :</strong>
            <div class="bg-gray-100 p-3 rounded mt-2">
                {{ $analysis }}
            </div>
        </div>
    @endif

    <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">Retour</a>
</div>
@endsection
