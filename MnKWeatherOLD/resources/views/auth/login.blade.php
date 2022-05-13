@extends('layouts.master')
@section('title','Home')
@section('content')
    <div class='container'>
        <div class='col-md-12 p-4 d-flex align-items-center justify-content-center'>
            <div class="card" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <div class='col-md-12 align-items-center justify-content-center' display="inline-block">
                        <h2 class="text-center m-5" ">Login</h2>
                        @if($errors->any())
                        <div class="text-danger mt-2 text-sm">{{$errors->first('message')}}</div> 
                        @endif
                    </div>
                    <div class="col-md-12 d-flex flex-column align-items-center justify-content-center">
                        <form class="" action="{{route("login")}}" method="post">  
                            @csrf     
                            <div class="form-outline mb-4">
                                <input class="form-control form-control-lg" type="text" name="username" id="username"
                                placeholder="Your username" value="{{old('username')}}"/>
                                @error("username") 
                                <div class="text-danger mt-2 text-sm">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-outline mb-4">
                                <input class="form-control form-control-lg" type="password" name="password" id="password" 
                                placeholder="Enter your password"/> 
                                @error("password") 
                                <div class="text-danger mt-2 text-sm">{{$message}}</div>
                                @enderror     
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Log In</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script current="login">
    var tableFields = document.getElementById("navbarButtonsDiv");
    var children = tableFields.children;
    for (var i = 0; i < children.length; i++) {
        var element = children[i];
        if(element.classList.contains("active"))
        {
            element.classList.remove('active');
            element.setAttribute("aria-current","none");
            break;
        }
    }
    var reg = document.getElementById("login");
    reg.classList.add('active');                  
    reg.setAttribute("aria-current", "page");  
</script>
@endsection