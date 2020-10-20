  @extends('layouts.nav')
@section('backLink'){{url()->previous()}}@endsection
@section('title')
  <title>献立メニューについて - 単品</title>
@endsection


<?php
  use App\Syokuzai;
  use App\Kondate2;
  use App\Kondate3;
  use App\Ryouri2;
?>
@section('content')
    <div class="page-wrapper">
      <div class="menu-single-item-page">
    <?php
     $kondate2 =Kondate2::find($kondate_2_id);
    ?>
        <div class="menu-single-item-title">{{ $kondate2->name_1}}</div>
        <div class="container-fluid">
          <div class="row mt-4">
     
            <!-- <div class="col-6">
              <img class="img-fluid w-100" src="{{$ryouri_image->img_1? $ryouri_image->img_1 : $no_image}}" alt="meal">
            </div> -->
            <div class="col-lg-6 col-md-12 col-sm-6 single-dish">
              <img class="img-fluid w-100" src="/get-dishImage/{{ $ryouri_id[0] }}" >
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
                <ul class="display-items-list">
                  <?php
                  $kondate2 =Kondate2::find($kondate_2_id);
                  $allergies_infos =$kondate2->getAllergies();

                  ?>
                  @if(count($allergies_infos) > 0)
                   
                   
                   @foreach ($allergies_infos as $key=>$value)
                   @if($value['status']==1)
                     <li class="item">
                       <img src="{{url('img/'.$key.'.png')}}" alt="allergie">
                       <span>{{$value['title']}}</span>
                     </li>
                   @endif 

                   @endforeach
                  
                 @endif
             
                
               
                </ul>
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
                <?php
            
                  $kondate3_records =Kondate3::where('kondate_2_id',$kondate_2_id)->get();
                ?>
                  @foreach ($kondate3_records as $record)
                    <li>
                    @if(isset($record->syokuzai_name_6))
                        {{$record->syokuzai_name_6}}
                      @elseif(isset($record->syokuzai_name_1))
                        {{$record->syokuzai_name_1}}
                    @endif
                    <span>{{$record->siyou_ryou}}g</span>
                    </li>
                
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection