@extends('layouts.app')
@section('main')
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

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4 title2">
                <span class="text-muted fw-light">
                    <a href="/dashboard/users/" class="title1">Users</a> /
                </span>
                {{ $user->name }}
            </h4>

            <!--  Row 1 -->
            <div class="row">
                <div class="col-lg-12 my-3">
                    <h2 class="sub-header1">User Detail</h2>
                </div>
            </div>

            <div class="row">
                @if ($user->prof_pic)
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title fw-semibold m-3 text-center sbtitle">{{ $user->name }}</h5>
                            </div>

                            <div class="card-body">
                                <img src="@if ($user->prof_pic > 0) {{ asset('storage/' . $user->prof_pic) }}
                        @else {{ asset('images/profile/user-1.jpg') }} @endif"
                                    width="250" height="250" class="rounded-circle text-center">
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-lg-6 m-2">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold m-1 sbtitle">Information Detail</h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="row my-3">
                                <div class="col-lg-6">
                                    <strong class="m-1">Full Name</strong>
                                </div>
                                <div class="col-lg-6">
                                    <p class="m-1">{{ $user->name }}</p>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-lg-6">
                                    <strong class="m-1">Email</strong>
                                </div>
                                <div class="col-lg-6">
                                    <p class="m-1">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-lg-6 col-sm-12">
                                    <strong class="m-1">Username</strong>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <p class="m-1">{{ $user->username }}</p>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-lg-6 col-sm-12">
                                    <strong class="m-1">Role</strong>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    @if ($user->role === 'member')
                                        <div class="badge bg-warning">Member</div>
                                    @elseif ($user->role === 'admin')
                                        <div class="badge bg-dark">Admin</div>
                                    @elseif ($user->role === 'librarian')
                                        <div class="badge bg-primary">Pustakawan</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    @endif
@endsection
