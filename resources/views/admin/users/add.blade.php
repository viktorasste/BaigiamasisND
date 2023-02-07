@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pridėti naują vartotoją</h1>
            <a href="{{route('users')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Grįžti atgal</a>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="{{route('users.store')}}">
                    @csrf
                    <div class="form-group row">

                        {{-- Name --}}
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="exampleName"><span style="color:red;">*</span>Vartotojo vardas</label>
                                <input
                                    type="text"
                                    class="form-control form-control-user @error('name') is-invalid @enderror"
                                    id="exampleName"
                                    placeholder="Vartotojo vardas"
                                    name="name"
                                    value="{{ old('name') }}">

                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>


                        {{-- Email --}}
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="exampleEmail"><span style="color:red;">*</span>El. paštas</label>
                                <input type="text"
                                       class="form-control form-control-user @error('email') is-invalid @enderror"
                                       id="exampleEmail"
                                       placeholder="El. paštas"
                                       name="email"
                                       value="{{ old('email') }}">

                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Save Button --}}
                    <button type="submit" class="btn btn-success btn-user btn-block mt-3">
                        Išsaugoti
                    </button>

                </form>
            </div>
        </div>

    </div>

@endsection
