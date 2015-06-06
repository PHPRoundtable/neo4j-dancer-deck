<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <title>{{ $globalViewVars->title }}</title>
    <link href="{{ elixir("css/app.css") }}" rel="stylesheet" />
    <script>{{ $js->get() }}</script>
</head>
<body>

<div class="header">
    <div class="container header-container">
        <nav class="navbar navbar-default" role="navigation">
          <a class="cms-header-logo" href="{{ $links['home'] }}">Dancer Deck</a>
            <ul class="nav navbar-nav">
                @foreach ($mainNav->getNavItems() as $navItem)
                <li class="{{ $navItem['isActive'] ? 'active' : '' }}">
                    <a href="{{ $navItem['url'] }}">
                        {!! $navItem['icon'] ? '<i class="fa ' . $navItem['icon'] . '"></i>' : '' !!}
                        {{ $navItem['anchor'] }}
                    </a>
                </li>
                @endforeach
            </ul>
            <ul class="nav navbar-nav pull-right">
                <li><a href="{{ $links['logout'] }}">Log Out</a></li>
            </ul>
        </nav>
    </div>
</div>

@if (Session::has('message'))
<div class="container">
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Yay!</strong> {{ Session::get('message') }}
    </div>
</div>
@endif

@if (Session::has('error'))
<div class="container">
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Oh Snap!</strong> {{ Session::get('error') }}
    </div>
</div>
@endif

<div class="body">
    <div class="container body-container">

        <div class="row">
            <div class="col-sm-3">
                @include('admin.layouts.sub-nav')
            </div>
            <div class="col-sm-9 cms-content">
                @include('admin.layouts.breadcrumb')
                @yield('content')
            </div>
        </div>

    </div>
</div>

<div class="footer">
    <div class="container footer-container">
        <p>&copy; Dancer Deck 2015. All Rights Reserved.</p>
    </div>
</div>

@yield('modals')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>
