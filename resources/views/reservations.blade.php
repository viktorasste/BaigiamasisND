@extends('layouts.public')

@section('content')
    @foreach ($reservations as $reservation)
        <div class="col-sm-3">
            <div class="card">
                <img src="/uploads/images/{{ $reservation->stroller->image }}" class="card-img-top"
                     style="max-height: 250px;" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $reservation->stroller->model }}</h5>
                    <p class="card-text">{{ $reservation->stroller->description }}</p>
                </div>
                <ul class="list-group list-group-flush px-0">
                    <li class="list-group-item"><b>Tipas</b>: {{ $reservation->stroller->type }}</li>
                    <li class="list-group-item"><b>Metai</b>: {{ $reservation->stroller->year }}</li>
                    <li class="list-group-item"><b>Svoris</b>: {{ $reservation->stroller->weight }}</li>
                    <li class="list-group-item"><b>Max. vaiko svoris</b>: {{ $reservation->stroller->max_weight }}</li>
                </ul>

                <div class="card-body">
                    <h5 class="card-title text-center">{{ number_format(getReservationTotalPrice($reservation), 2) }}€</h5>
                    <p class="text-center mb-0"><small>({{ number_format($reservation->price, 2) }}€/diena)</small></p>
                </div>
                <div class="card-footer text-muted text-center">
                    @if($reservation->status == 'new')
                        <div class="alert alert-secondary" role="alert">
                            Rezervacija laukia patvirtinimo!
                        </div>
                        <a class="btn btn-danger" href="{{route('reservation.cancel', ['reservation' => $reservation->id])}}">Atšaukti rezervacija</a>
                    @elseif($reservation->status == 'canceled')
                        <div class="alert alert-warning" role="alert">
                            <p class="my-0">Rezervacija atšaukta!</p>
                            <p class="my-0"><small>{{$reservation->canceledDate}}</small></p>

                        </div>
                    @else
                        <div class="alert alert-secondary" role="alert">
                            Rezervacija patvirtinta ir laukiama apmokėjimo.
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="modal fade" id="reservationModal{{ $reservation->stroller->id }}" tabindex="-1"
             aria-labelledby="loginModalTitle"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('reservation.submit', ['stroller' => $reservation->stroller->id]) }}" method="POST"
                      style="display: contents;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="loginModalTitle">Rezervacija
                                "{{ $reservation->stroller->model }}"</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input class="form-control form-control-lg" type="text" name="dates"
                                   placeholder=".form-control-lg">
                        </div>
                        <div class="modal-footer">
                            <div class="row mb-0">
                                <div class="col">
                                    <button type="submit" class="btn btn-success btn-block mt-3">
                                        Rezervuoti
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
