<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
  <script src="jscript/calendar.js" defer></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="/css/mystyle.css">
    <!-- <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Vežimėlių nuoma</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<ul class="navbar-nav ms-auto">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a> -->

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
</div>
</div>
</nav>
    <div class="nav_bar">
        <header>
            <img class="logo_pic" src="/images/301220021_519483296798508_1235047204078362737_n.jpg" alt="">
            <!-- <ul>
                <li>
                    <a href="#">Kontaktai</a>
                </li>
                <li>
                    <a href="#">Nuoma</a>
                </li>
                <li class="li_right">
                    <a href="#">Apie</a>
                </li>
            </ul> -->
        </header>

    </div>
        <div class="main">
            <div class="carousel_pic">
                <img class="carousel_vezim" src="/images/61214232_685469581887804_3222479632515203072_n.jpg" alt="">
            </div>

            <!-- <div id="form_uzsakymo" class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"></span>
                <input type="text" class="form-control" placeholder="Vardas Pavardė" aria-label="Username" aria-describedby="basic-addon1">
              </div>

              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="pvz@pvz.lt" aria-label="Recipient's username" aria-describedby="basic-addon2">

              </div>


              <div class="input-group mb-3"> -->
                <!-- <span class="input-group-text" id="basic-addon3">https://example.com/users/</span> -->

                <!-- <input type="date" class="form-control" id="basic-url"
                aria-describedby="basic-addon3">

              </div>
              <div class="input-group mb-3"> -->
                <!-- <span class="input-group-text" id="basic-addon3">https://example.com/users/</span> -->

                <!-- <input type="time" class="form-control" id="basic-url"
                aria-describedby="basic-addon3"> -->

              <!-- </div>

              <div class="input-group mb-3">
                <span class="input-group-text">$</span>
                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                <span class="input-group-text">.00</span>
              </div>

              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Username" aria-label="Username"> -->
                <!-- <span class="input-group-text">@</span> -->
                <!-- <input type="text" class="form-control" placeholder="" aria-label="Server"> -->
              <!-- </div>

              <div class="input-group">
                <span class="input-group-text">Komentaras:</span>
                <textarea class="form-control" aria-label="With textarea"></textarea>
              </div>
              <div class="input-group mb-3"> -->
                <!-- <span class="input-group-text" id="basic-addon3">https://example.com/users/</span> -->

                <!-- <input type="submit" class="form-control" id="basic-url"
                aria-describedby="basic-addon3">

              </div> -->
        </div>
        <footer>

          <div class="fa_social">

          <a href="https://www.facebook.com/vezimeliunuomakelionems" class="fa fa-facebook"></a>
          <a href="#" class="fa fa-skype"></a>
          <a href="#" class="fa fa-instagram"></a>

        </div>
        <div class="copyright">
        <p class="copyright-text">Copyright &copy; 2023 All Rights Reserved by Viktoras :)
        </div>
        </footer>



</body>
</html>
