@extends('layouts.master')
@section('title','Home')
@section('content')
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h1>register</h1>
        </div>

    </div>
</div>
<script current="register">
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
    var reg = document.getElementById("register");
    reg.classList.add('active');                  
    reg.setAttribute("aria-current", "page");  
         
</script>
@endsection