    @extends('layouts.app')
    @section('main')
        @if (auth()->user()->role === 'member')
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
        @else
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-lg-12 my-3">
                        <h2><a href="/dashboard/types"><i class="ti ti-arrow-left"></i></a> Add new Category</h2>
                    </div>
                </div>
                <form action="/dashboard/types" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Main Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-4">
                                                <label for="title" class="form-label">Category Name</label>
                                                <p>Create category name.</p>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" value="{{ old('name') }}">
                                                @error('name')
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
                                                <label for="bully_desc" class="form-label">Category Description</label>
                                                <p>Create category description</p>
                                                <textarea name="desc" id="" cols="160" rows="10"
                                                    class="form-control @error('desc')
                                                    is-invalid
                                                @enderror">{{ old('desc') }}</textarea>
                                                @error('desc')
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
                    <div class="row my-3">
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-primary" style="margin-right: 15px">Add Category<i
                                    class="ti ti-plus"></i></button>
                            <a href="/dashboard/types" class="btn btn-outline-warning">Batal</a>
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
        @endif
    @endsection
