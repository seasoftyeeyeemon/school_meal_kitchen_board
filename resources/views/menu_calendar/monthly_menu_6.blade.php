@extends('layouts.nav')
@section('title')
    <title>献立メニューについて - 月単位画面（6日ver.）</title>
@endsection
@push('custom_css')
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/yym.css')}}">
@endpush
@push('custom_is')
    <link rel="stylesheet" href="{{asset('js/all.js')}}">
@endpush
@section('content')
    <div class="menu_monthly_7var">
        <div class="month_title">
            <div class="container d-flex align-items-center">
                <div class="month_change_div py-3">
                    @php
                        $defaultOpts = array_merge([
                            'category' => 3,
                            'timezone' => 233,
                        ], request()->query());
                        $prevMonth = $month == 1 
                            ? $year - 1 . "-12"
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
                    <a href="{{route('menu.monthly_menu', array_merge($defaultOpts,['yearMonth' => $prevMonth]))}}"><i class="fas fa-chevron-circle-left"></i></a>
                    <p class="mb-0">
                        <span>{{str_pad($month, 2, 0, STR_PAD_LEFT)}}月</span>
                        <span>{{$year}}年</span>
                    </p>
                    <a href="{{route('menu.monthly_menu', array_merge($defaultOpts, ['yearMonth' => $nextMonth]))}}"><i class="fas fa-chevron-circle-right"></i></a>
                </div>
                <a href="#"><img src="{{asset('img/pdfIcon.png')}}" alt=""></a>
            </div>
        </div>
        <div class="container food_age_div my-4">
            <div class="d-flex align-items-center foods mb-3">
                <a href="{{ $filterUrl(['timezone' => '233']) }}" class="btn {{request()->get('timezone', 233) == 233 ? 'active': ''}}">朝おやつ</a>
                <a href="{{ $filterUrl(['timezone' => '231']) }}" class="btn {{request()->get('timezone', 233) == 231 ? 'active': ''}}">昼食</a>
                <a href="{{ $filterUrl(['timezone' => '232']) }}" class="btn {{request()->get('timezone', 233) == 232 ? 'active': ''}}">午後おやつ</a>
            </div>
            <div class="d-flex align-items-center age">
                <a href="{{ $filterUrl(['category' => '3']) }}" class="btn {{request()->get('category', 3) == 3 ? 'active': ''}}">3歳未満時</a>
                <a href="{{ $filterUrl(['category' => '140']) }}" class="btn {{request()->get('category', 3) == 140 ? 'active': ''}}">3歳以上児</a>
                <a href="{{ $filterUrl(['category' => '4']) }}" class="btn {{request()->get('category', 3) == 4 ? 'active': ''}}">職員</a>
               
            </div>
        </div>
        <div class="container food_age_planner">
            @php
            if(request()->get('timezone')==233){
                $timezone ="朝おやつ";
                
            }else if(request()->get('timezone')==231){
                $timezone ="昼食";
            }else{
                $timezone ="午後おやつ";
            }
            if(request()->get('category')==3){
                $category ="3歳未満時";
            }else if(request()->get('category')==140){
                $category ="3歳以上児";
            }else{
                $category ="職員";
            }
            @endphp
            <h3 class="text-center my-5">{{$timezone}}<span style="margin-left:10px;"></span>( {{$category}} ( 幼稚園 ) )</h3>
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
   
@endsection
