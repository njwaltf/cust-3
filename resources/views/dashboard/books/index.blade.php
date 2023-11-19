@extends('layouts.app')
@section('main')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="/dashboard/">Dashboard</a> /</span>
            Books
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
            <div class="row mb-5">
                @forelse ($books as $book)
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card h-100">
                            <img class="card-img-top" src="{{ asset('storage/' . $book->image) }}" alt="Card image cap" />
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">
                                    {{ Str::limit($book->desc, 50, '...') }}
                                </p>
                                <a href="/dashboard/books/{{ $book->id }}" class="btn btn-outline-primary">See
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <h2>Book not found</h2>
                @endforelse
            </div>
        @else
            <div class="row my-3">
                <div class="col-2">
                    <h2>Book List</h2>
                </div>
                <div class="col-6 mx-2">
                    <a href="/dashboard/books/create" class="btn btn-primary">Add new Books</a>
                    @if (auth()->user()->role === 'admin')
                        <a class="btn btn-info my-3" href="{{ url('/qr/export/books') }}">Export Data</a>
                    @endif
                </div>
            </div>
            {{-- @if (auth()->user()->role === 'admin')
                <div class="row">
                    <div class="col-3">
                    </div>
                </div>
            @endif --}}
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
                                <h6 class="fw-semibold mb-0">Stock</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Publisher</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $book->title }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1"
                                        @if ($book->stock > 0) style="color:green;" @else style="color:red;" @endif>
                                        @if ($book->stock > 0)
                                            {{ $book->stock }}
                                        @else
                                            {{ 'Habis' }}
                                        @endif
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $book->publisher }}
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    {{-- detail --}}
                                    <a href="/dashboard/books/{{ $book->id }}" class="btn btn-info m-1">Detail <i
                                            class="ti ti-arrow-right"></i></a>
                                    {{-- update --}}
                                    <a href="/dashboard/books/{{ $book->id }}/edit" class="btn btn-warning m-1">Edit
                                        <i class="ti ti-edit"></i></a>
                                    {{-- delete --}}
                                    <form action="/dashboard/books/{{ $book->id }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger m-1" type="submit"
                                            onclick="return confirm('Are you sure want to delete {{ $book->title }}?')">Delete
                                            <i class="ti ti-circle-x"></i></button>
                                    </form>
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
        @endif
        <!-- Examples -->
        <!-- Examples -->
        <!--/ Card layout -->
    </div>

    <!-- / Content -->
@endsection
