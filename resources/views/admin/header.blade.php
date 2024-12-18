<header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            
            <form id="searchForm" action="#">
              <div class="form-group">
                <input type="search" name="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="index.html" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">MY</strong><strong>PORTFOLIO</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">J</strong><strong>M</strong></div></a>
            
            <!-- Tasks end-->
            <!-- Megamenu-->
    
              
              
            <!-- Log out     -->         
<form method="POST" action="{{ route('logout') }}" style="display: inline;">
    @csrf
    <button type="submit" class="btn btn-danger" style="padding: 8px 15px; font-size: 14px;">
        Logout
    </button>
</form>


          </div> 
        </div>
      </nav>
    </header>
    