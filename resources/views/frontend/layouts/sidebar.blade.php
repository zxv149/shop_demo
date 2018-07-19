<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
        <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
        <a href="{{ route('home') }}"><h3 class="w3-wide"><b>LOGO</b></h3></a>
    </div>

    <i class="fa fa-search"></i>
    <form id="logout-form" action="{{ route('product.search') }}" method="GET">
        <input class="form-control" type="text" name="word" value="{{ Request::get('word') }}">
    </form>

    <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
        @foreach($menus as $category)
            <a href="{{ route('category.show', $category->id) }}" class="w3-bar-item w3-button">{{ $category->title }}</a>
        @endforeach
            <a href="{{ route('category.show', 0) }}" class="w3-bar-item w3-button">Others</a>
    </div>
    <a href="#footer" class="w3-bar-item w3-button w3-padding">Contact</a>
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding" onclick="document.getElementById('newsletter').style.display='block'">Newsletter</a>
    <a href="#footer"  class="w3-bar-item w3-button w3-padding">Subscribe</a>
</nav>


<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
    <div class="w3-bar-item w3-padding-24 w3-wide">LOGO</div>
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
