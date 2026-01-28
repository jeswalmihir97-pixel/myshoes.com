@extends('layout.amaster')

@section('content')
<div class="container d-flex flex-column align-items-center mt-5 mb-3" style="min-height: 80vh;">
    <h2 class="text-center text-white mb-4">Admin Dashboard</h2>

    <div class="d-flex flex-column align-items-center gap-3">
        @php
            $dashboardItems = [
                ['title' => 'Total Orders', 'count' => $totalOrders, 'color' => 'primary'],
                ['title' => 'Available Stock', 'count' => $availableStock, 'color' => 'success'],
                ['title' => 'Available Products', 'count' => $availableProducts, 'color' => 'warning']
            ];
        @endphp

        @foreach($dashboardItems as $item)
        <div class="card text-white bg-{{ $item['color'] }} shadow-lg" style="width: 18rem; padding: 15px;">
            <div class="card-body text-center">
                <h5 class="card-title fs-5">{{ $item['title'] }}</h5>
                <h4 class="fw-bold">{{ $item['count'] }}</h4>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
