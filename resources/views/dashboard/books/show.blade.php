@extends('layouts.app')
@section('main')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="/dashboard/books/">Books</a> /</span>
            {{ $book->title }}</h4>

        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12 my-3">
                <h2>Book Detail</h2>
            </div>
        </div>
        <div class="row">
            @if ($book->image)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold m-3">Book Cover</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <img src="{{ asset('storage/' . $book->image) }}" height="440" class="m-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-lg-6 m-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold m-1">Information Detail</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="row my-3">
                            <div class="col-lg-6">
                                <strong class="m-1">Writer</strong>
                            </div>
                            <div class="col-lg-6">
                                <p class="m-1">{{ $book->writer }}</p>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-lg-6">
                                <strong class="m-1">Released Date</strong>
                            </div>
                            <div class="col-lg-6">
                                <p class="m-1">{{ $book->publish_date }}</p>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-lg-6 col-sm-12">
                                <strong class="m-1">Book Category</strong>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <p class="m-1">{{ $book->type->name }}</p>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-lg-6 col-sm-12">
                                <strong class="m-1">Stock</strong>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <p class="m-1"
                                    @if ($book->stock > 0) style="color: green;"
                            @else
                            style="color: red;" @endif>
                                    @if ($book->stock > 0)
                                        {{ $book->stock }}
                                    @else
                                        Tidak Tersedia
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-lg-6 col-sm-12">
                                <strong class="m-1">Publisher</strong>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <p class="m-1">{{ $book->publisher }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->role === 'member' && $book->stock > 0)
                    <div class="col-lg-6 my-5">
                        <div class="card w-100">
                            <div class="card-header">
                                <h5 class="card-title fw-semibold ">Interested to {{ $book->title }} ?</h5>
                            </div>
                            <div class="card-body p-3">
                                <div class="row m-0">
                                    <div class="col-lg-5 m-0">
                                        <form action="/dashboard/bookings" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $book->id }}" name="book_id">
                                            <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                            <input type="hidden" value="{{ 'Waiting' }}" name="status">
                                            <input type="hidden" value="{{ 0 }}" name="isDenda">
                                            <input type="hidden" value="{{ $book->stock }}" name="stock">
                                            <button class="btn btn-primary" type="submit">Borrow</button>
                                        </form>
                                    </div>
                                    {{-- <p>{{ $date_now->format('d-m-Y') }}</p> --}}
                                    <div class="col-lg-5 m-0">
                                        <a href="/dashboard/books" class="btn btn-outline-warning">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <div class="row my-3">
                <div class="col-10">
                    <div class="card w-100">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold m-3">Book Description</h5>
                        </div>
                        <div class="card-body p-3">
                            {!! $book->desc !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- / Content -->
@endsection
