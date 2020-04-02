@extends('layouts.nav')
@section('title')
  <title>献立メニューについて - 単品</title>
@endsection
@push('custom_js')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endpush

<?php
  use App\Syokuzai;
?>
@section('content')
    <div class="page-wrapper">
      <div class="menu-single-item-page">
        <div class="menu-single-item-title">鮭の塩焼き</div>
        <div class="container-fluid">
          <div class="row mt-4">
            <!-- <div class="col-6">
              <img class="img-fluid w-100" src="{{$ryouri_image->img_1? $ryouri_image->img_1 : $no_image}}" alt="meal">
            </div> -->
            <div class="col-lg-6 col-md-12 col-sm-6 single-dish">
              <img class="img-fluid w-100" src="{{$ryouri_image->img_1? $ryouri_image->img_1 : $no_image}}" alt="meal">
            </div>
            <div class="col-6 ipad-hidden">          
              @if(!empty($instructions))
                @php
                  for($i=6;$i<=60;$i++){
                    $tejyun = 'tejyun_'.$i;
                @endphp
                @if(!is_null($instructions->$tejyun))
                  @php
                    $data []=[$i];
                  @endphp
                  <div class="procedure">
                    <div class="procedure-label">手順 <span>{{count($data)}}</span></div>
                    <span class="detail">{{$instructions->$tejyun}}</span>
                  </div>
                @endif
                @php                
                  }
                @endphp              
             @endif
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-12">
              <div class="display-items">
                <h4> アレルギー表示項目（タップして詳細表示）</h4>
                @foreach($calories as $calorie)
                @foreach($calorie as $allergie)
                  <?php
                  $syokuzai =new Syokuzai();
                  $allergies_infos =$syokuzai->getAllergies($allergie['id']);
                  
                  ?>
                  @if(count($allergies_infos) > 0)
                   
                   <ul class="display-items-list">
                   @foreach ($allergies_infos as $key=>$value)
                   @if($value['status']==1)
                     <li class="item">
                       <img src="{{url('img/'.$key.'.png')}}" alt="allergie">
                       <span>{{$value['title']}}</span>
                     </li>
                   @endif 

                   @endforeach
                   </ul>
                 @endif
                @endforeach
                @endforeach
                
                <!-- <h4>栄養成分表示</h4>
                <ul class="display-items-list items-list_2">
                  @if(!empty($ingredients))
                    <li class="item">
                      <span class="border-bottom">エネルギー</span>
                      <span class="pt-10px">{{$ingredients->seibun_1}}kal</span>
                    </li>
                    <li class="item">
                      <span class="border-bottom">タンパク質</span>
                      <span class="pt-10px">{{$ingredients->seibun_2}}g</span>
                    </li>
                    <li class="item">
                      <span class="border-bottom">脂質</span>
                      <span class="pt-10px">{{$ingredients->seibun_3}}g</span>
                    </li>
                    <li class="item">
                      <span class="border-bottom">炭水化物</span>
                      <span class="pt-10px">{{$ingredients->seibun_4}}g</span>
                    </li>

                    <li class="item">
                      <span class="border-bottom">食塩相当量</span>
                      <span class="pt-10px">{{$ingredients->seibun_5}}g</span>
                    </li>
                    <li class="item">
                      <span class="border-bottom">カルシウム</span>
                      <span class="pt-10px">{{$ingredients->seibun_6}}mg</span>
                    </li>
                    
                  @endif
                </ul> -->
              </div>
            </div>
          </div>

          <div class="row mt-1 mb-5 material">
            <div class="col-12">
              <div class="materials-title">材料 <span>（1人分）</span></div>
              <div class="materials">
                <ul class="materials-list">
                  @foreach ($calories as $calorie)
                  
                  @foreach($calorie as $name)
                    <li>{{$name['syokuzai_name_1']}}<span>45.00g</span></li>
                  @endforeach
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection