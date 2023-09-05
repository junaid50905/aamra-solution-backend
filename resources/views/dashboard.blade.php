{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


@extends('admin.master')


@section('main-panel')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Registered Users</h4>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> SN </th>
                                    <th> User name </th>
                                    <th> Email </th>
                                    <th> Activity </th>
                                    <th> Reset Password </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ route('activity', $user->id) }}"
                                                class="btn {{ $user->activity === 1 ? 'btn-success' : 'btn-danger' }}">{{ $user->activity === 1 ? 'Enable' : 'Disable' }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('reset_password_form', $user->id) }}"
                                                class="btn btn-warning">Reset password</a>
                                        </td>
                                    </tr>
                                @empty
                                <p class="text-danger">No user found</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
