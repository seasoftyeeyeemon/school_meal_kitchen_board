<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/default_app.css">
    <title>サインイン</title>
    <style>
      .fixed-height {
        position:absolute;
        top:0;
        left:0;
        height:100%;
        width:100%;
      }
      
      .bg--underlay {
        height:40%;
        background: #5FAFB1;
      }
      .login-form {
        background:#ffffff;
        border-radius:  10px;
        box-shadow:0 5px 5px 1px #ddd;
      }
      .form--input {
        padding-top:23px;
        padding-bottom:23px;
        border-radius: 23px;
      }
      .btn--login {
        background:#61B7BA;
        border:none;
        border-radius:23px;
        padding:13px;
        color:#ffffff;
        transition:0.3s;
      }
      .btn--login:hover {
        opacity:0.7;
      }
      .btn--login:focus {
        outline:none;
      }
      .form--input_img{
        top:10px;
        left:10px;
      }
      .fs-18 {
        font-size:18px;
      }
      .fs-20 {
        font-size:20px;
      }
      .img--login_1 {
        top:12px;
        width:36px;
      }
      .img--login_2 {
        width:70px;
      }
      .img--login_3 {
        top:7px;
      }
      .img--login_4 {
        top:13px;
        width:35px;
      }
      .top-120 {
        top:120px;
      }

    </style>
  </head>
  <body>
  
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 fixed-height px-0">
        <div class="bg--underlay">
          <h1 class="text-center pt-5 text-white fs-18">給食室ボード</h1>
        </div> 
      </div>
      <div class="col-12">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-7 col-9 top-120">
              <img class="ml-4 position-relative img--login_1" src="./img/footer-pict01.png" alt="charactor art">
              <img class="ml-4 position-relative img--login_2" src="./img/footer-pict02.png" alt="charactor art">
              <img class="ml-4 position-relative img--login_3" src="./img/footer-pict03.png" alt="charactor art">
              <img class="mr-4 float-right position-relative img--login_4" src="./img/footer-pict04.png" alt="charactor art">
              
              <!-- START LOGIN FORM -->
              <div class="login-form py-5">
                <h3 class="text-center fs-20">サインイン</h3>
                <form class="w-75 mx-auto" method="POST" action="{{ route('login') }}">
                 @csrf
                 @if ($errors->has('username'))
						<center class="login-error">
							<font color="red">{{ $errors->first('username') }}</font>
						</center>
				 @elseif ($errors->has('password'))
					<center class="login-error">
						<font color="red">{{ $errors->first('password') }}</font>
                    </center>
                 @endif
                  <div class="form-group mt-4 position-relative">
                    <img class="position-absolute form--input_img" src="./img/pict_user.png" alt="">
                    <input type="text" class="form-control pl-5 form--input" placeholder="ユーザーネーム" name="username">
                  </div>
                  <div class="form-group mt-4 position-relative">
                    <img class="position-absolute form--input_img" src="./img/pict_password.png" alt="">
                    <input type="password" class="form-control pl-5 form--input" placeholder="パスワード" name="password">
                    
                  </div>
                  <div class="form-group mt-4">
                    <input class="btn-block btn--login" type="submit" value="サインイン" >
                    
                  </div>
                </form>
              </div>
              <!-- END LOGIN FORM -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
