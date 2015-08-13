@extends('app')

@section('content')
    <div class="dd-hero">
        <div class="container">
            <label>Next event...</label>
            <div class="row">
                <div class="col-sm-3">
                    <div class="dd-event-photo">
                        <a href="#">
                            <img src="https://scontent-ord1-1.xx.fbcdn.net/hphotos-xpf1/v/t1.0-9/11032753_10153012011281304_8572108356999722603_n.jpg?oh=3892bc83c059d2b87302561f2a617e11&oe=563822CF" alt="" class="img-responsive img-rounded" />
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 dd-event-details">
                    <h1><a href="#">Some Foo Event Classic</a></h1>
                    <p class="dd-event-date">August 25-28</p>
                    <p class="dd-event-metadata">
                        New York, NY<br />
                        <a href="#" target="_blank">wwww.fooclassic.com</a>
                    </p>

                    <div class="row">
                        <div class="col-sm-6">
                            <p><a href="#" class="btn btn-primary btn-block" role="button" target="_blank"><i class="fa fa-ticket"></i> Buy Tickets</a></p>
                            <p><a href="#" class="btn btn-primary btn-block" role="button" target="_blank"><i class="fa fa-bed"></i> Book Hotel Room</a></p>
                        </div>
                        <div class="col-sm-6">
                            Foo
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    FooBar
                </div>
            </div>
        </div>
    </div>

    <div class="container dd-home-">
        <div class="row">
            <div class="col-sm-6 dd-upcoming-events">
                <h3>More Upcoming Events</h3>

                <div class="row dd-event-listing">
                    <div class="col-sm-3">
                        <div class="dd-event-photo">
                            <a href="#">
                                <img src="https://scontent-ord1-1.xx.fbcdn.net/hphotos-xpf1/v/t1.0-9/1378028_550925565038786_2919260574811185217_n.png?oh=930a30ce7c1eebaa8d3dde6219525ae0&oe=5645BE22" alt="" class="img-responsive img-rounded" />
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 dd-event-details">
                        <h4><a href="#">Derby City Swing</a></h4>
                        <p class="dd-event-metadata">August 25-28<br />
                            Lexington, KY</p>
                    </div>
                    <div class="col-sm-3">
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-calendar"></i></a></li>
                            <li><a href="#"><i class="fa fa-google"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                        </ol>
                    </div>
                </div>

                <div class="row dd-event-listing">
                    <div class="col-sm-3">
                        <div class="dd-event-photo">
                            <a href="#">
                                <img src="https://scontent-ord1-1.xx.fbcdn.net/hphotos-xpf1/t31.0-8/11741228_10206870238532931_8361124495078297852_o.jpg" alt="" class="img-responsive img-rounded" />
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 dd-event-details">
                        <h4><a href="#">Swing City Chicago</a></h4>
                        <p class="dd-event-metadata">October 25-28<br />
                            San Diego, CA</p>
                    </div>
                    <div class="col-sm-3">
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-calendar"></i></a></li>
                            <li><a href="#"><i class="fa fa-google"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 dd-early-bird-countdown">
                <h3>Early-Bird Countdown</h3>
                <p>The following events have early-bird prices that are ending soon. Make sure to register now to save money!</p>

                <table class="table table-striped table-hover">
                    <tr>
                        <th>Event</th>
                        <th>Early-bird ends</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td><a href="#">Foo Dance Challenge</a></td>
                        <td>in 13 days</td>
                        <td><a href="#" class="btn btn-primary btn-block btn-xs" role="button" target="_blank"><i class="fa fa-ticket"></i> Buy Tickets</a></td>
                    </tr>
                    <tr>
                        <td><a href="#">Some Foo Event Classic</a></td>
                        <td>in 28 days</td>
                        <td><a href="#" class="btn btn-primary btn-block btn-xs" role="button" target="_blank"><i class="fa fa-ticket"></i> Buy Tickets</a></td>
                    </tr>
                    <tr>
                        <td><a href="#">US Open</a></td>
                        <td>in 58 days</td>
                        <td><a href="#" class="btn btn-primary btn-block btn-xs" role="button" target="_blank"><i class="fa fa-ticket"></i> Buy Tickets</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
