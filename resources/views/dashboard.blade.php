@extends('layout')
@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Tableau de bord</h1>

{{-- Cartes de statistiques --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <x-stat-card title="Utilisateurs" :value="$stats['users']" />
    <x-stat-card title="Commandes"   :value="$stats['orders']" />
    <x-stat-card title="Chiffre (€)" :value="number_format($stats['revenue'], 0, ',', ' ')" money />
</div>

{{-- Graphique des ventes --}}
<div class="mt-10 bg-white p-6 rounded-2xl shadow">
    <h2 class="text-lg font-medium mb-4">Ventes sur 6 mois</h2>
    <canvas id="salesChart" class="w-full h-64"></canvas>
</div>
@push('scripts')
<script>
    window.dashboardSales = @json($sales);
</script>
@endpush

@endsection
