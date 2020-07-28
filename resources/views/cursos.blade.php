<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>cursos</title>
    <link rel="stylesheet" href="css/menuBar.css">
    <link rel="stylesheet" href="css/cursos.css">
<!--    <link rel="stylesheet" href="styleContent.css">-->
</head>
<body>
    @include('partials.header')
        <div class="container-courses">
             <div class="description">
                    <p>Mis cursos</p>
                    <p>Hola <span>{{ Auth::user()->nombre }}</span>, aquí encontraras los cursos que corresponden a tu año escolar</p>
                </div>
             <div class="courses">
                    @foreach($lista_cursos as $curso)
                    <div class="razoMatematico"><a href="./curso.html"><img src="./img/rm.jpeg" alt=""></a><p><a href="#">{{$curso->nombre}}</a></p></div>
                    @endforeach
             </div>
             <div class="footer">
            <div class="content-footer">
                <p>Copyright 2019 educatech.org</p>
            </div>
        </div>
        </div>
</body>
</html>