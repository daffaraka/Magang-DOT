@extends('dashboard.layout')

@section('judul', 'Buat List Jenis Hewan')

@section('content')


    <div class="container">

        <div class="row">

            <div class="col-md-5" style="padding:30px">

                @include('dashboard.flash.flash')

                <form action="{{ route('JenisHewan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label >Nama Jenis Hewan</label>
                        <input type="text" name="nama_jenis" class="form-control">
                    </div>
              

                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>

            </div>
        </div>
    </div>

@endsection
