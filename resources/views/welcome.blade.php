<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>LESPMS</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('assets/img/Logo/logo1.jpg') }}" type="image/x-icon">
    {{-- <link href="{{ asset('') }}assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

    <!-- Fonts -->
    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/landing/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/landing/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div
            class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="#" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">LESPMS</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}" class="btn-getstarted fw-bold py-2 px-4">Home</a>
                @else
                    <a href="{{ route('login') }}" class="btn-getstarted fw-bold py-2 px-4">Login</a>
                @endauth
            @endif

            <!-- <a class="btn-getstarted" href="index.html#about">Get Started</a> -->

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                            <div class="company-badge mb-4">
                                <i class="bi bi-gear-fill me-2"></i>
                                Discover Your Next Great Experience
                            </div>

                            <h1 class="mb-4">
                                Discover Unique Services <br>
                                Create Unforgettable Memories <br>
                                <span class="accent-text">Effortless Event Planning</span>
                            </h1>

                            <p class="mb-4 mb-md-5">
                                Experience seamless event planning with our comprehensive services. From unique
                                destinations to personalized experiences, we ensure every detail is taken care of for
                                your perfect event.
                            </p>

                            <div class="hero-buttons">
                                <a href="{{ route('register') }}" class="btn btn-primary me-0 me-sm-2 mx-1">Get
                                    Started</a>
                                {{-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                                    class="btn btn-link mt-2 mt-sm-0 glightbox">
                                    <i class="bi bi-play-circle me-1"></i>
                                    Play Video
                                </a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="hero-image p-5" data-aos="zoom-out" data-aos-delay="300">
                            <img src="{{ asset('assets/img/Logo/logo1.jpg') }}" alt="Hero Image"
                                class=" rounded-5 img-fluid h-70">

                            {{-- <div class="customers-badge">
                                <div class="customer-avatars">
                                    <img src="assets/img/avatar-1.webp" alt="Customer 1" class="avatar">
                                    <img src="assets/img/avatar-2.webp" alt="Customer 2" class="avatar">
                                    <img src="assets/img/avatar-3.webp" alt="Customer 3" class="avatar">
                                    <img src="assets/img/avatar-4.webp" alt="Customer 4" class="avatar">
                                    <img src="assets/img/avatar-5.webp" alt="Customer 5" class="avatar">
                                    <span class="avatar more">12+</span>
                                </div>
                                <p class="mb-0 mt-2">12,000+ lorem ipsum dolor sit amet consectetur adipiscing elit</p>
                            </div> --}}
                        </div>
                    </div>
                </div>

                {{--  <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-trophy"></i>
                            </div>
                            <div class="stat-content">
                                <h4>3x Won Awards</h4>
                                <p class="mb-0">Vestibulum ante ipsum</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div class="stat-content">
                                <h4>6.5k Faucibus</h4>
                                <p class="mb-0">Nullam quis ante</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-graph-up"></i>
                            </div>
                            <div class="stat-content">
                                <h4>80k Mauris</h4>
                                <p class="mb-0">Etiam sit amet orci</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-award"></i>
                            </div>
                            <div class="stat-content">
                                <h4>6x Phasellus</h4>
                                <p class="mb-0">Vestibulum ante ipsum</p>
                            </div>
                        </div>
                    </div>
                </div>  --}}

            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 align-items-center justify-content-between">

                    <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
                        <span class="about-meta">MORE ABOUT US</span>
                        <h2 class="about-title">Plan Your Perfect Event with Us</h2>
                        <p class="about-description">
                            We are dedicated to connecting clients with exceptional event services and unforgettable
                            experiences.
                            Whether youre planning a wedding, corporate event, or private party, our mission is to make
                            every event
                            seamless and extraordinary.
                        </p>

                        <div class="row feature-list-wrapper">
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li><i class="bi bi-check-circle-fill"></i> Customized event packages</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Professional event planners</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Hassle-free bookings</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li><i class="bi bi-check-circle-fill"></i> Competitive pricing</li>
                                    <li><i class="bi bi-check-circle-fill"></i> 24/7 customer support</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Trusted by numerous clients</li>
                                </ul>
                            </div>
                        </div>

                        <div class="info-wrapper">
                            <div class="row gy-4">
                                <div class="col-lg-5">
                                    <div class="profile d-flex align-items-center gap-3">
                                        <div>
                                            <h4 class="profile-name">Buguey Cagayan</h4>
                                            <p class="profile-position">Founder & Event Specialist</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="contact-info d-flex align-items-center gap-2">
                                        <i class="bi bi-telephone-fill"></i>
                                        <div>
                                            <p class="contact-label">Reach us anytime</p>
                                            <p class="contact-number">+123 456-789</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="image-wrapper">
                            <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                                <img src="https://tse4.mm.bing.net/th?id=OIP.6BnSnib2JesKeZfpjQFRuQHaFI&pid=Api&P=0&h=180"
                                    alt="Event Planning" class="img-fluid main-image rounded-4">
                                <img src="https://tse2.mm.bing.net/th?id=OIP.O3iqihav4jpTtNDgjud_agHaE8&pid=Api&P=0&h=180"
                                    alt="Event Services" class="img-fluid small-image rounded-4">
                            </div>
                            <div class="experience-badge floating">
                                <h3>15+ <span>Years</span></h3>
                                <p>Of crafting incredible events</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->


        <!-- Stats Section -->
        <section id="stats" class="stats section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="120" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Clients</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="17" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Event Services</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Hours Of Support</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="13" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Service Providers</p>
                        </div>
                    </div><!-- End Stats Item -->

                </div>

            </div>

        </section><!-- /Stats Section -->

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Our Event Services</h2>
                <p>Explore the best experiences with our exceptional event services tailored to make your experience
                    unforgettable.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <!-- Check if there are services available -->
                @if ($services->isEmpty())
                    <p class="text-center">No services available.</p>
                @else
                    <div class="row">
                        @foreach ($services as $service)
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm border-light rounded position-relative">


                                    <div class="card-header p-0">
                                        @if ($service && !empty($service->image) && is_array($service->image))
                                            <img src="{{ asset(str_replace('public/', 'storage/', $service->image[0])) }}"
                                                alt="Service Image" class="card-img-top"
                                                style="height: 200px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('assets/img/default.png') }}" alt="Default Image"
                                                class="card-img-top" style="height: 200px; object-fit: cover;">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center fw-bold">{{ $service->title }}</h5>
                                        <p class="card-text"><strong>Description:</strong>
                                            {{ Str::limit($service->description, 20) }}</p>
                                        <p class="card-text"><strong>Location:</strong>
                                            {{ Str::limit($service->location, 20) }}</p>

                                        <div class="star-rating">
                                            @php
                                                $averageRating = $service->ratingsAndFeedback->avg('rating');
                                                $ratingCount = $service->ratingsAndFeedback->count();
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($averageRating))
                                                    <span class="fa fa-star checked"></span>
                                                @elseif ($i == ceil($averageRating) && $averageRating - floor($averageRating) >= 0.5)
                                                    <span class="fa fa-star-half-alt checked"></span>
                                                @else
                                                    <span class="fa fa-star"></span>
                                                @endif
                                            @endfor
                                            <span>({{ $ratingCount }}
                                                {{ Str::plural('rating', $ratingCount) }})</span>
                                        </div>

                                        <style>
                                            .star-rating .fa-star,
                                            .star-rating .fa-star-half-alt {
                                                font-size: 1.5em;
                                                color: #ddd;
                                            }

                                            .star-rating .fa-star.checked,
                                            .star-rating .fa-star-half-alt.checked {
                                                color: #f5b301;
                                            }
                                        </style>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between align-items-center">
                                        @auth
                                            <!-- View Details Button -->
                                            <a href="{{ route('client.service.show', $service->id) }}"
                                                class="btn btn-info btn-sm" <i class="fas fa-eye"></i> View Details
                                            </a>

                                            <!-- Book Service Button -->
                                            <a href="{{ route('client.service.show', $service->id) }}"
                                                class="btn btn-primary btn-sm" <i class="fas fa-calendar-check"></i> Book
                                                Service
                                            </a>
                                        @else
                                            <!-- Redirect to Login Button -->
                                            <a href="{{ route('login') }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>

                                            <!-- Redirect to Login Button -->
                                            <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-calendar-check"></i> Book Service
                                            </a>
                                        @endauth
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="bookingModal-{{ $service->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="bookingModalLabel-{{ $service->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="bookingModalLabel-{{ $service->id }}">Book
                                                        Service</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('client.bookings.store') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="event_service_id"
                                                            value="{{ $service->id }}">

                                                        <div class="form-group">
                                                            <label for="booking_date-{{ $service->id }}">Select
                                                                Booking
                                                                Date:</label>
                                                            <input type="date"
                                                                id="booking_date-{{ $service->id }}"
                                                                name="booking_date" class="form-control" required
                                                                @if ($service->status == 'unavailable') disabled @endif>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="notes-{{ $service->id }}">Additional
                                                                Notes:</label>
                                                            <textarea id="notes-{{ $service->id }}" name="notes" class="form-control" placeholder="Any special requests"
                                                                @if ($service->status == 'unavailable') disabled @endif></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            @if ($service->status == 'unavailable') disabled @endif>Book
                                                            Service
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endif
            </div>

        </section><!-- /Services Section -->


        <section id="contact" class="contact section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Contact</h2>
                <p>Get in touch with us for any inquiries or assistance.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4 g-lg-5">
                    <div class="col-lg-5">
                        <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                            <h3>Contact Info</h3>
                            <p>We are here to assist you with any questions or concerns you may have.</p>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="content">
                                    <h4>Our Location</h4>
                                    <p>Buguey, Cagayan</p>
                                    <p>Philippines</p>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon-box">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div class="content">
                                    <h4>Phone Number</h4>
                                    <p>+63 912 345 6789</p>
                                    <p>+63 987 654 3210</p>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                                <div class="icon-box">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="content">
                                    <h4>Email Address</h4>
                                    <p>info@bugueycagayan.com</p>
                                    <p>contact@bugueycagayan.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                            <h3>Get In Touch</h3>
                            <p>We are here to assist you with any questions or concerns you may have.</p>

                            <form action="forms/contact.php" method="post" class="php-email-form"
                                data-aos="fade-up" data-aos-delay="200">
                                <div class="row gy-4">

                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Your Name" required="">
                                    </div>

                                    <div class="col-md-6 ">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Your Email" required="">
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form-control" name="subject"
                                            placeholder="Subject" required="">
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                    </div>

                                    <div class="col-12 text-center">
                                        <div class="loading">Loading</div>
                                        <div class="error-message"></div>
                                        <div class="sent-message">Your message has been sent. Thank you!</div>

                                        <button type="submit" class="btn">Send Message</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">LESPMS</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Buguey, Cagayan</p>
                        <p>Philippines</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+63 912 345 6789</span></p>
                        <p><strong>Email:</strong> <span>info@bugueycagayan.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Event Planning</a></li>
                        <li><a href="#">Venue Selection</a></li>
                        <li><a href="#">Catering Services</a></li>
                        <li><a href="#">Entertainment</a></li>
                        <li><a href="#">Decoration</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Testimonials</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Gallery</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="#">Event Tips</a></li>
                        <li><a href="#">Planning Guide</a></li>
                        <li><a href="#">Vendor Directory</a></li>
                        <li><a href="#">Budget Calculator</a></li>
                        <li><a href="#">Event Checklist</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">LESPMS</strong> <span>All Rights
                    Reserved</span></p>
        </div>

    </footer>


    <!-- Bootstrap 4 JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>



    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/landing/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/landing/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/landing/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/landing/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/landing/vendor/purecounter/purecounter_vanilla.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/landing/js/main.js') }}"></script>

</body>

</html>
{{-- <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                    <a href="{{ url('/home') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif

    </div> --}}
