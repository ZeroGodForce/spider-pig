<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Spider-Man Competition</title>

    <link href='{{ asset("css/font-awesome.min.css") }}' rel="stylesheet">
    <!-- Bootstrap -->
    <link href='{{ asset("css/bootstrap.min.css") }}' rel="stylesheet">

    <link href='{{ asset("css/style.css") }}' rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<section id="hero-img">
    <img src="{{ asset('img/hero.jpg') }}" alt="">
</section>

<section class="content-area">
    <div class="left-pane"></div>

    <div class="feature">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <div class="feature-item">
                        <img class="section-img" src="{{ asset('img/section_image.png') }}" alt="">

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="feature-item">
                        <h1 class="main-title">{!! __('messages.main_title') !!}</h1>
                        <h2 class="section-title">{!! __('messages.section_title') !!}</h2>
                        <p>{!! __('messages.section_para1') !!}</p>
                        <p>{!! __('messages.section_para2') !!}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="right-pane"></div>
</section>

</body>
</html>
