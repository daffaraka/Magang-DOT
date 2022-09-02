@extends('dashboard.layout')
@section('title', 'Buat Adopsi')
@section('content')

    @include('dashboard.flash.flash')
    <div class="col-md-12">
        <form action="{{ route('PostAdopsi.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nama_ras">
                    <h5> Jenis Hewan </h5>
                </label>
                <select name="id_ras_hewan" class="form-control" id="jenis-hewan-dropdown">
                    @foreach ($JenisHewan as $data)
                        <option value="{{ $data->id_jenis_hewan }}">{{ $data->nama_jenis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nama_ras">
                    <h5> Nama Ras Hewan </h5>
                </label>
                <select name="id_ras_hewan" class="form-control" id="ras-hewan-dropdown">
                 
                </select>
            </div>
            <div class="form-group">
                <label for="nama_post">
                    <h5 class=""> Judul/Nama Post </h5>
                </label>
                <input type="text" name="nama_post" id="nama_post" class="form-control">
            </div>
            <div class="form-group">
                <label for="nama_post">
                    <h5 class=""> Lokasi </h5>
                </label>
                <input type="text" name="lokasi" id="lokasi" class="form-control">
            </div>
            <div class="form-group">
                <label for="nama_post">
                    <h5 class=""> Syarat </h5>
                </label>
                <input type="text" name="syarat_adopsi" id="syarat" class="form-control">
            </div>

            <button type="submit" class="btn btn-info">Submit</button>
        </form>
    </div>
    <script>
        $('#jenis-hewan-dropdown').on('change', function () {
                var id_jenis_hewan = this.value;
                $("#ras-hewan-dropdown").html('');
                $.ajax({
                    url: "{{url('PostAdopsi/find-ras-hewan')}}",
                    type: "GET",
                    data: {
                        id_jenis_hewan: id_jenis_hewan,
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#ras-hewan-dropdown').html('<option value="">Pilih Ras Hewan</option>');
                        $.each(result.findRasHewan, function (key, value) {
                            $("#ras-hewan-dropdown").append('<option value="' + value
                                .id_ras_hewan + '">' + value.nama_ras + '</option>');
                        });
                    
                    }
                });
            });
    </script>
@endsection
