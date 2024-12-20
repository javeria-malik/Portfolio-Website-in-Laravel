<section class="ftco-section ftco-project" id="projects-section">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h1 class="big big-2">Projects</h1>
                <h2 class="mb-4">Our Projects</h2>
                <p>Explore our latest projects!</p>
            </div>
        </div>
        <div class="row">
            @foreach ($projects as $project)
                <div class="col-md-4">
                    <div class="project img ftco-animate d-flex justify-content-center align-items-center"
                        style="background-image: url('{{ asset($project->image) }}');">
                        <div class="overlay"></div>
                        <div class="text text-center p-4">
                            <h3><a href="#">{{ $project->title }}</a></h3>
                            <span>{{ $project->category }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
