@extends('dashboard.layout')
@section('content')
@section('title', 'Dashboard Adopsi')
<div class="col-md-12">

    @include('dashboard.flash.flash')
    <div class="d-flex justify-content-between mb-1">
        <a button type="button" href="{{ route('PostAdopsi.create') }}" class="btn btn-primary"
            style="margin-bottom: 10px; ">
            Buat Baru</a>

        <input type="text" class="form-control w-25 pull-right" placeholder="Cari post" id="search">
    </div>

    <table class="table table-striped table-bordered text-start shadow">
        <tbody>
            <thead>
                <tr>
                    <th class="px-2">#</th>
                    <th class="px-2">Nama Post</th>
                    <th class="px-2">Lokasi</th>
                    <th class="px-2">Syarat Adopsi</th>
                    <th class="px-2">Ras hewan</th>
                    <th class="px-2">Jenis hewan</th>
                    <th class="px-2">Action</th>
                </tr>
            </thead>

        </tbody>

    </table>
    {{ $PostAdopsi->links('pagination::bootstrap-4') }}

    <script>
        $('#search').on('keyup', function() {
            search();
        });
        search();

        function search() {
            var keyword = $('#search').val();
            $.post('{{ route('PostAdopsi.search') }}', {
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
            if (res.PostAdopsi.length <= 0) {
                htmlView += `
            <tr>
                <td colspan="4">No data.</td>
            </tr>`;
            }
            for (let i = 0; i < res.PostAdopsi.length; i++) {
                htmlView += `
            <tr>
            <td>` + (i + 1) + `</td>
                <td>` + res.PostAdopsi[i].nama_post + `</td>
                <td>` + res.PostAdopsi[i].lokasi + `</td>
                <td>` + res.PostAdopsi[i].syarat_adopsi + `</td>
                <td>` + res.PostAdopsi[i].ras_hewan.nama_ras + `</td>
                <td>` + res.PostAdopsi[i].ras_hewan.jenis_hewan.nama_jenis + `</td>
                <td>
                 <a href='/PostAdopsi/edit/` + res.PostAdopsi[i].id_post_adopsi + `' class='btn btn-success'>Edit 
                    <a href='/PostAdopsi/delete/` + res.PostAdopsi[i].id_post_adopsi + `' class='btn btn-danger mx-2'>Delete   </td>
            </tr>`;
            }
            $('tbody').html(htmlView);
        }
    </script>





</div>
@endsection
