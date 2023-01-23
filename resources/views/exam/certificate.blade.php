<!doctype html>
<html>
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
</head>
<body>
    <div class="" style="display: flex;">
        <div class="" style="float: left;">
            <img src="" width="160px" alt="Logo del Tribunal Superior de Justicia de Morelos">
        </div>
        <div class="" style="padding-left: 50px; padding-top:5rem;  align-content: center;">
            H. TRIBUNAL SUPERIOR DE JUSTICIA DEL ESTADO DE MORELOS.
        </div>
    </div>
    <div class="w-100" style="padding-top:13rem; margin-left: 50px; padding-right:30px!important;  ">
        Por este medio se certifica que el usuario {{$user->name}} concretó <br>su: <b>Examen de oposición para Juez de primera instancia</b>
    </div>
    <div class="w-100" style="padding-top:.3rem; margin-left: 50px;  ">
        @php
            \Carbon\Carbon::setUTF8(true);
            \Carbon\Carbon::setLocale(config('app.locale'));
            setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
                    $date = new \Carbon\Carbon($exam->finished_at);
                    $formatedDate = $date->isoFormat('MMMM Do YYYY, h:mm:ss a');
        @endphp
        Con fecha de finalización en: {{$formatedDate}}
    </div>
    <div class="w-100" style="padding-top:.3rem; margin-left: 50px;  ">
        Teniendo una duración de resolución de: {{$exam->time}}
    </div>
    <div class="w-100" style="padding-top:.3rem; margin-left: 50px;  ">
        Calificación total: {{$exam->score}} / 100
    </div>
    <div style="display: flex; padding-bottom: 10rem; padding-left: 50px;">
        <div class="w-50" style="padding-top:15rem; float: left;">
            Firma del usuario
        </div>
        <div class="w-50" style="padding-top:15rem; float: right;">
            Firma del aplicador
        </div>
    </div>
    <div class="w-100" style="padding-top:20rem; margin-left: 50px;  ">
        La veracidad de este certificado se puede comprobar en:
    </div>
    <div class="w-100" style="padding-top:.3rem; margin-left: 50px;  ">
        <a href="{{$url}}">{{$url}}</a>
    </div>
</body>
</html>
