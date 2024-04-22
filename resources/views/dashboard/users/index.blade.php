@extends('layouts.app')
@section('main')
    <!-- Content -->
    @if (auth()->user()->role !== 'admin')
        <!-- Error -->
        <div class="container-xxl container-p-y text-center m-5">
            <div class="misc-wrapper">
                <h2 class="mb-2 mx-2">Page Not Found :(</h2>
                <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
                <a href="/dashboard" class="btn btn-custom">Back to home</a>
                
                <div class="mt-3">
                    <img src="{{ asset('assets/img/illustrations/page-misc-error-light.png') }}" alt="page-misc-error-light"
                        width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png"
                        data-app-light-img="illustrations/page-misc-error-light.png" />
                </div>
            </div>
        </div>
        <!-- /Error -->
    @else

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4 title2">
                <span class="text-muted fw-light">
                    <a href="/dashboard/" class="title1">Dashboard</a> /
                </span>
                Users
            </h4>

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {!! session('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('successEdit'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {!! session('successEdit') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('successDelete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {!! session('successDelete') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-2">
                    <h2 class="sub-header1">User List</h2>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <a href="/dashboard/users/create" class="btn btn-custom">Add new Users</a>
                    @if (auth()->user()->role === 'admin')
                        <a class="btn btn-info btn-primary" href="{{ url('/qr/export/users') }}">Export Data</a>
                    @endif
                </div>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle table-hover display" id="myTable">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">No</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Full Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Username</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Role</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $user->name }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $user->username }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    @if ($user->role === 'member')
                                        <div class="badge bg-warning">Member</div>
                                    @elseif ($user->role === 'admin')
                                        <div class="badge bg-dark">Admin</div>
                                    @elseif ($user->role === 'librarian')
                                        <div class="badge bg-primary">Pustakawan</div>
                                    @endif
                                </td>
                                <td class="border-bottom-0">
                                    {{-- detail --}}
                                    <a href="/dashboard/users/{{ $user->id }}" class="btn btn-info m-1 btn-custom">Detail <i
                                            class="ti ti-arrow-right"></i></a>
                                    {{-- update --}}
                                    <a href="/dashboard/users/{{ $user->id }}/edit" class="btn btn-warning m-1">Change
                                        Role
                                        <i class="ti ti-edit"></i></a>
                                    {{-- delete --}}
                                    <form action="/dashboard/users/{{ $user->id }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger m-1" type="submit"
                                            onclick="return confirm('Are you sure want to delete {{ $user->username }}?')">Delete
                                            User
                                            <i class="ti ti-circle-x"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        
                            <tr>
                                <td colspan="5" class="text-center">
                                    User not found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
