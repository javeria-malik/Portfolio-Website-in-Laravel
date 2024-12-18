<section class="ftco-section ftco-no-pb" id="resume-section">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-10 heading-section text-center ftco-animate">
                <h1 class="big big-2">Education</h1>
                <h2 class="mb-4">Education</h2>
                <p>I am a skilled backend developer with extensive experience in diverse backend technologies and programming languages.</p>
            </div>
        </div>
        <div class="row">
            @foreach ($educations as $education)
                <div class="col-md-6">
                    <div class="resume-wrap ftco-animate">
                        <span class="date">{{ $education->start_year }}-{{ $education->end_year }}</span>
                        <h2>{{ $education->degree }}</h2>
                        <span class="position">{{ $education->institution }}</span>
                        <p class="mt-4">{{ $education->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
