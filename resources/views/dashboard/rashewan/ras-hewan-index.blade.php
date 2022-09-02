@extends('dashboard.layout')

@section('judul', 'Ras Hewan')


@section('content')
    <div class="container">
        <div class="row" style="padding: 30px">

            <div class="col-md-12">
                @include('dashboard.flash.flash')
            </div>
            <div class="col-md-4" style="border-radius:5px; margin-top:70px; ">

                <h4 style="margin-top:10px; text-align: center; color : black;">Tambah ras hewan baru</h4>
                <form action="{{ route('RasHewan.store') }}" method="post" style="box-shadow: grey 0 0 3px; margin-top: 15px"
                    class="p-3">
                    @csrf


                    {{-- Input untuk golongan jenis hewan dengan select option --}}
                    <div class="form-group">
                        <label for="jenis_hewan_id">
                            <h5>Golongan Jenis Hewan </h5>
                        </label>
                        <select type="text" name="id_jenis_hewan" id="id_jenis_hewan" class="form-control">
                            <option value="" hidden>Choose Animal</option>
                            @foreach ($JenisHewan as $data)
                                <option value="{{ $data->id_jenis_hewan }}">{{ $data->nama_jenis }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_ras">
                            <h5 class=""> Nama Ras Hewan </h5>
                        </label>
                        <input type="text" name="nama_ras" id="nama_ras" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_ras">
                            <h5 class=""> Asal Ras </h5>
                        </label>
                        <input type="text" name="asal_ras" id="asal_ras" class="form-control">
                    </div>


                    <div class="form-group">
                        <button class="btn btn-primary btn-md">
                            <i class="fa fa-send"></i> Save
                        </button>
                    </div>
                </form>
            </div>



            <div class="col-md-8" style=" border-radius:5px; margin-top:70px;">
                <table class="table"style="background-color: white; box-shadow: grey 0 0 3px; border-radius:5px;">
                    <div class="table-heading">
                        <h4 style="color: black; text-align:center; margin-top:10px; margin-bottom:10px">Data Ras Hewan
                        </h4>

                        {{-- Pencarian --}}
                        <div class="d-flex justify-content-end my-2">
                            <form type="GET" action="{{ route('RasHewan.search') }}">
                                <input type="text" name="pencarian" class="form-control w-50 d-inline" id="search"
                                    placeholder="Masukkan kata kunci">
                                <button type="submit" class="btn btn-primary mb-1">Cari</button>
                            </form>

                        </div>



                    </div>
                    <tbody>
                        {{-- Tabel --}}
                        <thead>
                            <tr style="background-color: #a0a9b3">
                                {{-- Nama Kolom --}}
                                <th>#</th>
                                <th>Ras Hewan</th>
                                <th>Jenis Hewan</th>
                                <th>Asal Ras</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                       
                    </tbody>
                </table>
                {{ $RasHewan->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <script>
        $('#search').on('keyup', function() {
            search();
        });
        search();

        function search() {
            var keyword = $('#search').val();
            $.post('{{ route('RasHewan.search') }}', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword
                },
                function(data) {
                    table_post_row(data);
                    console.log(data);
                });
        }
        // table row with ajax
        function table_post_row(res) {
            let htmlView = '';
            if (res.RasHewan.length <= 0) {
                htmlView += `
        <tr>
            <td colspan="4">No data.</td>
        </tr>`;
            }
            for (let i = 0; i < res.RasHewan.length; i++) {
                htmlView += `
        <tr>
        <td>` + (i + 1) + `</td>
            <td>` + res.RasHewan[i].nama_ras + `</td>
            <td>` + res.RasHewan[i].jenis_hewan.nama_jenis + `</td>
            <td>` + res.RasHewan[i].asal_ras + `</td>
            <td>
                 <a href='/RasHewan/edit/` + res.RasHewan[i].id_ras_hewan + `' class='btn btn-success'>Edit 
                    <a href='/RasHewan/delete/` + res.RasHewan[i].id_ras_hewan + `' class='btn btn-danger mx-2'>Delete   
                </td> 
            
        </tr>`;
            }
            $('tbody').html(htmlView);
        }
    </script>





@endsection
