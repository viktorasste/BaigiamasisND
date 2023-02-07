@extends('layouts.public')

@section('content')
<div class="row m-5">
    @foreach ($strollers as $stroller)
        <div class="col-sm-3">
            <div class="card">
                <img src="/uploads/images/{{ $stroller->image }}" class="card-img-top"
                     style="max-height: 250px;" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $stroller->model }}</h5>
                    <p class="card-text">{{ $stroller->description }}</p>
                </div>
                <ul class="list-group list-group-flush px-0">
                    <li class="list-group-item"><b>Tipas</b>: {{ $stroller->type }}</li>
                    <li class="list-group-item"><b>Metai</b>: {{ $stroller->year }}</li>
                    <li class="list-group-item"><b>Svoris</b>: {{ $stroller->weight }}</li>
                    <li class="list-group-item"><b>Max. vaiko svoris</b>: {{ $stroller->max_weight }}</li>
                </ul>

                <div class="card-body">
                    <h5 class="card-title text-center">{{ number_format($stroller->price, 2) }}€/diena</h5>
                </div>
                <div class="card-footer text-muted text-center">

                    @guest
                        <p class="text-warning">Rezervuotis gali tik prisijunge žmonės.</p>
                    @else
                        <a class="btn btn-info" href="#" data-bs-toggle="modal"
                           data-bs-target="#reservationModal{{ $stroller->id }}">Rezervuoti</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="modal fade" id="reservationModal{{ $stroller->id }}" tabindex="-1"
             aria-labelledby="loginModalTitle"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('reservation.submit', ['stroller' => $stroller->id]) }}" method="POST"
                      style="display: contents;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="loginModalTitle">Rezervacija
                                "{{ $stroller->model }}"</h1>
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
</div>
@endsection
