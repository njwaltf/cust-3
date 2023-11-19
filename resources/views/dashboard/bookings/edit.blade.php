@extends('layouts.app')
@section('main')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="/dashboard/bookings/">Bookings</a> /</span>
            Detail</h4>

        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12 my-3">
                <h2>Booking Detail</h2>
            </div>
        </div>
        <div class="row">
            @if ($booking->book->image)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold m-3">Book Cover</h5>
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
                        <h5 class="card-title fw-semibold m-1">Booking Information</h5>
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
                                    <p class="m-1">Not yet returned</p>
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
                <div class="card w-100 my-3">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold m-3">Proceed Booking</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="title" class="form-label">Change booking status for {{ $booking->user->name }}
                            </label>
                            <p>You can approve or reject user booking</p>
                            <form action="/dashboard/bookings/{{ $booking->id }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                <input type="hidden" name="user_id" value="{{ $booking->user->id }}">
                                <select class="form-select @error('status') is-invalid @enderror"
                                    aria-label="Default select example" id="status" name="status">
                                    <option value="{{ 'Approved' }}" @if ($booking->status === 'Approved') selected @endif>
                                        Approve
                                    </option>
                                    <option value="{{ 'Rejected' }}" @if ($booking->status === 'Rejected') selected @endif>
                                        Reject
                                    </option>
                                    <option value="{{ 'Returned' }}" @if ($booking->status === 'Returned') selected @endif>
                                        Returned
                                    </option>
                                </select>
                                {{-- <input type="hidden" name="isDenda" value="{{ 0 }}"> --}}
                                <button type="submit" class="btn btn-primary my-4" style="margin-right: 15px;">Update
                                    Booking Status
                                    <i class="ti ti-checkup-list"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    @endsection
