<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('css/main.css')}}" rel="stylesheet">
	<link href="{{asset('css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('dist/jquery.simplewizard.css')}}" rel="stylesheet" />
    
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <link rel="stylesheet" type="text/css" href="https://parsleyjs.org/src/parsley.css">
    <style>
       
#top{margin-top:-40px;}
  .error-message{color:red;}
  .address,.table{
    border: 1px solid #ddd;
    border-collapse: collapse;
  }
  #showpaypal{
    display:none;
  }
  .form{
    background: #F0F0E9;
    border: 0 none;
    margin-bottom: 10px;
    padding: 10px;
    width: 100%;
    font-weight: 300;
  }
  .profile-sidebar{background-color: #fdb45e;}
  .profile1{color:white;}
  .trackorder{
    margin-top: -33px;
    color: #fdb45e;
    margin-left: 248px;
    font-size: 31px;
    font-family: cursive;
}
  .order{    border: 1px solid #1f23291c;
             color: #696763;
    font-family: 'Roboto', sans-serif;
    font-size: 15px;
    font-weight: 300;
    padding: 0;
    padding-bottom: 10px;}

    ol.progtrckr {
    margin: 0;
    padding: 0;
    list-style-type none;
}

ol.progtrckr li {
    display: inline-block;
    text-align: center;
    line-height: 3.5em;
}

ol.progtrckr[data-progtrckr-steps="2"] li { width: 49%; }
ol.progtrckr[data-progtrckr-steps="3"] li { width: 33%; }
ol.progtrckr[data-progtrckr-steps="4"] li { width: 24%; }
ol.progtrckr[data-progtrckr-steps="5"] li { width: 15%; }
ol.progtrckr[data-progtrckr-steps="6"] li { width: 16%; }
ol.progtrckr[data-progtrckr-steps="7"] li { width: 14%; }
ol.progtrckr[data-progtrckr-steps="8"] li { width: 12%; }
ol.progtrckr[data-progtrckr-steps="9"] li { width: 11%; }

ol.progtrckr li.progtrckr-done {
    color: black;
    border-bottom: 4px solid yellowgreen;
}
ol.progtrckr li.progtrckr-todo {
    color: silver; 
    border-bottom: 4px solid silver;
}

ol.progtrckr li:after {
    content: "\00a0\00a0";
}
ol.progtrckr li:before {
    position: relative;
    bottom: -2.5em;
    float: left;
    left: 50%;
    line-height: 1em;
}
ol.progtrckr li.progtrckr-done:before {
    content: "\2713";
    color: white;
    background-color: yellowgreen;
    height: 2.2em;
    width: 2.2em;
    line-height: 2.2em;
    border: none;
    border-radius: 2.2em;
}
ol.progtrckr li.progtrckr-todo:before {
    content: "\039F";
    color: silver;
    background-color: white;
    font-size: 2.2em;
    bottom: -1.2em;
}
#showstatus{    padding-bottom: 59px;}
.error-message {
                  color:red;
                }

      .cart_up{
     background: #F0F0E9;
    color: #696763;
    display: inline-block;
    font-size: 16px;
    height: 28px;
    overflow: hidden;
    text-align: center;
    width: 35px;
    float: left;
    margin-top: 20px;

        }
          .cart_down{
     background: #F0F0E9;
    color: #696763;
    display: inline-block;
    font-size: 16px;
    height: 28px;
    overflow: hidden;
    text-align: center;
    width: 35px;
    float: left;

        }
    </style>


</head><!--/head-->

<body>

@include('frontend.layouts.header')
    
    @yield('content')
@include('frontend.layouts.footer')



    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('js/price-range.js')}}"></script>
    <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://parsleyjs.org/dist/parsley.min.js"></script>
    <script src="{{asset('dist/jquery.simplewizard.js')}}"></script>

    @yield('script')
       
</body>
</html>