@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Važimėliai</h1>
            <a href="{{route('stroller.create')}}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Pridėti naują vežimėlį
            </a>
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
                            <th width="30%">Modelis</th>
                            <th width="30%">Tipas</th>
                            <th width="10%">Kaina</th>
                            <th width="5%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($strollers as $stroller)
                            <tr>
                                <td>#{{$stroller->id}}</td>
                                <td>{{$stroller->model}}</td>
                                <td>
                                    @switch($stroller->type)
                                        @case('normal')
                                            Vaikiški skėtuko formos
                                            @break
                                        @case('three')
                                            Triračiai vaikiški vežimėliai
                                            @break
                                        @case('double')
                                            Dvynukams skirti vežimėliai
                                            @break
                                        @case('sport')
                                            Sportiniai vežimėliai vaikams
                                            @break
                                        @case('universal')
                                            Universalūs vaikiški vežimėliai
                                            @break
                                    @endswitch
                                </td>
                                <td>{{ number_format($stroller->price, 2) }}€</td>
                                <td style="display: flex">
                                    <form method="GET"
                                          action="{{ route('stroller.edit', ['stroller' => $stroller->id]) }}">
                                        @csrf
                                        <button class="btn btn-secondary m-2" type="submit">
                                            Redaguoti
                                        </button>
                                    </form>

                                    <form method="POST"
                                          action="{{ route('stroller.destroy', ['stroller' => $stroller->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-2" type="submit">
                                            x
                                        </button>
                                    </form>
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
