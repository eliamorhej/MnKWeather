<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" >MnK Weather</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav" id="navbarButtonsDiv">
      <a id="home" class="nav-link active" href="{{ route('home') }}">Home</a>
        @if (auth()->user())
        <!-- if a link, would be vulnerable to csrf.
        we make it a post so that the user cant be logged out simply by entering a link-->
        <form id="logout" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-dark">Logout</button>
        </form>        
        @else
          <a id="register" class="nav-link" href="{{ route('register') }}">Register </a>
          <a id="login" class="nav-link" href="{{ route('login') }}">Log In</a>
          
        @endif
      </div>
    </div>
    <form class="d-flex" action="{{ route('search') }}" method="post" >
    <select id="searchOption" name="searchOption">  
        <option value = "City"> City   
        </option>  
        <option value = "Country"> Country   
        </option>  
        <option value = "Zip Code"> Zip Code  
        </option>  
      </select>
    @csrf
      @error("search") 
      <div class="text-danger mt-2 text-sm">{{$message}}</div>
      @enderror 
      <input id="search" name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
      
    </form>
  </div>
</nav>
    @yield('content')

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>