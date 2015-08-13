<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $globalViewVars['title'] }}</title>
    @if (isset($meta['og:title']))
        <meta property="og:title" content="{{{ $meta['og:title'] }}}" />
    @endif
    @if (isset($meta['og:description']))
        <meta property="og:description" content="{{{ $meta['og:description'] }}}" />
    @endif
    @if (isset($meta['og:image']))
        <meta property="og:image" content="{{{ $meta['og:image'] }}}" />
    @endif
    @if (isset($meta['og:site_name']))
        <meta property="og:site_name" content="{{{ $meta['og:site_name'] }}}" />
    @endif
    @if (isset($meta['og:url']))
        <meta property="og:url" content="{{{ $meta['og:url'] }}}" />
    @endif
    <meta property="og:type" content="website" />

    <link href="{{ elixir("css/app.css") }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ $links['home'] }}">Dancer Deck</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-right">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search events...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @if (!Auth::guest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->get('name') }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ $links['auth.logout'] }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ $links['auth.login'] }}">Login</a></li>
                    <li><a href="{{ $links['auth.register'] }}">Register</a></li>
                @endif
                <li><a href="{{ $links['events.browse'] }}">Browse all events</a></li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ $links['about'] }}">About</a></li>
            <li><a href="{{ $links['contact'] }}">Contact</a></li>
            <li><a href="{{ $links['privacy'] }}">Privacy Policy</a></li>
        </ol>

        <p class="text-muted">&copy; Dancer Deck 2015. All Rights Reserved.</p>
    </div>
</footer>

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
