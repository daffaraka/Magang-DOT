@extends('dashboard.layout')

@section('judul', 'Daftar Jenis Hewan')

@section('content')
    <div class="col-md-12" style="padding: 20px">
        @include('dashboard.flash.flash')
        <div class="d-flex justify-content-between">
            <a button type="button" href="{{ route('JenisHewan.create') }}" class="btn btn-primary"
                style="margin-bottom: 10px; "> Buat Baru</a>
            <input type="text" class="form-control w-25 pull-right" placeholder="Cari jenis hewan" id="search">
        </div>


        <div class="col-md-12">
            <table class="table table-striped table-bordered text-start shadow">
                <tbody>
                    <thead>
                        <tr>
                            <th class="px-2">#</th>
                            <th class="px-2">Jenis Hewan</th>
                            <th class="px-2">Action</th>
                        </tr>
                    </thead>

                    {{-- @foreach ($JenisHewan as $d)
                        <tr class="px-2">
                            <td class="px-2"> {{ $d->nama_jenis }} </td>
                            <td class="px-2">
                                <a href="{{ route('JenisHewan.edit', $d) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('JenisHewan.destroy', $d->id_jenis_hewan) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach --}}


                </tbody>

            </table>
            {{ $JenisHewan->links() }}
        </div>

        <script>
            $('#search').on('keyup', function() {
                search();
            });
            search();

            function search() {
                var keyword = $('#search').val();
                $.post('{{ route('JenisHewan.search') }}', {
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
                if (res.JenisHewan.length <= 0) {
                    htmlView += `
            <tr>
                <td colspan="4">No data.</td>
            </tr>`;
                }
                for (let i = 0; i < res.JenisHewan.length; i++) {
                    htmlView += `
            <tr>
            <td>` + (i + 1) + `</td>
                <td>` + res.JenisHewan[i].nama_jenis + `</td>
                <td>
                     <a href='/JenisHewan/edit/`+res.JenisHewan[i].id_jenis_hewan+`' class='btn btn-success'>Edit 
                        <a href='/JenisHewan/delete/`+res.JenisHewan[i].id_jenis_hewan+`' class='btn btn-danger mx-2'>Delete    
                
            </tr>`;
                }
                $('tbody').html(htmlView);
            }
        </script>


    </div>

@endsection
