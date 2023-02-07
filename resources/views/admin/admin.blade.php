@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Rezervacijos') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5>Nepatvirtintos</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th width="5%">Nr.</th>
                                    <th width="15%">Vežimelis</th>
                                    <th width="15%">Užsakovas</th>
                                    <th width="15%">Periodas</th>
                                    <th width="15%">Statusas</th>
                                    <th width="10%">Kaina</th>
                                    <th width="5%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($newReservations as $reservation)
                                    <tr>
                                        <td>#{{$reservation->id}}</td>
                                        <td>#{{$reservation->stroller->id}}|{{$reservation->stroller->model}}</td>
                                        <td>{{$reservation->user->name}}</td>
                                        <td>{{date('Y-m-d', strtotime($reservation->dateFrom))}} - {{date('Y-m-d', strtotime($reservation->dateTo))}}</td>
                                        <td>
                                            @switch($reservation->status)
                                                @case('new')
                                                    <span class="alert alert-warning py-1">Nepatvirtintas</span>
                                                    @break
                                                @case('canceled')
                                                    <span class="alert alert-danger py-1">Atšauktas</span>
                                                    @break
                                                @case('approved')
                                                    <span class="alert alert-success py-1">Patvirtintas</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>{{ number_format(getReservationTotalPrice($reservation), 2) }}€</td>
                                        <td style="display: flex">
                                            <a href="{{ route('reservation.view', ['reservation' => $reservation->id]) }}">Peržiūrėti</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr/>
                        <h5>Patvirtintos</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th width="5%">Nr.</th>
                                    <th width="15%">Vežimelis</th>
                                    <th width="15%">Užsakovas</th>
                                    <th width="15%">Periodas</th>
                                    <th width="15%">Statusas</th>
                                    <th width="10%">Kaina</th>
                                    <th width="5%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($approvedReservations as $reservation)
                                    <tr>
                                        <td>#{{$reservation->id}}</td>
                                        <td>#{{$reservation->stroller->id}}|{{$reservation->stroller->model}}</td>
                                        <td>{{$reservation->user->name}}</td>
                                        <td>{{date('Y-m-d', strtotime($reservation->dateFrom))}} - {{date('Y-m-d', strtotime($reservation->dateTo))}}</td>
                                        <td>
                                            @switch($reservation->status)
                                                @case('new')
                                                    <span class="alert alert-warning py-1">Nepatvirtintas</span>
                                                    @break
                                                @case('canceled')
                                                    <span class="alert alert-danger py-1">Atšauktas</span>
                                                    @break
                                                @case('approved')
                                                    <span class="alert alert-success py-1">Patvirtintas</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>{{ number_format(getReservationTotalPrice($reservation), 2) }}€</td>
                                        <td style="display: flex">
                                            <a href="{{ route('reservation.view', ['reservation' => $reservation->id]) }}">Peržiūrėti</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr/>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Statistika') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5>Užsakymai</h5>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Patvirtintų
                                    <span class="badge badge-primary badge-pill">{{$countApproved}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Nepatvirtintų
                                    <span class="badge badge-primary badge-pill">{{$countNew}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Atšauktų
                                    <span class="badge badge-primary badge-pill">{{$countCanceled}}</span>
                                </li>
                            </ul>
                        <hr/>
                        <h5>Pajamos</h5>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Šio mėnesio
                                    <span class="badge badge-secondary badge-pill">{{ number_format($thisMonthTotal, 2) }}€</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Praėjusio mėnesio
                                    <span class="badge badge-secondary badge-pill">{{ number_format($lastMonthTotal, 2) }}€</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Šių metų
                                    <span class="badge badge-secondary badge-pill">{{ number_format($thisYearTotal, 2) }}€</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Praėjusių metų
                                    <span class="badge badge-secondary badge-pill">{{ number_format($lastYearTotal, 2) }}€</span>
                                </li>
                            </ul>
                        <hr/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
