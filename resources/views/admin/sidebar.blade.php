
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="admincss/img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Javeria Malik</h1>
            <p>Laravel Developer</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="active"><a href="http://127.0.0.1:8000/"> <i class="icon-home"></i>Home </a></li>
                <!--<li><a href="tables.html"> <i class="icon-grid"></i>About Me</a></li> -->
                <li><a href="{{ route('educations.index') }}"> <i class="fa fa-bar-chart"></i>Educations</a></li>
                <li><a href="{{ route('experiences.index') }}"> <i class="icon-padnote"></i>Experiences</a></li>
                <li><a href="{{ route('services.index') }}"> <i class="icon-padnote"></i>Services</a></li>
                <li><a href="{{ route('skills.index') }}"> <i class="icon-padnote"></i>Skills</a></li>
                <li><a href="{{ route('projects.index') }}"> <i class="icon-padnote"></i>Projects</a></li>
                
                
        
      </nav>
      <!-- Sidebar Navigation end-->