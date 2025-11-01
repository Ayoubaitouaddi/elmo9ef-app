@extends('layouts')
@section('title', ' Services')

@section('content')
<div class="container">
    <h1>{{ $category->name }} Services</h1>

    @if($services->isEmpty())
        <p>No services available for this category.</p>
    @else
        <ul class="list-group">
            @foreach ($services as $service)
                <li class="list-group-item">
                    <a href="{{ route('services.detail', [$category->name, $service->name]) }}">{{ $service->name }}</a>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- <h3>Taskers offering these services:</h3>
    @if($taskers->isEmpty())
        <p>No taskers available for this category.</p>
    @else
        <ul class="list-group">
            @foreach ($taskers as $tasker)
                <li class="list-group-item">
                    {{ $tasker->name }} ({{ $tasker->services->pluck('name')->implode(', ') }})
                </li>
            @endforeach
        </ul>
    @endif --}}
</div>
@endsection
