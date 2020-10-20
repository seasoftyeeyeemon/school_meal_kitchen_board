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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ml-sm-3 mx-auto">
            <a class="nav-link" href="#">
              <img src="{{asset('img/new_icon/pict_callendar.png')}}" alt="calendar">
            </a>
          </li>
          <li class="nav-item ml-sm-2 mx-auto">
            <a class="nav-link" href="#">
              <img src="{{asset('img/new_icon/pict_stock.png')}}" alt="stock">
            </a>
          </li>
          <li class="nav-item ml-sm-2 mx-auto">
            <a class="nav-link" href="#">
              <img src="{{asset('img/new_icon/pict_order.png')}}" alt="order">
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
              <img src="{{asset('img/new_icon/pict_chat.png')}}" alt="chat" />
            </a>
          </li>
        </ul>
     
      </div>
    </nav>
    <div class="page-wrapper">
      <div class="banner-page">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-sm-12 banner-wrapper">
              <a href="{{route('menu.monthly_menu',$today->format('Y-m'))}}" class="banner one">
                <img class="banner-img" src="img/pict_calendar_large.png" alt="calender">
                <span class="banner-text">献立
                カレンダー</span>
              </a>
          
              <a href="#" class="banner two">
                <img class="banner-img" src="img/pict_stock_large.png" alt="stock">
                <span class="banner-text">在庫管理</span>
              </a>
            
              <a href="#" class="banner three">
                <img class="banner-img" src="img/pict_order_large.png" alt="order">
                <span class="banner-text">発注管理</span>
              </a>
            </div>
          </div>
        </div>

        <div class="banner-footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-7 d-flex justify-content-end">
                <img class="mr-4 banner-footer-img banner-footer-img_1" src="img/footer-pict01.png" alt="footer imge">
             
                <img class="mr-4 banner-footer-img banner-footer-img_2" src="img/footer-pict02.png" alt="footer imge">
              
                <img class="mr-4 banner-footer-img banner-footer-img_3" src="img/footer-pict03.png" alt="footer imge">
              </div>
              
              <div class="col-5">
                <img class="ml-5 pl-2 banner-footer-img banner-footer-img_4" src="img/footer-pict04.png" alt="footer imge">
              </div>
            </div>
          </div>
        </div>
          
      </div>
    </div>
</body>
</html>
   