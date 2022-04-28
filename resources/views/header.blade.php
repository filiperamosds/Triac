<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Triac</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link href="{{URL::asset('plugins/fontawesome-free/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{URL::asset('plugins/fontawesome-free/css/brands.css')}}" rel="stylesheet">
    <link href="{{URL::asset('plugins/fontawesome-free/css/solid.css')}}" rel="stylesheet">

    <script src="{{URL::asset('plugins/mask-money/jquery.maskMoney.min.js')}}"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        function numberToReal(numero) {
            if (numero == null) {
                return '0,00'
            }
            numero = parseFloat(numero);
            numero = numero.toFixed(2).split('.');
            numero[0] = numero[0].split(/(?=(?:...)*$)/).join('.');
            return numero.join(',');
        }
    </script>
    <style media="screen">
        body{
            font-size: 12px;
        }
        #menu ul {
			padding:0px;
			margin:0px;
			float: left;
			width: 100%;
			background-color:#EDEDED;
			list-style:none;
			font:80% Tahoma;
		}
		#menu ul li { display: inline; }
		#menu ul li a {
			background-color:#EDEDED;
			color: #333;
			text-decoration: none;
			border-bottom:3px solid #EDEDED;
			padding: 2px 10px;
			float:left;
            font-size: 15px;
		}
		#menu ul li a.teste:hover {
			background-color:#D6D6D6;
			color: #6D6D6D;
			border-bottom:3px solid #EA0000;
            font-size: 15px;
        }
        .notPointer{
            cursor: unset;
        }
        .pointer{
            cursor: pointer;
        }
        .pointer:hover{
             border-left: 2px solid #007bff;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

</head>
<body>
    <div id="menu">
		<ul>
            <li><a class="notPointer">Eletronica Triac</a></li>
			<li><a href="/client" class="teste">Cliente</a></li>
			<li><a href="/orderList" class="teste">Ordem de Serviço</a></li>
		</ul>
    </div>
    <br>
    <br>
    <div class="container">
        <div id="app" style="padding-top: 10px">
            @include('flash-message')
        </div>
        @yield('content')
    </div>
</body>
</html>
