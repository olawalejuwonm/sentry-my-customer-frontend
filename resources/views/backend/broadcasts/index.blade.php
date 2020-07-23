@extends('layout.base')

@section("custom_css")
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="/backend/assets/css/broadcasts.css" /> --}}
    {{-- <link rel="stylesheet" href="backend/assets/css/all_users.css" /> --}}
@stop

@section('content')
    <div class="container-fluid">

        <div class="row page-title align-items-center">
            <div class="col-sm-4 col-xl-6">
                <h4 class="mb-1 mt-0">Broadcast Message</h4>
            </div>
        </div>

        @if(session('error'))
            <div class="row">
                <div class="col-12">
                    <p class="alert alert-danger"> {{ session('error') }} </p>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="row">
                <div class="col-12">
                    <p class="alert alert-success"> {{ session('success') }} </p>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('broadcast.create') }}" method="get">
                            <h3 class="card-title mb-4 float-sm-left">Choose a Message Template</h3>

                            <a href="{{ route('broadcast.create') }}" class="btn btn-primary float-right">
                                Create New &nbsp;<i class="fa fa-edit my-float"></i>
                            </a>

                            @if(isset($template))
                            @foreach($template as $temp)
                            <div class="row col-md-12">
                                <div class="col-md-12">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="mb-0"><input type="radio" name="temp" value="{{ $temp }}">&nbsp;{{ $temp }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            @endforeach
                            @endif
                            
                            {{--    <div class="col-md-12">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="mb-0"><input type="checkbox" name="temp[]"> We are now open!</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="mb-0"><input type="checkbox" name="temp[]"> New Stocks just arrived!</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="mb-0"><input type="checkbox" name="temp[]"> Happy new month. God Bless you.</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="mb-0"><input type="checkbox" name="temp[]"> Happy New Month.</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="mb-0"><input type="checkbox" name="temp[]"> Shop with ...., we Deliver!</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="mb-0"><input type="checkbox" name="temp[]"> Thank you for shopping with ...</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="mb-0"><input type="checkbox" name="temp[]"> We now sell Bobo!</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div> --}}

                            <button type= "submit" class="btn btn-primary">
                                Continue &nbsp;<i class="my-float"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("javascript")
@stop
