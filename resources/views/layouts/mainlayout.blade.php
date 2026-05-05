<!DOCTYPE html>
<html lang="en">




  @include('layouts.partials.head')






<body>
  

    <div id="app">
      

  @include('layouts.partials.header')

    <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>



  @yield('content')



  @include('layouts.partials.footer')

     </div>
    </div>
  @include('layouts.partials.footer-scripts')



</body>

</html>