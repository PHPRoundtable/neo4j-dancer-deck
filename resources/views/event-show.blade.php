@extends('app')

@section('content')
    <div class="container">
        <div class="dd-event-cover">
            <div class="row dd-event-cover-details">
                <div class="col-sm-3">
                    <div class="dd-event-photo">
                        <a href="#">
                            <img src="https://scontent-ord1-1.xx.fbcdn.net/hphotos-xpf1/v/t1.0-9/1378028_550925565038786_2919260574811185217_n.png?oh=930a30ce7c1eebaa8d3dde6219525ae0&oe=5645BE22" alt="" class="img-responsive img-rounded" />
                        </a>
                    </div>
                </div>
                <div class="col-sm-5">
                    <h1>Derby City Swing</h1>
                    <p class="dd-event-metadata">August 25-28<br />
                        Lexington, KY<br />
                        <a href="#" target="_blank">wwww.fooclassic.com</a>
                    </p>
                </div>
                <div class="col-sm-4">
                    countdown
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <p class="lead">A very small description of the events if there is something cool to say.</p>

                <h2>Hyatt Regency New Brunswick</h2>
                <div class="row">
                    <div class="col-sm-6">
                        70 Yorktown Center<br />
                        Lombard, Illinois 60148<br />
                        630-719-8000
                    </div>
                    <div class="col-sm-6">
                        <a href="#" class="btn btn-primary btn-block" role="button" target="_blank"><i class="fa fa-bed"></i> Book Hotel Room</a>
                    </div>
                </div>
                <p><img src="https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=600x300&maptype=roadmap
&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318
&markers=color:red%7Clabel:C%7C40.718217,-73.998284" alt="" class="img-responsive" /></p>

            </div>
            <div class="col-sm-4">
                <p><a href="#" class="btn btn-primary btn-block" role="button" target="_blank"><i class="fa fa-ticket"></i> Buy Tickets</a></p>

                <div class="dd-event-member-organizations">
                    <label>Member organizations</label>
                </div>

                <h4>Other upcoming events in the area</h4>

                <div class="row dd-event-listing">
                    <div class="col-sm-3">
                        <div class="dd-event-photo">
                            <a href="#">
                                <img src="https://scontent-ord1-1.xx.fbcdn.net/hphotos-xpf1/v/t1.0-9/1378028_550925565038786_2919260574811185217_n.png?oh=930a30ce7c1eebaa8d3dde6219525ae0&oe=5645BE22" alt="" class="img-responsive img-rounded" />
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-9 dd-event-details">
                        <h4><a href="#">Derby City Swing</a></h4>
                        <p class="dd-event-metadata">August 25-28<br />
                            Lexington, KY</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
