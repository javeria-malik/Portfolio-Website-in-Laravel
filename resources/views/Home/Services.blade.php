<!-- resources/views/your-view-name.blade.php -->

<section class="ftco-section" id="services-section">
    <div class="container">
        <div class="row justify-content-center py-5 mt-5">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h1 class="big big-2">Services</h1>
                <h2 class="mb-4">Services</h2>
                <p>As a dedicated professional, I bring expertise in delivering tailored solutions that cater to your unique needs.</p>
            </div>
        </div>
        <div class="row">
            @foreach ($services as $service)
                <div class="col-md-4 text-center d-flex ftco-animate">
                    <a class="services-1">
                        <span class="icon">
                            <i class="{{ $service->icon_class }}"></i> <!-- Dynamically load the icon class -->
                        </span>
                        <div class="desc">
                            <h3 class="mb-5">{{ $service->title }}</h3> <!-- Dynamically load the title -->
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
