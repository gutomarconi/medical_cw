<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Medical Records</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
        <link type="text/css" rel="stylesheet" href="./../../css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">

        <script src="https://cdn.jsdelivr.net/npm/vue-jquery-mask"></script>

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: auto;
                margin: 0;
            }

            .full-height {
                min-height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }
            .modal-mask {
                position: fixed;
                z-index: 9998;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, .5);
                display: table;
                transition: opacity .3s ease;
            }

            .modal-wrapper {
                display: table-cell;
                vertical-align: middle;
            }

            .modal-container {
                width: 800px;
                margin: 0px auto;
                padding: 20px 30px;
                background-color: #fff;
                border-radius: 2px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
                transition: all .3s ease;
                font-family: Helvetica, Arial, sans-serif;
            }

            .modal-header h3 {
                margin-top: 0;
                color: #42b983;
            }

            .modal-body {
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <view-patients
                fetch-url="{{ route('patients.list') }}"
                :columns="['name', 'email', 'date_of_birth' , 'phone_number', 'height', 'weight']"
            ></view-patients>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="./../../js/materialize.min.js"></script>
    </body>
    <script type="text/x-template" id="modal-template">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">
                        <div class="modal-header">
                            <slot name="header">
                                default header
                            </slot>
                        </div>

                        <div class="modal-body">
                            <slot name="body">
                            </slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer">
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </script>
    <script type="text/x-template" id="modalCreate-template">
        <transition name="modalCreate">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">
                        <div class="modal-header">
                            <slot name="header">
                                default header
                            </slot>
                        </div>

                        <div class="modal-body">
                            <slot name="body">
                            </slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer">
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </script>
</html>
