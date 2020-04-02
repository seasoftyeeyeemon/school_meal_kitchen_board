<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @stack('custom_css')

    @stack('custom_js')
    @yield('title')
  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-navbar-custom">
      <button class="back-btn" onclick="goBack()"><i class="fas fa-angle-left fa-2x"></i></button>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ml-sm-3 mx-auto">
            <a class="nav-link" href="/monthly_menu/2020-03">
              <img src="{{asset('img/pict_calendar.png')}}" alt="calendar">
            </a>
          </li>
          <li class="nav-item ml-sm-2 mx-auto">
            <a class="nav-link" href="#">
              <img src="{{asset('img/pict_stock.png')}}" alt="stock">
            </a>
          </li>
          <li class="nav-item ml-sm-2 mx-auto">
            <a class="nav-link" href="#">
              <img src="{{asset('img/pict_order.png')}}" alt="order">
            </a>
          </li>
         
        </ul>
        <ul class="navbar-nav mx-auto d-none d-sm-block navbar-title">
          <li class="nav-item">
            <a class="nav-link text-white navbar-title-link" href="#">
              給食室ボードカレンダー
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-auto">
            <a class="nav-link" href="#">
              <img src="{{asset('img/pict_chat.png')}}" alt="chat" />
            </a>
          </li>
        </ul>
     
      </div>
    </nav>
    <script>
      function goBack() {
        window.history.go(-1);
      }
    </script>
    @yield('content')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
  </body>
</html>