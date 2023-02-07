@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Redaguoti vežimėlį</h1>
            <a href="{{route('stroller')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Grįžti atgal</a>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="{{route('stroller.update', ['stroller' => $stroller->id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Paveiksliukas') }}</label>

                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image', $stroller->image) }}" autocomplete="image">

                            <img src="/uploads/images/{{ $stroller->image }}" style="width:80px;margin-top: 10px;">

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="model"><span style="color:red;">*</span>Modelis</label>
                                <input
                                    type="text"
                                    class="form-control form-control-user @error('model') is-invalid @enderror"
                                    id="model"
                                    placeholder="Modelis"
                                    name="model"
                                    value="{{ old('model', $stroller->model) }}">

                                @error('model')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="exampleType"><span style="color:red;">*</span>Tipas</label>
                                <select name="type" id="exampleType"
                                        class="form-control @error('type') is-invalid @enderror">
                                    <option value="normal" @if(old('type', $stroller->type) === 'normal') selected @endif>Vaikiški skėtuko formos</option>
                                    <option value="three" @if(old('type', $stroller->type) === 'three') selected @endif>Triračiai vaikiški vežimėliai</option>
                                    <option value="double" @if(old('type', $stroller->type) === 'double') selected @endif>Dvynukams skirti vežimėliai</option>
                                    <option value="sport" @if(old('type', $stroller->type) === 'sport') selected @endif>Sportiniai vežimėliai vaikams</option>
                                    <option value="universal" @if(old('type', $stroller->type) === 'universal') selected @endif>Universalūs vaikiški vežimėliai</option>
                                </select>
                                @error('type')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="exampleYear"><span style="color:red;">*</span>Pagaminimo metai</label>
                                <input
                                    type="text"
                                    class="form-control form-control-user @error('year') is-invalid @enderror"
                                    id="exampleYear"
                                    placeholder="Pagaminimo metai"
                                    name="year"
                                    value="{{ old('year', $stroller->year) }}">

                                @error('year')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="exampleWeight"><span style="color:red;">*</span>Vežimėlio svoris</label>
                                <input
                                    type="text"
                                    class="form-control form-control-user @error('weight') is-invalid @enderror"
                                    id="exampleWeight"
                                    placeholder="Vežimėlio svoris"
                                    name="weight"
                                    value="{{ old('weight', $stroller->weight) }}">

                                @error('weight')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="exampleMaxWeight"><span style="color:red;">*</span>Maksimalus vaiko
                                    svoris</label>
                                <input
                                    type="text"
                                    class="form-control form-control-user @error('max_weight') is-invalid @enderror"
                                    id="exampleMaxWeight"
                                    placeholder="Maksimalus vaiko svoris"
                                    name="max_weight"
                                    value="{{ old('max_weight', $stroller->max_weight) }}">

                                @error('max_weight')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="exampleDesription"><span style="color:red;">*</span>Aprašymas</label>
                                <textarea
                                    class="form-control form-control-user @error('description') is-invalid @enderror"
                                    id="exampleDesription"
                                    placeholder="Aprašymas"
                                    name="description">{{ old('description', $stroller->description) }}</textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="examplePrice"><span style="color:red;">*</span>Kaina</label>
                                <input
                                    type="text"
                                    class="form-control form-control-user @error('price') is-invalid @enderror"
                                    id="examplePrice"
                                    placeholder="Kaina"
                                    name="price"
                                    value="{{ old('price', $stroller->price) }}">

                                @error('price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Save Button --}}
                    <button type="submit" class="btn btn-success btn-user btn-block mt-3">
                        Redaguoti
                    </button>

                </form>
            </div>
        </div>

    </div>

@endsection
