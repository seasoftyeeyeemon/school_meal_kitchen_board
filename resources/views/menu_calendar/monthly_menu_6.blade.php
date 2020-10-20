@section('backLink'){{ route('index') }}@endsection
@extends('layouts.nav')
@section('title')
    <title>献立メニューについて - 月単位画面（6日ver.）</title>
@endsection
@push('custom_css')
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
@endpush
@push('custom_js')
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
   
@endpush
@section('content')
    @php
        use App\Buono\Timezone;
        use App\Buono\Category;
    @endphp
    <div class="menu_monthly_7var">
        <div class="month_title">
            <div class="container d-flex align-items-center">
                <div class="month_change_div py-3">

                    @php
                        $defaultOpts = array_merge([
                            'category' => $category_id,
                            'timezone' => $timezone_id,
                        ], request()->query());
                        $prevMonth = $month == 1 
                            ? $year - 1 . "-12"
                            : "$year-" . str_pad($month - 1, 2, 0, STR_PAD_LEFT);

                        $nextMonth = $month == 12
                            ? $year + 1 . "-01"
                            : "$year-" . str_pad($month + 1, 2, 0, STR_PAD_LEFT);
                        $currentMonth = "$year-" . str_pad($month, 2, 0, STR_PAD_LEFT);
                        $filterUrl = function($options) use($currentMonth, $defaultOpts) {
                            $opts = array_merge(['yearMonth' => $currentMonth], $options);
                            return route('menu.monthly_menu', array_merge($defaultOpts, $opts));
                        }
                    @endphp
                    <a href="{{route('menu.monthly_menu', array_merge($defaultOpts,['yearMonth' => $prevMonth]))}}"><i class="fas fa-chevron-circle-left"></i></a>
                    <p class="mb-0">
                        <span>{{str_pad($month, 2, 0, STR_PAD_LEFT)}}月</span>
                        <span>{{$year}}年</span>
                    </p>
                    <a href="{{route('menu.monthly_menu', array_merge($defaultOpts, ['yearMonth' => $nextMonth]))}}"><i class="fas fa-chevron-circle-right"></i></a>
                </div>
                @php 
                use App\Tayori;
                $month_without_zero = ltrim($month, "0");
                $pdf =Tayori::getMenuPdf($year,$month_without_zero);
               	$pdfExist = false;
		        $pdfUrl = 'https://pro.kids-meal.jp/meal_newsletter/pdf/' .$year.'/' .$month . '/' .$pdf;
                if($pdf) { 
                    $pdfHeaders = get_headers($pdfUrl);
                   
                    $pdfExist = strpos($pdfHeaders[0], '404') > -1 ? false : true;
                }
                @endphp
                @if(isset($pdf) && !empty($pdf) && $pdfExist)
                <a href="{{$pdfUrl}}" data-toggle="modal" data-target="#myModal"><img src="{{asset('img/new_icon/pict_pdf-dl.png')}}" alt="" style="width:30px; height:40px;"></a>
                @endif
            </div>
            @if($pdf && $pdfExist)
            <div id="myModal" class="modal fade" role="dialog"> 
                    <div class="modal-dialog modal-xl">

                        <!-- Modal content-->
                        <div class="modal-content" style="height: 1200px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">

                                <embed src="{{$pdfUrl}}" frameborder="0" width="100%" height="750px">
                            </div>

                        </div>
                    </div>
	    </div>
            @endif
        </div>
        <div class="container food_age_div my-4">
            <div class="d-flex align-items-center foods mb-3">
                @foreach ($timezones as $key=>$value)
                <?php
                    $status =Timezone::deleteOrNot($key);
                ?>
                @if($status)
                <a href="{{ $filterUrl(['timezone' => $key]) }}" class="btn {{request()->get('timezone',$timezone_id) == $key ? 'active': ''}}">{{$value}}</a>
                @endif
                @endforeach
            </div>
            <div class="d-flex align-items-center age">
                @foreach($meal_types as $key=>$value)
                <?php
                    $status =Category::deleteOrNot($key);
                ?>
                @if($status)
                <a href="{{ $filterUrl(['category' => $key]) }}" class="btn {{request()->get('category', $category_id) == $key ? 'active': ''}}">{{$value}}</a>
                @endif
               @endforeach
            </div>
        </div>
        <div class="container-fluid food_age_planner">
        <?php
            $timezone_name =Timezone::getTimeZoneName($timezone_id);
            $category_name =Category::getCategoryName($category_id);
            foreach($timezones as $key=>$value){
               
                if(request()->get('timezone')== $key){
                    $timezone_name =$value;
                
                }
            }

            foreach($meal_types as $key=>$value){
                if(request()->get('category')== $key){
                    $category_name =$value;
                
                }
            }
        ?>
    
            <h3 class="text-center my-5">{{$timezone_name}}（{{$category_name}}（{{$kinder_name->name}}））</h3>
            <ul class="list-unstyled date_list row mb-5">
                <li class="col"><span> 月 </span></li>
                <li class="col"><span> 火 </span></li>
                <li class="col"><span> 水 </span></li>
                <li class="col"><span> 木 </span></li>
                <li class="col"><span> 金 </span></li>
                <li class="col"><span> 土 </span></li>
                <li class="col"><span> 日 </span></li>
            </ul>
            @foreach($weeks as $week)
                {!! $week !!}
            @endforeach
        </div>
    </div>
    <script>
          $(window).scroll(function() {
          if ($(this).scrollTop() > 285) {
            $(".date_list").addClass("fix_menu");
             $(".food_age_planner").css({'padding-top': '50px'})
          } else {
            $(".date_list").removeClass("fix_menu");
            $('.food_age_planner').removeAttr('style');
          }
        });
    </script>
@endsection
