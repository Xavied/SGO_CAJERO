<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/css/uikit.min.css" />


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #FFBC30;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                   SGO
                </div>
                <form action="/welcome" method="POST">
                    {{csrf_field()}}
                     <div class="uk-margin">
                            <input class="uk-input uk-form-width-medium" name="email" type="text" placeholder="correo">
                     </div>
                     <div class="uk-margin">
                            <input class="uk-input uk-form-width-medium" name="password" type="text" placeholder="contraseña">
                     </div>
                     <div  class="uk-card uk-card-default uk-card-body uk-animation-fade">
                         <p class="uk-text-center">
                             <button class="uk-button uk-button-default uk-text-warning" type=submit>Iniciar Sesión</button>
                         </p>
                    </div>

                </form>


            </div>
        </div>
    </body>
</html>
