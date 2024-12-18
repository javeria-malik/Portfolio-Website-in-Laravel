<section class="ftco-section" id="skills-section">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 heading-section text-center">
                <h1 class="big big-2">Skills</h1>
                <h2 class="mb-4">My Skills</h2>
                <p>I have developed a diverse skill set to deliver innovative and efficient solutions.</p>
            </div>
        </div>
        <div class="row">
            @foreach ($skills as $index => $skill)
                <div class="col-md-6">
                    <div class="progress-wrap">
                        <h3>{{ $skill->title }}</h3>
                        <div class="progress">
                            <div class="progress-bar color-{{ ($index % 6) + 1 }}" 
                                 role="progressbar" 
                                 aria-valuenow="{{ $skill->percentage }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100" 
                                 style="width: {{ $skill->percentage }}%;">
                                <span>{{ $skill->percentage }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
