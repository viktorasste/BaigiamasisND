@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Rezervacijos</h1>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Vežimėlis</h3>
                            <h5>{{$reservation->stroller->model}}</h5>
                            <p class="card-text">{{$reservation->stroller->description}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Tipas</b>: {{ $reservation->stroller->type }}</li>
                            <li class="list-group-item"><b>Metai</b>: {{ $reservation->stroller->year }}</li>
                            <li class="list-group-item"><b>Svoris</b>: {{ $reservation->stroller->weight }}</li>
                            <li class="list-group-item"><b>Max. vaiko
                                    svoris</b>: {{ $reservation->stroller->max_weight }}</li>
                        </ul>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ number_format($reservation->stroller->price, 2) }}
                                €/diena</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Užsakovas</h3>
                            <h5>{{$reservation->user->name}}</h5>
                            <p class="card-text">{{$reservation->user->email}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Užsakymo detalės</h3>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <b>Užsakymo numeris</b>: #{{$reservation->id}}</li>
                            <li class="list-group-item">
                                <b>Užsakymo data</b>: {{date('Y-m-d H:i:s', strtotime($reservation->created_at))}}</li>
                            <li class="list-group-item">
                                <b>Laikotarpis</b>: {{date('Y-m-d', strtotime($reservation->dateFrom))}}
                                - {{date('Y-m-d', strtotime($reservation->dateTo))}}</li>
                            <li class="list-group-item"><b>Statusas</b>: @switch($reservation->status)
                                    @case('new')
                                        <span class="alert alert-warning py-1">Nepatvirtintas</span>
                                        @break
                                    @case('canceled')
                                        <span class="alert alert-danger py-1">Atšauktas</span>
                                        @break
                                    @case('approved')
                                        <span class="alert alert-success py-1">Patvirtintas</span>
                                        @break
                                @endswitch</li>
                        </ul>
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                <b>{{ number_format(getReservationTotalPrice($reservation), 2) }}€</b></h5>
                        </div>
                        <div class="card-footer text-muted text-center d-inline-flex justify-content-center">
                            @if($reservation->status === 'new')
                                <form method="GET"
                                      action="{{ route('reservation.approve', ['reservation' => $reservation->id]) }}">
                                    @csrf
                                    <button class="btn btn-secondary my-1 py-1 mx-1" type="submit">
                                        Patvirtinti
                                    </button>
                                </form>
                                <form method="GET"
                                      action="{{ route('admin.reservation.cancel', ['reservation' => $reservation->id]) }}">
                                    @csrf
                                    <button class="btn btn-secondary my-1 py-1 mx-1" type="submit">
                                        Atšaukti
                                    </button>
                                </form>
                            @else
                                <form method="GET"
                                      action="{{ route('admin.reservation.cancel', ['reservation' => $reservation->id]) }}">
                                    @csrf
                                    <button class="btn btn-secondary my-1 py-1" type="submit">
                                        Atšaukti
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
