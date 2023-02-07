@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Rezervacijos</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
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
                        @foreach ($reservations as $reservation)
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
                                    @if($reservation->status === 'canceled')
                                        <form method="GET"
                                              action="{{ route('reservation.approve', ['reservation' => $reservation->id]) }}">
                                            @csrf
                                            <button class="btn btn-secondary my-1 py-1" type="submit">
                                                Patvirtinti
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
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
