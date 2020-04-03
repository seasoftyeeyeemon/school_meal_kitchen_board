@extends('layouts.nav')
@section('title')
    <title>献立メニューについて - 日単位</title>
@endsection
@push('custom_css')
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
@endpush
@push('custom_js')
    <script src="{{asset('js/all.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endpush
@section('content')
    <?php
        use App\Kondate2;
        use App\Ryouri2;
        use App\Syokuzai;
    ?>
    <div class="menu_monthly_7var menu_daily_items">
        <div class="month_title">
            <div class="container d-flex align-items-center">
                <div class="month_change_div py-3">
                    @php
                        $defaultOpts = array_merge([
                            'category' => 3,
                            'timezone' => 233,
                        ], request()->query());
                        
                        $timestamp = strtotime($ym .'-'.$day);
                        if ($timestamp === false) {                                      
                            $timestamp = time();
                        }
                        $day_count = date('t', $timestamp);
                        $year =date('Y',$timestamp);
                        $month =date('m',$timestamp);
                        if($day_count ==30){
                            
                        }
                        $prevMonth = $day == 30
                            ? $month - 1 . "-30"
                            : "$year-" . str_pad($month - 1, 2, 0, STR_PAD_LEFT);
                        $nextMonth = $month == 12
                            ? $year + 1 . "01"
                            : "$year-" . str_pad($month + 1, 2, 0, STR_PAD_LEFT);
                        $currentMonth = "$year-" . str_pad($month, 2, 0, STR_PAD_LEFT);

                        $filterUrl = function($options) use($currentMonth, $defaultOpts) {
                            $opts = array_merge(['yearMonth' => $currentMonth], $options);
                            return route('menu.monthly_menu', array_merge($defaultOpts, $opts));
                        }
                        
                    
                    @endphp
                    <a href="#"><i class="fas fa-chevron-circle-left"></i></a>
                    <p class="mb-0">
                        <?php
                            $date =explode('-',$ym) ;                
                        ?>

                        <span>{{$date[1]}}月</span>
                        <span class="day">{{$day}}日</span>
                        <span class="year">{{$date[0]}}年</span>
                    </p>
                    <a href="#"><i class="fas fa-chevron-circle-right"></i></a>
                </div>
                <a href="#"><img src="img/pdfIcon.png" alt=""></a>
            </div>
        </div>
        
        <div class="container food_age_div my-4">
            <div class="d-flex align-items-center foods mb-3">
                <a href="#" class="btn {{$timezone_id == 233 ? 'active': ''}}">朝おやつ</a>
                <a href="#" class="btn {{$timezone_id == 231 ? 'active': ''}}">昼食</a>
                <a href="#" class="btn {{$timezone_id== 232 ? 'active': ''}}">午後おやつ</a>

            </div>
            <div class="d-flex align-items-center age">
                <a href="#" class="btn {{$category_id == 3 ? 'active': ''}}">3歳未満時</a>
                <a href="#" class="btn {{$category_id == 140 ? 'active': ''}}">3歳以上児</a>
                <a href="#" class="btn {{$category_id == 4 ? 'active': ''}}">職員</a>
            </div>
        </div>
        <div class="container food_age_planner">
        @php
            if($timezone_id==233){
                $timezone ="朝おやつ";
                
            }else if($timezone_id==231){
                $timezone ="昼食";
            }else{
                $timezone ="午後おやつ";
            }
            if($category_id==3){
                $category ="3歳未満時";
            }else if($category_id==140){
                $category ="3歳以上児";
            }else{
                $category ="職員";
            }
        @endphp
            <h3 class="text-center my-5">{{$timezone}}（ {{$category}}（幼稚園））</h3>
            <div class="food_age_daily_plan">
                <div class="row today_menu_div">
                    <div class="col-md-6 event_logo">
                        <figure>
                            <img src="{{$menu_image->img_1 ? $menu_image->img_1 : $no_image}}" alt="" class="w-100">
                            <figcaption>イベント<br>
                                ロゴ</figcaption>
                        </figure>
                    </div>
                    <div class="col-md-6 today_menu">
                        <p>今日の <br>
                            献立</p>
                        <ul class="list-unstyled w-100">
                        @foreach($kondate_2 as $one)
                           <li>{{$one->name_1}}</li>
                           <hr>
                        @endforeach  
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="menu_slider mb-3">
                    <div class="owl-carousel owl-theme">
                        @foreach($kondate_2 as $one)

                        <div class="item">
                            <a href="{{route('menu.single_item',$one->id)}}">
                                <img src="{{$one->img_1? $one->img_1 : $no_image}}" alt="" class="w-100">
                            </a>
                            <p class="mt-2">{{$one->name_1}}</p>
                            <ul class="list-unstyled mb-0">
                                @foreach(Ryouri2::getRyouri2($one->ryouri_id) as $one_shokuzai_id)
                                <?php
                                $shokuzai=new Syokuzai();
                                $allergie_infos =$shokuzai->getAllergies($one_shokuzai_id);
                                ?>
                                
                               @if(count($allergie_infos) > 0)
                               @foreach ($allergie_infos as $key=>$value)
                               @if($value['status'] == 1)
                                <li class="d-flex align-items-center mb-2">
                                    <img src="{{url('img/'.$key.'.png')}}" alt="" class="w-auto mr-2">
                                    <span>{{$value['title']}}</span>
                                </li>
                                @endif

                               @endforeach
                               @endif
                               @endforeach
                            </ul>                           
                        </div>
                         @endforeach
                    </div>
                </div>
        </div>


<script>

      var owl = $('.owl-carousel');
      owl.owlCarousel({
        nav: true,
        loop: true,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          1000: {
            items: 4
          }
        }
      })
    
</script>

@endsection