@props(['title', 'value', 'money' => false])

<div class="bg-white rounded-2xl shadow p-6">
    <dt class="text-sm font-medium text-gray-500">{{ $title }}</dt>
    <dd class="mt-1 text-3xl font-semibold text-gray-900">
        {{ $money ? '€ ' : '' }}{{ $value }}
    </dd>
</div>
