<!DOCTYPE html>
<html lang="en">
<head>
    <title>Coming Soon 9</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link href="{{asset('assets/vendor/css/frontend/coming-soon.min.css')}}" rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <!--===============================================================================================-->
    <meta name="robots" content="index, follow">
    <style>
        .link-creator{
            padding-left: 5px;
            color: #c6c6ff;
            text-decoration: none;
            padding-top: 2px;
        }
    </style>
</head>
<body>

<!--  -->
<div class="simpleslide100">
    <div class="simpleslide100-item bg-img1" style="background-image: url('{{asset('assets/images/coming-soon/bg01.jpg')}}');"></div>
    <div class="simpleslide100-item bg-img1" style="background-image: url('{{asset('assets/images/coming-soon/bg02.jpg')}}');"></div>
    <div class="simpleslide100-item bg-img1" style="background-image: url('{{asset('assets/images/coming-soon/bg03.jpg')}}');"></div>
</div>

<div class="flex-col-c-sb size1 overlay1">
    <!--  -->
    <div class="w-full flex-w flex-sb-m p-l-80 p-r-80 p-t-22 p-lr-15-sm">
        <div class="wrappic1 m-r-30 m-t-10 m-b-10 logo-header">
            <a href="#"><span class="">{{config('app.name')}}</span></a>
        </div>
    </div>

    <!--  -->
    <div class="flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-150">
        <h3 class="l1-txt1 txt-center p-b-40 respon1">
            Coming Soon
        </h3>
    </div>

    <!--  -->
    {{--<div class="flex-w flex-c-m p-b-35">
        <a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
            <i class="fab fa-facebook"></i>
        </a>

        <a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
            <i class="fab fa-twitter"></i>
        </a>

        <a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
            <i class="fab fa-youtube"></i>
        </a>
    </div>--}}

    <div class="p-b-25 flex-w" style="color: #f3f3f3">Made with️❤️by  <a href="https://lizeshakya.com.np" target="_blank" class="link-creator">@lizeshakya</a></div>
</div>

<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/js/back.min.js')}}"></script>
<script>
    $('.simpleslide100').each(function(){
        var delay = 6000;
        var speed = 4000;
        var itemSlide = $(this).find('.simpleslide100-item');
        var nowSlide = 0;

        $(itemSlide).hide();
        $(itemSlide[nowSlide]).show();
        nowSlide++;
        if(nowSlide >= itemSlide.length) {nowSlide = 0;}

        setInterval(function(){
            $(itemSlide).fadeOut(speed);
            $(itemSlide[nowSlide]).fadeIn(speed);
            nowSlide++;
            if(nowSlide >= itemSlide.length) {nowSlide = 0;}
        },delay);
    });
</script>
</body>
</html>
