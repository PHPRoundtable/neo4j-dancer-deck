@extends('admin.layouts.master')

@section('content')

    <div class="clearfix">
        <a href="{{ $links['event_create'] }}" class="btn btn-primary btn-lg pull-right" role="button">Add Event</a>
        <h1>Events</h1>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Event</th>
            <th>&nbsp;</th>
            <th>Next Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        /*
        @foreach ($episodes as $episode)
            <tr class="{{ $episode->hasWarnings() && $episode->isAfterAirTime() ? 'danger' : '' }}">
                <td>
                    @if($episode->hasYouTubeWarning())
                        <span class="label label-danger" data-toggle="tooltip" title="No YouTube video linked">
                            <i class="fa fa-film"></i>
                        </span>
                    @elseif($episode->hasAudioFileWarning())
                        <span class="label label-warning" data-toggle="tooltip" title="Audio File Missing">
                            <i class="fa fa-file-audio-o"></i>
                        </span>
                    @elseif($episode->hasWarnings())
                        <span class="label label-warning" data-toggle="tooltip" title="{{ $episode->warnings_summary }}">
                            <i class="fa fa-warning"></i>
                        </span>
                    @elseif($episode->publish_to_rss)
                        <span class="label label-success" data-toggle="tooltip" title="Yay!">
                            <i class="fa fa-check-circle"></i>
                        </span>
                    @endif
                </td>
                <td>
                    <a href="{{ $episode->show_link }}">
                        {{ $episode->title }}
                    </a>
                </td>
                <td>
                    @if($episode->is_explicit)
                        <span class="label label-default" data-toggle="tooltip" title="Explicit episode">
                            <i class="fa fa-bomb" data-toggle="tooltip" title=""></i>
                        </span>
                    @endif
                </td>
                <td class="{{ $episode->air_date_confirmed ? '' : 'text-muted' }}">
                    <small>
                        {{ $episode->air_date_and_time_pretty }}
                        {{ $episode->air_date_confirmed ? '' : '(tentative)' }}
                    </small>
                </td>
            </tr>
        @endforeach
        */
        ?>
        </tbody>
    </table>

@stop
