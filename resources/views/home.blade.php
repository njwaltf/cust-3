@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ ('assets/css/home.css') }}">
@endsection

@section('content')
    @include('layouts.partials.nav')

    <main>
        <div id="carouselExampleCaptions" class="carousel slide" >
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
    
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="{{ asset('assets/img/backgrounds/lib-1.jpg') }}" class="d-block w-100" style="filter: brightness(50%);">
                <div class="carousel-caption d-none d-md-block mb-3">
                    <h2>Welcome!</h2>
                    <q>The more you read, the more you know</q>
                    <p>-Diva Shiyamma Andini</p>
                    <a href="{{ route('login') }}" class="btn btn-primary darkbutton">Login</a>
                </div>
            </div>
    
                    
            <div class="carousel-item">
                <img src="{{ asset('assets/img/backgrounds/lib-3.jpg') }}" class="d-block w-100 bg-success" style="filter: brightness(50%);">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Join Our Literary Community</h2>
                    <p>Become a part of our vibrant community of book enthusiasts and embark on a journey of exploration and imagination</p>
                </div>
            </div>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
    
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
            
            
        <!--Profil-->
        <div class="container">
            <div class="row custom-margin">
                <div class="col-4 d-flex flex-column justify-content-center">
                    <h5 class="text-uppercase">SMKN 40 Jakarta Library</h5>
                    <h2 class="title">Stepping into the Realm of Knowledge</h2>
                </div>   
     
                <div class="col-8">
                    <p style="text-align: justify;">SMKN 40 Digital Library is a treasure trove of knowledge, a digital oasis where students and educators alike embark on a journey of discovery. As a dynamic educational institution, SMKN 40 has recognized the pivotal role that technology plays in shaping the future of learning. In our ever-evolving world, access to information is no longer confined to the physical walls of a traditional library.</p>
                    <p style="text-align: justify;">Our digital library breaks down barriers, providing students with access to an extensive and diverse collection of digital resources that span a wide array of subjects, from science and technology to arts and humanities. This digital haven empowers students to explore, learn, and grow in an era of information abundance</p>
                </div>
            </div>
        </div>
    
           
        <!--why us-->
        <div class="container">
            <div class="d-flex flex-row" style="border-radius: 5px;">
                <div class="col-4">
                    <div class="card card-custom">
                        <div class="card-body">
                            <h4 class="card-title">Supports Distance Learning</h4>
                            <p class="card-text">In the current landscape marked by remote and distance learning, the digital library stands as a critical resource hub, offering vital academic support and materials to help students achieve outstanding results.</p>
                        </div>
                    </div>
                </div>
    
                <div class="col-4">
                    <div class="card card-custom">
                        <div class="card-body">
                            <h4 class="card-title">24/7 Accessibility</h4>
                            <p class="card-text">Our digital library can be accessed 24/7 from anywhere with an internet connection. It provides the flexibility for students to study and research at their convenience, allowing for self-paced learning.</p>
                        </div>
                    </div>
                </div>
    
                <div class="col-4">
                    <div class="card card-custom">
                        <div class="card-body">
                            <h4 class="card-title">Stay Current with Trends</h4>
                            <p class="card-text">Our digital library, as a beacon of knowledge, not only provides an extensive repository of resources but also serves as a vigilant guardian of academic progress because it's' a dynamic platform</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
            
        <!--register-->
        <div class="container-fluid register">
            <div class="row custom-margin">
                <div class="col d-flex flex-column align-items-center">
                    <h5 class="text-uppercase" style="color: #fff;">Let's join Us</h5>
                    <h2 style="color: #fff;">Explore the world of knowledge</h2>
                    <p style="text-align: center; color:#fff">To become a member of the SMKN 40 Jakarta library, you can go directly to the librarian at the SMKN 40 Jakarta</p>
                </div>
            </div>
        </div>
    </main>
