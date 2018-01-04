<!DOCTYPE html>
<html lang="en">
@include('partials._head')

<body>

@include('partials._nav')
    
    <div class="container">
       
        @yield('content')

        @include('partials._footer')
    </div> <!--End of .container -->  
        @include('partials._javascript')
</body>
</html>