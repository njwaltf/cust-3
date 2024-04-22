@extends('layouts.app')
@section('main')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4 title2">
            <span class="text-muted fw-light">
                <a href="/dashboard/bookings/" class="title1">Bookings</a> /
            </span>
            Detail
        </h4>

        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12 my-3">
                <h2 class="sub-header1">Booking Detail</h2>
            </div>
        </div>

        <div class="row">
            @if ($booking->book->image)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold m-3 sbtitle">Book Cover</h5>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <img src="{{ asset('storage/' . $booking->book->image) }}" height="440"
                                        class="m-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold m-1 sbtitle">Booking Information</h5>
                    </div>

                    <div class="card-body p-3">
                        <div class="row my-3">
                            <div class="col-lg-6">
                                <strong class="m-1">Borrow Date</strong>
                            </div>

                            <div class="col-lg-6">
                                <p class="m-1">{{ date('d-m-Y', strtotime($booking->book_at)) }}</p>
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="col-lg-6">
                                <strong class="m-1">Expired Date</strong>
                            </div>

                            <div class="col-lg-6">
                                <p class="m-1" @if ($booking->expired_date != 0) style="color:red" @endif>
                                    @if ($booking->expired_date != 0)
                                        {{ date('d-m-Y', strtotime($booking->expired_date)) }}*
                                    @else
                                        Not approved yet
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="col-lg-6">
                                <strong class="m-1">Return Date</strong>
                            </div>

                            <div class="col-lg-6">
                                @if ($booking->return_date != 0)
                                    <p class="m-1">{{ date('d-m-Y', strtotime($booking->return_date)) }}</p>
                                @else
                                    <p class="m-1">Belum Dikembalikan</p>
                                @endif
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="col-lg-6 col-sm-12">
                                <strong class="m-1">Publisher</strong>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <p class="m-1">{{ $booking->book->publisher }}</p>
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="col-lg-6 col-sm-12">
                                <strong class="m-1">Booking Status</strong>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <span
                                    @if ($booking->status === 'Waiting') class="badge bg-warning rounded-3 fw-semibold"
                                                        @elseif ($booking->status === 'Approved') class="badge bg-success rounded-3 fw-semibold" @elseif ($booking->status === 'Returned') class="badge bg-black rounded-3 fw-semibold" @elseif ($booking->status === 'Rejected') class="badge bg-danger rounded-3 fw-semibold" @elseif ($booking->status === 'Returned Late') class="badge bg-danger rounded-3 fw-semibold" @endif>{{ $booking->status }}</span>
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="col-lg-6 col-sm-12">
                                <strong class="m-1">Forfeit Status</strong>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <span
                                    @if ($booking->isDenda === 1) class="badge bg-danger rounded-3 fw-semibold" @else class="badge bg-success rounded-3 fw-semibold" @endif>
                                    @if ($booking->isDenda === 1)
                                        Active
                                    @else
                                        Not Active
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- / Content -->
        @endsection
