@extends('layouts.app')
@section('main')
    @if (auth()->user()->role === 'member' || auth()->user()->role === 'librarian')
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
            <!--  Row 1 -->
            <h4 class="fw-bold py-3 mb-4 title2"><span class="text-muted fw-light">
                <a href="/dashboard/books/" class="title1">Books</a> /
            </span>
                Edit
            </h4>

            <!--  Row 1 -->
            <div class="row">
                <div class="col-lg-12 my-3">
                    <h2 class="sub-header1">Edit {{ $book->title }}</h2>
                </div>
            </div>

            <form action="/dashboard/books/{{ $book->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="status" value="{{ 'Dalam Proses' }}">
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title sbtitle">Main Information</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="title" class="form-label">Book title</label>
                                            <p>The title of the book.</p>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title" value="{{ old('title', $book->title) }}">
                                            @error('title')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="bully_desc" class="form-label">Book Description</label>
                                            <p>Create Description for the book.</p>
                                            <textarea name="desc" id="" cols="160" rows="10"
                                                class="form-control @error('desc')
                                                is-invalid
                                            @enderror">{{ old('desc', $book->desc) }}</textarea>
                                            @error('desc')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="title" class="form-label">Book Category</label>
                                            <p>Select the category of the book.</p>
                                            <select class="form-select @error('type_id') is-invalid @enderror"
                                                aria-label="Default select example" id="type_id" name="type_id">
                                                @forelse ($types as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($book->type_id === $item->id) selected @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @error('type_id')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- tersangka dan korban --}}
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title sbtitle">Book and Publisher Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-4">
                                            <label for="stock" class="form-label">Stock</label>
                                            <p>Set book stock available</p>
                                            <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                                id="stock" name="stock" value="{{ old('stock', $book->stock) }}">
                                            @error('stock')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="mb-4">
                                            <label for="publisher" class="form-label">Publisher Name</label>
                                            <p>Enter name of the book publisher</p>
                                            <input type="text"
                                                class="form-control @error('publisher') is-invalid @enderror" id="publisher"
                                                name="publisher" value="{{ old('publisher', $book->publisher) }}">
                                            @error('publisher')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-4">
                                            <label for="writer" class="form-label">Writer Name</label>
                                            <p>Enter name of the book writer.</p>
                                            <input type="text"
                                                class="form-control @error('writer') is-invalid @enderror" id="writer"
                                                name="writer" value="{{ old('writer', $book->writer) }}">
                                            @error('writer')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="mb-4">
                                            <label for="publish_date" class="form-label">Release Date</label>
                                            <p>Set release date of the book.</p>
                                            <input type="date"
                                                class="form-control @error('publish_date') is-invalid @enderror"
                                                id="publish_date" name="publish_date"
                                                value="{{ old('publish_date', $book->publish_date) }}">
                                            @error('publish_date')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- latar tempat dan waktu --}}
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title sbtitle">Book Cover</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="mb-4">
                                            <label for="image" class="form-label">Book Cover</label>
                                            <p>Upload the book cover</p>
                                            <input type="file"
                                                class="form-control @error('image') is-invalid @enderror" id="image"
                                                name="image" value="" onchange="previewImage(event);">
                                            @if ($book->image > 0)
                                                <img id="preview-selected-image" class="img-fluid m-2" height="200"
                                                    width="150" src="{{ asset('storage/' . $book->image) }}">
                                            @else
                                                <img id="preview-selected-image" class="img-fluid m-2" height="200"
                                                    width="150">
                                            @endif
                                            @error('image')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <button type="submit" class="btn btn-custom" style="margin-right: 15px">Update book 
                            <i class="ti ti-plus"></i>
                        </button>

                        <a href="/dashboard/books" class="btn btn-outline-warning mt-2">Back</a>
                    </div>
                </div>
            </form>
        </div>

        <script>
            const previewImage = (event) => {
                /**
                 * Get the selected files.
                 */
                const imageFiles = event.target.files;
                /**
                 * Count the number of files selected.
                 */
                const imageFilesLength = imageFiles.length;
                /**
                 * If at least one image is selected, then proceed to display the preview.
                 */
                if (imageFilesLength > 0) {
                    /**
                     * Get the image path.
                     */
                    const imageSrc = URL.createObjectURL(imageFiles[0]);
                    /**
                     * Select the image preview element.
                     */
                    const imagePreviewElement = document.querySelector("#preview-selected-image");
                    /**
                     * Assign the path to the image preview element.
                     */
                    imagePreviewElement.src = imageSrc;
                    /**
                     * Show the element by changing the display value to "block".
                     */
                    imagePreviewElement.style.display = "block";
                }
            };
        </script>
    @endsection
@endif
