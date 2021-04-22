<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="{{ url('/') }}">LOGO
        {{-- <img src="./img/logo/logo.png" alt="logo_ale"> --}}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" id="hamburger-menu-button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::route()->getName() == 'homepage' ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::route()->getName() == 'dress.create' ? 'active' : '' }}" href="{{ route('dress.create') }}">Crea</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::route()->getName() == 'dress.index' ? 'active' : '' }}" href="{{ route('dress.index') }}">Le tue t-shirt</a>
            </li>
        </ul>
    </div>
</nav>
<script type="text/javascript">
// hamburger menu
let isOpen = false;
document.getElementById('hamburger-menu-button').addEventListener("click", function() {
    isOpen =! isOpen;
    // console.log(isOpen);
    if (isOpen) {
        document.getElementById('navbarNavDropdown').className += " show";
    } else {
        // document.getElementById('navbarNavDropdown').className += "";
        document.getElementById('navbarNavDropdown').className = "collapse navbar-collapse";

    }

}, false);
</script>
