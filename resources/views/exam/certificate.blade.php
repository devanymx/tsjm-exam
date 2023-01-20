<!doctype html>
<html lang="en">
<head>
    <style>
        body{
            padding: .5rem;
        }
        * {
            font-family: sans-serif;
        }
        .w-100{
            width: 100%!important;
        }
        .w-50{
            width: 50%!important;
        }
        .text-center{
            text-align: center;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="wrapper" style="display: flex;">
        <div class="" style="float: left;">
            <img src="{{ asset('images/logo.png') }}" width="160px" alt="Logo del Tribunal Superior de Justicia de Morelos">
        </div>
        <div class="" style="padding-left: 1rem; padding-top:5rem;  align-content: center;">
            H. TRIBUNAL SUPERIOR DE JUSTICIA DEL ESTADO DE MORELOS.
        </div>
    </div>
    <div class="w-100" style="padding-top:13rem; margin-left: 80px;  ">
        Por este medio se certifica que el usuario {{$user->name}} concretó su <br><b>Examen de oposición para Juez de primera instancia</b>
    </div>
    <div class="w-100" style="padding-top:.3rem; margin-left: 80px;  ">
        @php
            \Carbon\Carbon::setUTF8(true);
            \Carbon\Carbon::setLocale(config('app.locale'));
            setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
                    $date = new \Carbon\Carbon($exam->finished_at);
                    $formatedDate = $date->isoFormat('MMMM Do YYYY, h:mm:ss a');
        @endphp
        Con fecha de finalización en: {{$formatedDate}}
    </div>
    <div class="w-100" style="padding-top:.3rem; margin-left: 80px;  ">
        Teniendo una duración de resolución de: {{$exam->time}}
    </div>
    <div class="w-100" style="padding-top:.3rem; margin-left: 80px;  ">
        Calificación total: {{$exam->score}} / 100
    </div>
    <div style="display: flex; padding-bottom: 10rem; padding-left: 80px;">
        <div class="w-50" style="padding-top:15rem; float: left;">
            Firma del usuario
        </div>
        <div class="w-50" style="padding-top:15rem; float: right;">
            Firma del aplicador
        </div>
    </div>
    <div class="w-100" style="padding-top:20rem; margin-left: 80px;  ">
        La veracidad de este certificado se puede comprobar en:
    </div>
    <div class="w-100" style="padding-top:.3rem; margin-left: 80px;  ">
        <a href="{{$url}}">{{$url}}</a>
    </div>
</body>
</html>
