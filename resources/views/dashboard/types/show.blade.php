@extends('layouts.app')
@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">

        @if (auth()->user()->role === 'admin')
            <div class="row">
                <div class="col-lg-12 my-3">
                    <h2><a href="/dashboard/types"><i class="ti ti-arrow-left"></i></a> Category Detail</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card w-100">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold m-3">{{ $type->name }}</h5>
                        </div>
                        <div class="card-body p-3">
                            {!! $type->desc !!}
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-4">
                            <a href="/dashboard/types" class="btn btn-info">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Error -->
            <div class="container-xxl container-p-y">
                <div class="misc-wrapper">
                    <h2 class="mb-2 mx-2">Page Not Found :(</h2>
                    <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
                    <a href="/dashboard" class="btn btn-primary">Back to home</a>
                    <div class="mt-3">
                        <img src="{{ asset('assets/img/illustrations/page-misc-error-light.png') }}"
                            alt="page-misc-error-light" width="500" class="img-fluid"
                            data-app-dark-img="illustrations/page-misc-error-dark.png"
                            data-app-light-img="illustrations/page-misc-error-light.png" />
                    </div>
                </div>
            </div>
            <!-- /Error -->
        @endif
    </div>
@endsection
