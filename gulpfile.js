var elixir = require('laravel-elixir');

elixir.config.sourcemaps = false;

elixir(function(mix) {
    mix.less('app.less');
    mix.version("css/app.css");
});
