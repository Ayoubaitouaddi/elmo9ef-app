@extends('layouts')
@section('title', 'SERVICES')
@section('content')
<div class="container-content">
    <div class="row g-4"> <!-- Added gutter spacing with g-4 -->
        @foreach ($categories as $category)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm mb-4"> <!-- Added mb-4 for bottom margin -->
                    <div class="card-img-container" style="height: 200px; overflow: hidden;">
                        <img src="{{ asset('images/services/' . $category->name . '.jpeg') }}" 
                             class="card-img-top h-100 w-100 object-fit-cover"
                             alt="{{ $category->name }}"
                             onerror="this.src='{{ asset('images/workers2.jpg') }}'">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center mb-3">
                            <a href="{{ route('services.category', $category->name) }}" class="text-decoration-none text-dark">
                                {{ $category->name }}
                            </a>
                        </h5>
                        
                        <ul class="list-group list-group-flush flex-grow-1">
                            @foreach ($category->services as $service)
                                <li class="list-group-item border-0 py-1">
                                    <a href="{{ route('booking.form', ['category' => $category->name, 'service' => $service->name]) }}" 
                                       class="text-decoration-none text-secondary">
                                        {{ $service->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection