@extends('layouts.nav')

@section('content')
    <div class="menu_monthly_7var">
        <div class="month_title">
            <div class="container d-flex align-items-center">
                <div class="month_change_div py-3">
                    <a href="#"><i class="fas fa-chevron-circle-left"></i></a>
                    <p class="mb-0">
                        <span>12月</span>
                        <span>2020年</span>
                    </p>
                    <a href="#"><i class="fas fa-chevron-circle-right"></i></a>
                </div>
                <a href="#"><img src="img/pdfIcon.png" alt=""></a>
            </div>
        </div>
        <div class="container food_age_div my-4">
            <div class="d-flex align-items-center foods mb-3">
                <a href="#" class="btn">朝おやつ</a>
                <a href="#" class="btn active">昼食</a>
                <a href="#" class="btn">午後おやつ</a>
            </div>
            <div class="d-flex align-items-center age">
                <a href="#" class="btn active">3歳未満時</a>
                <a href="#" class="btn">3歳以上児</a>
                <a href="#" class="btn">職員</a>
            </div>
        </div>
        <div class="container food_age_planner">
            <h3 class="text-center my-5">昼食の献立（3歳未満児（幼稚園））</h3>
            <ul class="list-unstyled date_list row mb-5">
                <li class="col"><span> 月 </span></li>
                <li class="col"><span> 火 </span></li>
                <li class="col"><span> 水 </span></li>
                <li class="col"><span> 木 </span></li>
                <li class="col"><span> 金 </span></li>
                <li class="col"><span> 土 </span></li>
                <li class="col"><span> 日 </span></li>
            </ul>
            <ul class="list-unstyled menu_list row mb-5">
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="" alt="">
                            <figcaption></figcaption>
                        </figure>
                        <p>

                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>1</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>2</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>3</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>4</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>5</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>6</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled menu_list row mb-5">
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>7</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col free_date">
                    <a href="#">
                        <figure>
                            <img src="" alt="">
                            <span>休</span>
                            <figcaption>8</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>9</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>10</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>11</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>12</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>13</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled menu_list row mb-5">
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>14</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>15</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col current_date">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>16</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>17</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>18</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>19</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>20</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled menu_list row mb-5">
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>21</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>22</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>23</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>24</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>25</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>26</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>27</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled menu_list row mb-5">
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>28</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>29</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>30</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="img/menu01.png" alt="">
                            <figcaption>31</figcaption>
                        </figure>
                        <p>
                            鮭の塩焼き、卵焼き、
                            味噌汁、お漬物、白米
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="" alt="">
                            <figcaption></figcaption>
                        </figure>
                        <p>
                            
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="" alt="">
                            <figcaption></figcaption>
                        </figure>
                        <p>
                            
                        </p>
                    </a>
                </li>
                <li class="col">
                    <a href="#">
                        <figure>
                            <img src="" alt="">
                            <figcaption></figcaption>
                        </figure>
                        <p>
                            
                        </p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection