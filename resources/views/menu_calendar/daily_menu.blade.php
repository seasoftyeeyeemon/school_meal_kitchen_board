@extends('layouts.nav')
@php
$yearMonth =date('Y-m', strtotime($ym));
@endphp
@section('backLink'){{ route('menu.monthly_menu',$yearMonth,request()->query()) }}@endsection
@section('title')
    <title>献立メニューについて - 日単位</title>
@endsection
@push('custom_css')
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
@endpush
@push('custom_js')

    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
@endpush
@section('content')
    <?php
        use App\Menu;
        use App\Kondate2;
        use App\Ryouri2;
        use App\Syokuzai;
        use App\Kondate1;
        use App\Buono\Timezone;
        use App\Buono\Category;
    ?>
    <div class="menu_monthly_7var menu_daily_items">
        <div class="month_title">
            <div class="container d-flex align-items-center">
                <div class="month_change_div py-3">
                @php
                    $year = date('Y', strtotime($ym));    
                    $month = date('m', strtotime($ym.$day));
                    $current_year_month_day =date('Y-m-d', strtotime($ym.$day));
                    $current_year_month_day_with_no_dash =date('Ymd', strtotime($ym.$day));
                    $prev_year_month_day =date('Ymd', strtotime('-1 day', strtotime($ym.$day)));
                    $prev_day =date('d', strtotime('-1 day', strtotime($ym.$day)));
                    $next_year_month_day =date('Ymd', strtotime('+1 day', strtotime($ym.$day)));
                    $next_day =date('d', strtotime('+1 day', strtotime($ym.$day)));
                    $day_count = date('t', strtotime($ym)); 

                    $defaultOpts = array_merge([
                        'kondate_id'=>$id,
                        'day'=>$day,
                        'year_month'=>$ym
                        ], request()->query());

                    $timezone =intval(request()->get('timezone'));
                    $category=intval(request()->get('category'));

                    $prev_kondate =Kondate1::getKondate($prev_year_month_day,$timezone,$category);
                    $next_kondate =Kondate1::getKondate($next_year_month_day,$timezone,$category);

                    $prev_date =date('Y-m-d', strtotime('-1 day', strtotime($ym.$day)));
                    $next_date =date('Y-m-d', strtotime('+1 day', strtotime($ym.$day)));
                    
                    $status=1;
                    $prevdefaultOpts = array_merge([
                       'kondate_id'=>!is_null($prev_kondate) ?$prev_kondate->id :  $status=0,
                       'day'=>$prev_day,
                       'year_month'=>$ym
                   ], request()->query());

                   $nextdefaultOpts = array_merge([
                       'kondate_id'=>!is_null($next_kondate) ? $next_kondate->id :$status=0,
                       'day'=>$next_day,
                       'year_month'=>$ym
                   ], request()->query());

                   $currentDate = "$year-$month-" . str_pad($day, 2, 0, STR_PAD_LEFT);
                   $filterUrl = function($options) use($currentDate, $defaultOpts) {
                       $opts = array_merge(['yearMonth' => $currentDate], $options);
                       return route('menu.daily_menu', array_merge($defaultOpts, $opts));
                   }
               @endphp
                    @if($day == 1)                      
                       <a href="{{route('menu.daily_menu',array_merge($prevdefaultOpts))}}" style="display:none"><i class="fas fa-chevron-circle-left disable"></i></a>
                    @else
                    <a href="{{route('menu.daily_menu',$prevdefaultOpts)}}"><i class="fas fa-chevron-circle-left"></i></a>
                    @endif

                    <p class="mb-0">
                        <span>{{ $month }}月</span>
                        <span class="day">{{  $day }}日</span>
                        <span class="year">{{  $year }}年</span>
                    </p>
                    @if($day == $day_count)
                    <a href="{{route('menu.daily_menu',$nextdefaultOpts)}}" style="display:none"><i class="fas fa-chevron-circle-right"></i></a>

                    @else
                    <a href="{{route('menu.daily_menu',$nextdefaultOpts)}}"><i class="fas fa-chevron-circle-right"></i></a>
                    @endif
                </div>
                @php 
                use App\Buono\MenuPDF;
                $filename= MenuPDF::where('facility_id',auth()->user()->id)
                    ->where('date', $current_year_month_day)
                    ->first();
                   
                @endphp
                @if(isset($filename) && !empty($filename))
                <a data-toggle="modal" data-target="#myModal">
                    <img src="{{asset('img/new_icon/pict_pdf-dl.png')}}" alt="" style="width:30px; height:40px;">
                </a>
                @endif

                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-xl">

                        <!-- Modal content-->
                        <div class="modal-content" style="height: 1000px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">

                                <embed src="/getPDF/{{ $current_year_month_day }}" frameborder="0" width="100%" height="750px">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container food_age_div my-4">
            <div class="d-flex align-items-center foods mb-3">
                @foreach ($timezones as $key=>$value)
                <?php
                $status =Timezone::deleteOrNot($key);
                ?>
                @if($status)
                <a href="{{ $filterUrl(['timezone' => $key]) }}" class="btn {{request()->get('timezone') == $key ? 'active': ''}}">{{$value}}</a>
                @endif
                @endforeach
            </div>
            <div class="d-flex align-items-center age">
                @foreach($meal_types as $key=>$value)
                <?php
                $status =Category::deleteOrNot($key);
                ?>
                 @if($status)
                <a href="{{ $filterUrl(['category' => $key]) }}" class="btn {{request()->get('category') == $key ? 'active': ''}}">{{$value}}</a>
                @endif
                @endforeach
            </div>
            
        </div>
        <div class="container food_age_planner">
       
            <div class="food_age_daily_plan">
                <div class="row today_menu_div">
                    <div class="col-md-6 event_logo">
                        <figure>
                            @php
                            $menu =Menu::getMenu($current_year_month_day,$timezone,$category);
                            @endphp
                            @if(!empty($menu))
                            <img src="{{$menu->menu_image}}" alt="" class="w-100">
                            @else
                            <img src="{{$no_menu}}" alt="" class="w-100">
                            @endif
                        
                        </figure>
                    </div>
                    <div class="col-md-6 today_menu">
                        <p>今日の <br>
                            献立</p>
                        <ul class="list-unstyled w-100">
                            <?php
                        
                                $kondate_id =Kondate1::where('haizen_date',$current_year_month_day_with_no_dash)
                                ->where('timezone_id',$timezone)
                                ->first();
                                if (isset($kondate_id) && !empty($kondate_id)) {
                                    $kondate_two =Kondate2::where('kondate_1_id',$kondate_id->id)->get();   
                                }
                            ?>
                            @if(isset($kondate_two) && !empty($kondate_two))
                                @foreach($kondate_two as $one)
                                <li>{{ $one->name_1 }}</li>
                                <hr>
                                @endforeach
                            @endif  
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
        {{-- @php
            $count =count($kondate_two);
        @endphp --}}
        <div class="menu_slider mb-3">
                    
                    <div class="owl-carousel owl-theme">
                        @if(isset($kondate_two) && !empty($kondate_two))
                            @foreach($kondate_two as $one)
                                <?php
                                   
                                    $ryouri_image =App\Ryouri1::getDishImage($one->ryouri_id);
                                ?>
                                <div class="item"  style="padding-bottom: 32768px;margin-bottom:-32768px;">
                                    <a href="{{route('menu.single_item',$one->id)}}">
                                        <img 
                                            @if(isset($ryouri_image->img_1) && !empty($ryouri_image->img_1))
                                                src="/get-dishImage/{{ $one->ryouri_id }}" 
                                            @else
                                                src="{{$no_image}}"
                                            @endif
                                            alt="" style="height:180px;width: auto!important;margin-left: auto;margin-right: auto;">
                                    </a>
                                    <p class="mt-4">{{$one->name_1}}</p>
                                    <ul class="list-unstyled mb-0">
                                    <?php $allergies = $one->getAllergies();?>
        						        @if(count($allergies) > 0)
                                        @foreach($allergies as $key => $value)
        								@if( $value['status'] == 1)
                                        <li class="d-flex align-items-center mb-2">
                                            <img src="{{url('img/'.$key.'.png')}}" alt="" class="w-auto mr-2">
                                            <span>{{$value['title']}}</span>
                                        </li>
                                        @endif
                                        @endforeach
                                        @endif
                                    </ul>                           
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
        </div>
      
    
<script>
    @if(isset($kondate_two) && count($kondate_two) < 4)
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        nav: true,
        loop: false,
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
    @else
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
    @endif
    
</script>

@endsection
