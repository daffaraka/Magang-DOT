@extends('dashboard.layout')

@section('judul','Update Ras Hewan')

@section('content')
<div class="container">
    <div class="row" style="padding: 20px">
       
        <div class="col-md-8">
            <form action="{{ route('RasHewan.update',$RasHewan->id_ras_hewan) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_jenis_hewan"> Nama Ras Hewan</label>
                    <select  name="id_jenis_hewan" class="form-control">
                        @foreach ($JenisHewan as $pilihan)
                        <option {{old('id_jenis_hewan',$pilihan->id_jenis_hewan) == $RasHewan->id_jenis_hewan ? 'selected':''}} value="{{$pilihan->id_jenis_hewan}}">{{$pilihan->nama_jenis}}</option>
                        @endforeach
                      
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_jenis_hewan"> Nama Ras Hewan</label>
                    <input type="text" name="nama_ras" id="nama_ras" class="form-control" value="{{$RasHewan->nama_ras}}">
                </div>
                <div class="form-group">
                    <label for="nama_jenis_hewan">Asal Ras</label>
                    <input type="text" name="asal_ras" id="asal_ras" class="form-control" value="{{$RasHewan->asal_ras}}">
                </div>
                <div class="form-group" style="margin-top: 10px;">
                    <button class="btn btn-primary" type="submit"> Simpan </button>
                    <a href="{{route('RasHewan.index')}}" class="btn btn-secondary" style="margin-left: 10px"> Kembali </a>
                </div>
            </form>
        </div>
       
    </div>
</div>
@endsection