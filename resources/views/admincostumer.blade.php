@extends('layout.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Customer Overview</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- User Card -->
        <div class="bg-white p-4 rounded-xl shadow border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-700 font-semibold uppercase mb-1">User</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $total_customers }}</h2>
                </div>
                <div class="text-blue-400 text-3xl">👥</div>
            </div>
        </div>

        <!-- Active User Card -->
        <div class="bg-white p-4 rounded-xl shadow border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-700 font-semibold uppercase mb-1">Active User</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $active_users }}</h2>
                </div>
                <div class="text-green-400 text-3xl">👨‍💼</div>
            </div>
        </div>

        <!-- New Signups Card -->
        <div class="bg-white p-4 rounded-xl shadow border-l-4 border-cyan-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-cyan-700 font-semibold uppercase mb-1">New Signups</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $new_signups }}</h2>
                </div>
                <div class="text-cyan-400 text-3xl">📝</div>
            </div>
        </div>

        <!-- Feedback Card -->
        <div class="bg-white p-4 rounded-xl shadow border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-yellow-700 font-semibold uppercase mb-1">Feedback</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $feedback_count }}</h2>
                </div>
                <div class="text-yellow-400 text-3xl">💬</div>
            </div>
        </div>
    </div>
@endsection