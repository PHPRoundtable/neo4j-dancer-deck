@extends('app')

@section('content')
    <div class="container">
        <h1>Browse all upcoming events</h1>

        <div class="well dd-event-browse-filter">
            <form class="form-inline">
                <div class="form-group">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            50 miles
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="#">50 miles</a></li>
                            <li><a href="#">100 miles</a></li>
                            <li><a href="#">150 miles</a></li>
                            <li><a href="#">200 miles</a></li>
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ddEventLocation">of</label>
                    <input type="text" name="event_location" class="form-control" id="ddEventLocation" placeholder="Chicago, IL">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div>

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

        <nav>
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
