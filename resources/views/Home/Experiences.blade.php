<section class="ftco-section ftco-no-pb" id="resume-section">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-10 heading-section text-center ftco-animate">
                <h1 class="big big-2">Experiences</h1>
                <h2 class="mb-4">Experiences</h2>
                <p>I am a skilled backend developer with extensive experience in diverse backend technologies and programming languages.</p>
            </div>
        </div>
        
        <div class="row">
            @foreach ($experiences as $experience)
                <div class="col-md-6">
                    <div class="resume-wrap ftco-animate">
                        <span class="date">{{ $experience->start_date }} - {{ $experience->end_date ?? 'Present' }}</span>
                        <h2>{{ $experience->title }}</h2>
                        <span class="position">{{ $experience->company }}</span>
                        <p class="mt-4">{{ $experience->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
