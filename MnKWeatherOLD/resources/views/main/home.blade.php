@extends('layouts.master')
@section('title','Home')
@section('content')
<div class="jumbotron" style="background:url('https://www.nasa.gov/sites/default/files/styles/ubernode_alt_horiz/public/thumbnails/image/smap-weather.jpg');background-repeat:no-repeat;
    background-size:100% 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card m-4 gradient-custom" style="border-radius: 25px;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-4 pb-2">
                            <div>
                                <h2 class="display-2"><strong>23°C</strong></h2>
                                <p class="text-muted mb-0">Coimbra, Portugal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
            
            </div>
            <div class="col-sm">
            
            </div>
        </div>
    </div>  
</div>
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h1>main page</h1>
        </div>

    </div>
</div>
<script>
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
    var reg = document.getElementById("home");
    reg.classList.add('active');                  
    reg.setAttribute("aria-current", "page");           
</script>
@endsection