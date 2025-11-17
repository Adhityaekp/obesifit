@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

        <p>Welcome, <span class="font-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span></p>

        <ul class="mt-4">
            <li>Email: {{ auth()->user()->email }}</li>
            <li>Phone: {{ auth()->user()->phone ?? '-' }}</li>
            <li>Role: {{ auth()->user()->role }}</li>
            @if (auth()->user()->role === 'doctor')
                <li>Specialization: {{ auth()->user()->specialization ?? '-' }}</li>
                <li>License Number: {{ auth()->user()->license_number ?? '-' }}</li>
            @endif
        </ul>
    </div>
@endsection
