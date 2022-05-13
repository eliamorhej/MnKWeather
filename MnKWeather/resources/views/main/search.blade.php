@extends('layouts.master')
@section('title','Home')
@section('content')
<div class='container'>
    
    <h1 class="text-center m-5" >Search Results</h1> 
    @php
        if(!$sr)
        {
            echo("<div>no results</div>");
        }
        foreach($sr as $result)
        {
            echo('  
            <div class="row">
            <h2>'.$result["name"].', '.(isset($result["country"])?$result["country"]:" ").'</h2>
            <div class="col-md-3">
                temperature: '.$result["main"]["temp"].'C
            </div>'.'<div class="col-md-3">humidity: '.$result["main"]["humidity"].'%</div></div>');
            
            echo("<div class='col-md-3'><a href=".'/pin/'.$result['id'].">Home</a></div>");
            echo("</br>");
        }
    @endphp
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
</script>
@endsection


