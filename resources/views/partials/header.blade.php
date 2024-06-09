<header class="shadow-sm">
    <nav id="main-navbar" class="navbar navbar-expand-lg">
    <!-- Container wrapper -->
        <div class="container-fluid">

            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex flex-row">

                <li class="nav-item">
                    <a class="nav-link me-3 me-lg-0" href="#">
                        <i class="fas fa-bell"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">
                            1
                        </span>
                    </a>
                </li>

                <!-- Icon -->
                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link" href="https://github.com/danielbosa">
                    <i class="fab fa-github"></i>
                    </a>
                </li>
                <li class="nav-item">
                    {{-- SPIEGAZIONE
                        Questa a gestisce il logout; ma il logout non reindirizza ad un url semplicemente, deve usare metodo POST --> quindi inserisco un form che verrà submittato dal click sull'a.
                        Al click, innanzitutto blocco l'evento; poi vado a dirgli quale evento fare: prendo il form e lo submitto.--}}
                    <a class="nav-link me-3 me-lg-0" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" title="Logout">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="userProfile" role="button">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                        <img class="img-profile rounded-circle" src="/images/logoDB.png">
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>