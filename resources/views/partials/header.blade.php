
<header>
        <div class="container">
            <div class="logo"><a href="{{route('app.dashboard')}}"><img src="img/logoHome.png" alt=""></a></div>
            <nav class="nav-left">
                <ul>
                    <li><a href="{{ route('app.course.page') }}" class="left">Mis cursos</a></li>
                    <li><a href="#" class="left">Calificaciones</a></li>
                    <li><a href="#" class="left">Recursos</a></li>
                </ul>
            </nav>
            <nav class="nav-right">
                <ul class="flex-icon">
                    <li class="name"><a href="#">{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</a></li>
                    <li><a href="{{ route('app.logout')}}" class="login" onclick="event.preventDefault();document.getElementById('salir-form').submit();"></a></li>
                    <form action="{{ route('app.logout') }}" method="POST" style="display: none;" id="salir-form">
                        {{ csrf_field() }}
                    </form>
                </ul>
            </nav>
        </div>
    </header>
