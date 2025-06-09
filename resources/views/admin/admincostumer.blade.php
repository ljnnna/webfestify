@extends('layouts.admin')

@section('title', 'User')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-[#493862]">Customer Overview</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total User -->
        <x-card-stat title="Total User" :value="$total_customers" />

        <!-- Active User -->
        <x-card-stat title="Active User" :value="$active_users ?? 0" />

        <!-- New Signups -->
        <x-card-stat title="New Signups" :value="$new_signups ?? 0" />

        <!-- Feedback -->
        <x-card-stat title="Feedback Received" :value="$feedback_count ?? 0" />
        
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        
        
@endsection
