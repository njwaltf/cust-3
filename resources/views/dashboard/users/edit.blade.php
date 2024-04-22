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

    @extends('layouts.app')
    @section('main')
        <div class="container-xxl flex-grow-1 container-p-y">
            <!--  Row 1 -->
            <h4 class="fw-bold py-3 mb-4 title2">
                <span class="text-muted fw-light">
                    <a href="/dashboard/users/" class="title1">Users</a> /
                </span>
                Edit User
            </h4>

            <!--  Row 1 -->
            <div class="row">
                <div class="col-lg-12 my-3">
                    <h2 class="sub-header1">Edit {{ $user->name }}</h2>
                </div>
            </div>

            <form action="/dashboard/users/{{ $user->id }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title sbtitle">User Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="name" class="form-label">Full name</label>
                                            <p>Enter the user's full name</p>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $user->name) }}"
                                                disabled>
                                            @error('name')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="username" class="form-label">Username</label>
                                            <p>Create an username for user</p>
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror" id="username"
                                                name="username" value="{{ old('username', $user->username) }}" disabled>
                                            @error('username')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="email" class="form-label">Email</label>
                                            <p>Enter the user's email address</p>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $user->email) }}"
                                                disabled>
                                            @error('email')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="email" class="form-label">Role</label>
                                            <p>Select the role of this user</p>
                                            <select class="form-select @error('role') is-invalid @enderror"
                                                aria-label="Default select example" id="role" name="role">
                                                <option value="{{ 'member' }}"
                                                    @if ($user->role === 'member') selected @endif>Member</option>
                                                <option value="{{ 'librarian' }}"
                                                    @if ($user->role === 'librarian') selected @endif>Librarian</option>
                                                <option value="{{ 'admin' }}"
                                                    @if ($user->role === 'admin') selected @endif>Admin</option>
                                            </select>
                                            @error('role')
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
                    <div class="col-lg-3 mt-3">
                        <button type="submit" class="btn btn-custom" style="margin-right: 5px">Edit User <i
                                class="ti ti-plus"></i></button>
                        <a href="/dashboard/users" class="btn btn-outline-warning">Cancel</a>
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
