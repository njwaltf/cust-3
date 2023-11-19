@extends('layouts.app')
@section('main')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="/dashboard/">Dashboard</a> /</span>
            Bookings
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
        @if (auth()->user()->role === 'member')
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle table-hover display" id="myTable">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">No</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Book Title</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Borrow Date</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Expired Date</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $book)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $book->book->title }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <span
                                        @if ($book->status === 'Waiting') class="badge bg-warning rounded-3 fw-semibold"
                                    @elseif ($book->status === 'Approved')
                                        class="badge bg-success rounded-3 fw-semibold"
                                    @elseif ($book->status === 'Returned')
                                        class="badge bg-black rounded-3 fw-semibold"
                                    @elseif ($book->status === 'Rejected')
                                        class="badge bg-danger rounded-3 fw-semibold"
                                    @elseif ($book->status === 'Returned Late')
                                        class="badge bg-danger rounded-3 fw-semibold" @endif>{{ $book->status }}
                                    </span>
                                </td>
                                <td class="border-bottom-0">
                                    {{ date('d-m-Y', strtotime($book->book_at)) }}
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1"
                                        @if ($book->isDenda === 1) style="color:red;" @endif>
                                        @if ($book->expired_date != 0)
                                            {{ date('d-m-Y', strtotime($book->expired_date)) }}
                                        @else
                                            Not approved yet
                                        @endif
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    {{-- update --}}
                                    <a href="/dashboard/bookings/{{ $book->id }}" class="btn btn-primary m-1">Detail
                                        <i class="ti ti-edit"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Book not found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="col-6 mx-2">
                {{-- <a href="/dashboard/books/create" class="btn btn-primary">Add new Books</a> --}}
                @if (auth()->user()->role === 'admin')
                    <a class="btn btn-info my-3" href="{{ url('/qr/export/bookings') }}">Export Data</a>
                @endif
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle table-hover display" id="myTable">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">No</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Book Title</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Borrower</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Borrow Date</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Expired Date</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($all_bookings as $book)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $book->book->title }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $book->user->name }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <span
                                        @if ($book->status === 'Waiting') class="badge bg-warning rounded-3 fw-semibold"
                                @elseif ($book->status === 'Approved')
                                    class="badge bg-success rounded-3 fw-semibold"
                                @elseif ($book->status === 'Returned')
                                    class="badge bg-black rounded-3 fw-semibold"
                                @elseif ($book->status === 'Rejected')
                                    class="badge bg-danger rounded-3 fw-semibold"
                                @elseif ($book->status === 'Returned Late')
                                    class="badge bg-danger rounded-3 fw-semibold" @endif>{{ $book->status }}
                                    </span>
                                </td>
                                <td class="border-bottom-0">
                                    {{ date('d-m-Y', strtotime($book->book_at)) }}
                                </td>
                                <td class="border-bottom-0">
                                    @if ($book->expired_date)
                                        {{ date('d-m-Y', strtotime($book->expired_date)) }}
                                    @else
                                        Not approved yet
                                    @endif
                                </td>
                                <td class="border-bottom-0">
                                    {{-- update --}}
                                    <a href="/dashboard/bookings/{{ $book->id }}/edit"
                                        class="btn btn-warning m-1">Proceed
                                        <i class="ti ti-edit"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Bookings not found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
        <!-- Examples -->
        <!-- Examples -->
        <!--/ Card layout -->
    </div>

    <!-- / Content -->
@endsection
