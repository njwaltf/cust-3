@extends('layouts.app')
@section('main')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-center row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title header">Welcome {{ auth()->user()->name }} 📚</h5>
                                @if (auth()->user()->role === 'member')
                                    <p class="mb-3 txt">
                                        You have done <span class="fw-bold">{{ $count_user_bookings }} </span>book. Check our
                                        new
                                        book in
                                        book collection.
                                    </p>

                                    <a href="/dashboard/books" class="btn btn-sm btn-custom">Explore</a>
                                @else

                                    <p class="mb-4 txt">
                                        @if ($count_wait_bookings)
                                            There is <span class="fw-bold">{{ $count_wait_bookings }} </span> bookings have
                                            not
                                            been approved yet.
                                        
                                        @else
                                            All book has been approved.
                                            @endif
                                    </p>

                                    <a href="/dashboard/bookings" class="btn btn-sm btn-custom">See Detail</a>
                                @endif
                                {{-- <p class="mb-4">
                                    You have done <span class="fw-bold">5 </span>book. Check our new
                                    book in
                                    your book collection.
                                </p> --}}

                            </div>
                        </div>

                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <img src="{{ asset('assets/img/backgrounds/secondpict.jpg') }}" height="155"
                                    alt="View Badge User" data-app-dark-img="backgrounds/secondpict.jpg"
                                    data-app-light-img="backgrounds/secondpict.jpg" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-4 mb-4">
                        
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="dropdown">
                                        <button class="btn p-0 btn-custom" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                            <a class="dropdown-item" href="/dashboard/bookings">View
                                                More</a>
                                            {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                                        </div>
                                    </div>
                                </div>

                                <span class=" mb-1 sub-header">Bookings</span>
                                @if (auth()->user()->role === 'member')
                                    <h3 class="card-title text-nowrap mb-2">{{ $count_user_bookings }}</h3>
                                @else
                                    <h3 class="card-title text-nowrap mb-2">{{ $count_bookings }}</h3>
                                @endif
                                {{-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    
                                    <div class="dropdown">
                                        <button class="btn btn-custom p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                            <a class="dropdown-item" href="/dashboard/bookings">View
                                                More</a>
                                            {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                                        </div>
                                    </div>
                                </div>

                                <span class="d-block mb-1 sub-header">Forfeit</span>
                                @if (auth()->user()->role === 'member')
                                    <h3 class="card-title text-nowrap mb-2">{{ $count_user_denda }}</h3>
                                @else
                                    <h3 class="card-title text-nowrap mb-2">{{ $count_denda }}</h3>
                                @endif
                                {{-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    
                                    <div class="dropdown">
                                        <button class="btn btn-custom p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                            <a class="dropdown-item" href="/dashboard/bookings">View
                                                More</a>
                                            {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                                        </div>
                                    </div>
                                </div>

                                <span class="d-block mb-1 sub-header">Active Bookings</span>
                                @if (auth()->user()->role === 'member')
                                    <h3 class="card-title text-nowrap mb-2">{{ $count_user_active_booking }}</h3>
                                @else
                                    <h3 class="card-title text-nowrap mb-2">{{ $count_active_booking }}</h3>
                                @endif
                                {{-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">


            <!-- Transactions -->
            <div class="col-md-6 col-lg-4 order-2 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2 sub-header">Booking History</h5>
                        
                        <div class="dropdown">
                            <button class="btn btn-custom p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                <a class="dropdown-item" href="/dashboard/bookings">View More</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="p-0 m-0">
                            @if (auth()->user()->role === 'member')
                                @forelse ($latest_user_bookings as $booking)
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            @if ($booking->status === 'Waiting')
                                                <img src="assets/img/icons/unicons/waiting-icon.png" alt="User"
                                                    class="rounded" />

                                            @elseif ($booking->status === 'Approved')
                                                <img src="assets/img/icons/unicons/approved-icon.png" alt="User"
                                                    class="rounded" />

                                            @elseif ($booking->status === 'Rejected')
                                                <img src="assets/img/icons/unicons/rejected-icon.png" alt="User"
                                                    class="rounded" />

                                            @elseif ($booking->status === 'Returned')
                                                <img src="assets/img/icons/unicons/returned-icon.png" alt="User"
                                                    class="rounded" />
                                            @endif
                                        </div>

                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <small class="text-muted d-block mb-1">{{ $booking->status }}</small>
                                                <h6 class="mb-0">{{ $booking->book->title }}</h6>
                                            </div>

                                            <div class="user-progress d-flex align-items-center gap-1">
                                                <h6 class="mb-0">
                                                    {{ date('d-m-Y', strtotime($booking->created_at)) }}</h6>
                                                {{-- <span class="text-muted">USD</span> --}}
                                            </div>
                                        </div>
                                    </li>

                                @empty
                                    User have'nt done any booking yet
                                @endforelse

                            @else
                                @forelse ($latest_bookings as $booking)
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            @if ($booking->status === 'Waiting')
                                                <img src="assets/img/icons/unicons/waiting-icon.png" alt="User"
                                                    class="rounded" />

                                            @elseif ($booking->status === 'Approved')
                                                <img src="assets/img/icons/unicons/approved-icon.png" alt="User"
                                                    class="rounded" />

                                            @elseif ($booking->status === 'Rejected')
                                                <img src="assets/img/icons/unicons/rejected-icon.png" alt="User"
                                                    class="rounded" />

                                            @elseif ($booking->status === 'Returned')
                                                <img src="assets/img/icons/unicons/returned-icon.png" alt="User"
                                                    class="rounded" />
                                            @endif
                                        </div>

                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <small class="text-muted d-block mb-1">{{ $booking->status }}</small>
                                                <h6 class="mb-0">{{ $booking->book->title }}</h6>
                                            </div>

                                            <div class="user-progress d-flex align-items-center gap-1">
                                                <h6 class="mb-0">
                                                    {{ date('d-m-Y', strtotime($booking->created_at)) }}</h6>
                                                {{-- <span class="text-muted">USD</span> --}}
                                            </div>
                                        </div>
                                    </li>

                                @empty
                                    You have'nt done any booking yet
                                @endforelse
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Transactions -->
        </div>
    </div>
    <!-- / Content -->
@endsection
