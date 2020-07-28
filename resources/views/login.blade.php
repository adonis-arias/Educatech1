<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>educaTech</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="principle">
        <section class="section-one">
            <header>
                <div class="menu">
                    <ul>
                        <li><a href="#" class="logo"><img src="img/logo.png" alt=""></a></li>
                        <li><a href="#" class="log-in">Ingresa</a></li>
                    </ul>
                </div>
            </header>

            <div class="form">
            <form class="form" action="{{ route('app.login.submit') }}" method="post">
                {{ csrf_field() }}
                <h1>Ingresa</h1>
                <p class="app">Entra y continúe en nuestra aplicación</p>
                <input class="controls" type="email" name="email" placeholder="ingrese su correo" value="{{ old('email') }}" required autofocus><img class="img-msm" src="img/icon-msm.png" alt="">
                @if($errors->has('email'))
                <span class="help-block">
                 <strong>{{ $errors->first('email') }}</strong>
                 </span>
                @endif
                <input class="controls" type="password" placeholder="ingrese su contraseña" name="password" id="password" required><img class="img-msm" src="img/icon-lock.png" alt="">
                @if($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif               
                <p class="forgot-pass" ><a href="#">Olvisaste tu contraseña?</a></p>
                <button class="botons" type="submit">Ingresar</button>
             </form>   
            </div>
        </section>
        <section class="section-two">
            <div class="design-one">
                <div class="design-two">
                    <div class="img"><img src="img/login.svg" alt=""></div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

