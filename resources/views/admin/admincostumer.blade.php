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
    
    <!-- Section Review Customer -->
    <div class="mt-12">
        <h2 class="text-2xl font-semibold mb-4 text-[#3a2e52]">Review Customer</h2>
        <div class="bg-white rounded-xl shadow p-6 space-y-4">
            @forelse ($reviews as $review)
            <x-review-item 
            :username="$review->user->username ?? '-'" 
            :product="$review->product->name ?? '-'" 
            :content="$review->content" 
            :date="$review->created_at->format('d M Y')" 
            />
            @empty
            <p class="text-gray-500">Belum ada review dari customer.</p>
            @endforelse
        </div>
    </div>
        
@endsection
