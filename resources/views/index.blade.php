@extends('layouts.nav')
@section('title')
  <title>トップ</title>
@endsection
@section('content')
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
@endsection
   