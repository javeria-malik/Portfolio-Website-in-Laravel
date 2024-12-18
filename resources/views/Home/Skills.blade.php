<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills</title>
    <style>
        .progress-wrap {
            margin-bottom: 20px;
        }
        .progress {
            height: 20px;
            background: #f0f0f0;
            border-radius: 5px;
            overflow: hidden;
        }
        .progress-bar {
            height: 100%;
            text-align: center;
            line-height: 20px;
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
        }
        .color-1 { background-color: #3498db; }
        .color-2 { background-color: #2ecc71; }
        .color-3 { background-color: #e74c3c; }
        .color-4 { background-color: #9b59b6; }
        .color-5 { background-color: #f1c40f; }
        .color-6 { background-color: #34495e; }
    </style>
</head>
<body>
    <section class="ftco-section ftco-no-pb" id="skills-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-10 heading-section text-center">
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
</body>
</html>
