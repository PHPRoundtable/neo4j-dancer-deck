@extends('admin.layouts.master')

@section('content')

    @if ( ! $event->id)
        {{ Form::model($event, ['route' => 'admin.episode.store', 'role' => 'form']) }}
    @else
        {{ Form::model($event, ['route' => ['admin.episode.update', $event->id], 'method' => 'put', 'role' => 'form']) }}
    @endif

    <div class="row">
        <div class="col-xs-2">
            <div class="form-group {{ $errors->get('episode_number') ? 'has-error' : '' }}">
                <label for="episode_number">Episode</label>
                {{ Form::text('episode_number', null, ['class' => 'form-control input-lg']) }}
                <span class="help-block">{{ $errors->first('episode_number') }}</span>
            </div>
        </div>
        <div class="col-xs-10">
            <div class="form-group {{ $errors->get('title_short') ? 'has-error' : '' }}">
                <label for="title_short">Short Title</label>
                {{ Form::text('title_short', null, ['class' => 'form-control input-lg']) }}
                <span class="help-block">{{ $errors->first('title_short') }}</span>
            </div>
        </div>
    </div>

    <div class="form-group {{ $errors->get('tile_long') ? 'has-error' : '' }}">
        <label for="tile_long">Long Title</label>
        {{ Form::text('tile_long', null, ['class' => 'form-control', 'data-make-url-safe' => 'slug']) }}
        <span class="help-block">{{ $errors->first('tile_long') }}</span>
    </div>

    <div class="form-group {{ $errors->get('slug') ? 'has-error' : '' }}">
        <label for="slug">URL Slug</label>
        {{ Form::text('slug', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('slug') }}</span>
    </div>

    <hr />

    <div class="row">
        <div class="col-xs-3">
            <div class="form-group {{ $errors->get('air_date') ? 'has-error' : '' }}">
                <label for="air_date"><i class="fa fa-calendar"></i> Air Date</label>
                {{ Form::text('air_date', null, ['placeholder' => 'e.g. 2015-01-26', 'class' => 'form-control']) }}
                <span class="help-block">{{ $errors->first('air_date') }}</span>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group {{ $errors->get('air_time') ? 'has-error' : '' }}">
                <label for="air_time">Time</label>
                {{ Form::text('air_time', null, ['placeholder' => 'e.g. 19:00', 'class' => 'form-control']) }}
                <span class="help-block">{{ $errors->first('air_time') }}</span>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group {{ $errors->get('air_date_timezone') ? 'has-error' : '' }}">
                <label for="air_date_timezone">Timezone</label>
                {{ Form::select('air_date_timezone', Config::get('podcast.common_timezones'), null, ['class' => 'form-control']) }}
                <span class="help-block">{{ $errors->first('air_date_timezone') }}</span>
            </div>
        </div>
        <div class="col-xs-2">
            <div class="checkbox {{ $errors->get('air_date_confirmed') ? 'has-error' : '' }}">
                <label>
                    {{ Form::checkbox('air_date_confirmed', '1') }}
                    Confirmed
                </label>
                <span class="help-block">{{ $errors->first('air_date_confirmed') }}</span>
            </div>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-xs-7">
            <div class="form-group {{ $errors->get('description_markdown') ? 'has-error' : '' }}">
                <label for="description_markdown">Description</label>
                {{ Form::textarea('description_markdown', null, ['placeholder' => 'Episode description', 'class' => 'form-control', 'rows' => '10']) }}
                <span class="help-block">{{ $errors->first('description_markdown') }}</span>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="form-group {{ $errors->get('youtube_url') ? 'has-error' : '' }}">
                <label for="youtube_url"><i class="fa fa-youtube"></i> YouTube URL</label>
                <div class="row">
                    <div class="col-xs-9">
                        {{ Form::text('youtube_url', null, ['class' => 'form-control input-sm', 'data-make-youtube-embed' => 'youtube_id']) }}
                    </div>
                    <div class="col-xs-3">
                        <button type="button" class="btn btn-primary btn-sm btn-block" data-download-youtube-audio="youtube_id" title="Download HD version of the video" {{ $event->youtube_id ? '' : 'disabled="disabled"' }}>
                            <i class="fa fa-cloud-download"></i>
                        </button>
                    </div>
                </div>
                <span class="help-block">{{ $errors->first('youtube_url') }}</span>
            </div>

            <div class="cms-youtube-embed" id="youtube_id-container">{{ $event->youtube_embed }}</div>
            {{ Form::hidden('youtube_id') }}
        </div>
    </div>

    <hr />

    <div class="form-group {{ $errors->get('twitter_hashtags') ? 'has-error' : '' }}">
        <label for="audio_intro_script"><i class="fa fa-twitter"></i> Twitter Hash Tags</label>
        {{ Form::text('twitter_hashtags', null, ['class' => 'form-control', 'placeholder' => '#php #awesomesauce']) }}
        <span class="help-block">{{ $errors->first('twitter_hashtags') }}</span>
    </div>

    <hr />

    <div class="form-group {{ $errors->get('audio_intro_script') ? 'has-error' : '' }}">
        <label for="audio_intro_script"><i class="fa fa-microphone"></i> Audio Intro Script</label>
        {{ Form::text('audio_intro_script', null, ['class' => 'form-control', 'placeholder' => 'Today\'s topic of discussion is,']) }}
        <span class="help-block">{{ $errors->first('audio_intro_script') }}</span>
    </div>

    <hr />

    <h2><i class="fa fa-users"></i> Guests</h2>

    <div class="form-group {{ $errors->get('guest_list') ? 'has-error' : '' }}">
        <label for="guest_list text-mute">Enter a guest name</label>
        {{ Form::text('guest_list', null, ['class' => 'form-control input-sm', 'id' => 'guest-autocomplete']) }}
        <span class="help-block">{{ $errors->first('guest_list') }}</span>
    </div>
    <div class="cms-guest-list" id="guest-autocomplete-container">
        @foreach ($event->guests as $guest)
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <img src="{{ $guest->avatar }}" alt="" class="img-circle" /> {{ $guest->name }}
                <input name="guests[]" type="hidden" value="{{ $guest->id }}" />
            </div>
        @endforeach
    </div>

    <hr />

    <div class="checkbox {{ $errors->get('is_explicit') ? 'has-error' : '' }}">
        <label>
            {{ Form::checkbox('is_explicit', '1') }}
            <i class="fa fa-bomb"></i> Explicit episode
        </label>
        <span class="help-block">{{ $errors->first('is_explicit') }}</span>
    </div>

    <hr />

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ $event->show_link ?: $links['episodes'] }}" class="btn btn-link">Cancel</a>
    {{ Form::close() }}

    @if ($event->id)
        <hr />
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Danger Zone!</h3>
                    </div>
                    <div class="panel-body text-center">
                        {{ Form::model($event, ['route' => ['admin.event.destroy', $event->id], 'method' => 'delete', 'role' => 'form']) }}
                        <button type="submit" class="btn btn-danger">Delete Event</button>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    @endif

@stop
