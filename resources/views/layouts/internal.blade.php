<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        @yield('title')
    </title>
    <meta id="token" name="token" value="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="theme/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="theme/css/themify-icons.css" rel="stylesheet" type="text/css" media="all" />
    <link href="theme/css/flexslider.css" rel="stylesheet" type="text/css" media="all" />
    <link href="theme/css/lightbox.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="theme/css/ytplayer.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/app.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400%7CRaleway:100,400,300,500,600,700%7COpen+Sans:400,500,600' rel='stylesheet' type='text/css'>
</head>
<body class="scroll-assist">
<div class="nav-container">
<a id="top"></a>
<nav>

<div class="nav-bar">
<div class="module left">
    <a href="index.html">
        <img class="logo logo-light" alt="Foundry" src="theme/img/logo-light.png" />
        <img class="logo logo-dark" alt="Foundry" src="theme/img/logo-dark.png" />
    </a>
</div>
<div class="module widget-handle mobile-toggle right visible-sm visible-xs">
    <i class="ti-menu"></i>
</div>
<div class="module-group right">
<div class="module left">
<ul class="menu">
    <li><a href="/home">Main</a></li>
    <li><a href="/manage_acount">My Account</a></li>
</ul>
</div>
<!--end of menu module-->

</div>
<!--end of module group-->
</div>
</nav>
</div>
<div class="main-container">
    @yield('content')

    <footer class="footer-1 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <img alt="Logo" class="logo" src="theme/img/logo-light.png" />
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h6 class="title">Recent Posts</h6>
                        <hr>
                        <ul class="link-list recent-posts">
                            <li>
                                <a href="#">Hugging pugs is super trendy</a>
                                        <span class="date">February
                                            <span class="number">14, 2015</span>
                                        </span>
                            </li>
                            <li>
                                <a href="#">Spinning vinyl is oh so cool</a>
                                        <span class="date">February
                                            <span class="number">9, 2015</span>
                                        </span>
                            </li>
                            <li>
                                <a href="#">Superior theme design by pros</a>
                                        <span class="date">January
                                            <span class="number">27, 2015</span>
                                        </span>
                            </li>
                        </ul>
                    </div>
                    <!--end of widget-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h6 class="title">Latest Updates</h6>
                        <hr>
                        <div class="twitter-feed">
                            <div class="tweets-feed" data-widget-id="492085717044981760">
                            </div>
                        </div>
                    </div>
                    <!--end of widget-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h6 class="title">Instagram</h6>
                        <hr>
                        <div class="instafeed" data-user-name="mrareweb">
                            <ul></ul>
                        </div>
                    </div>
                    <!--end of widget-->
                </div>
            </div>
            <!--end of row-->
            <div class="row">
                <div class="col-sm-6">
                    <span class="sub">&copy; Copyright 2016 - Medium Rare</span>
                </div>
                <div class="col-sm-6 text-right">
                    <ul class="list-inline social-list">
                        <li>
                            <a href="#">
                                <i class="ti-twitter-alt"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ti-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ti-dribbble"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ti-vimeo-alt"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end of container-->
        <a class="btn btn-sm fade-half back-to-top inner-link" href="#top">Top</a>
    </footer>
</div>
<script src="theme/js/jquery.min.js"></script>
<script src="theme/js/bootstrap.min.js"></script>
<script src="theme/js/flickr.js"></script>
<script src="theme/js/flexslider.min.js"></script>
<script src="theme/js/lightbox.min.js"></script>
<script src="theme/js/masonry.min.js"></script>
<script src="theme/js/twitterfetcher.min.js"></script>
<script src="theme/js/spectragram.min.js"></script>
<script src="theme/js/ytplayer.min.js"></script>
<script src="theme/js/countdown.min.js"></script>
<script src="theme/js/smooth-scroll.min.js"></script>
<script src="theme/js/parallax.js"></script>
<script src="theme/js/scripts.js"></script>


<script src="/js/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.js"></script>
@yield('javascript')
</body>
</html>