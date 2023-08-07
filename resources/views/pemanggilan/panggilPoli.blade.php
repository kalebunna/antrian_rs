@extends('layouts.app')
@section('style')
    <link href="{{ asset('templates/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="row">
        <div class="col-5">
            <div class="card border-start border-3 border-danger">
                <div class="card-header">
                    <h6>Panggil Antrian</h6>
                </div>
                <div class="card-body">
                    <label for="resepsionis">Pilih Loket</label>
                    <select name="poli" id="poli" class="form-control" onchange="updateData()">
                        @foreach ($polis as $item)
                            <option value="{{ $item->id }}" data-suara="{{ $item->suara }}">{{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    <h6 class="mt-2 text-center">Nomor Antrian :</h6>
                    <div class="text-center">
                        <b>
                            <h1 class="display-1 text-danger" id="nomorAntrian">-</h1>
                        </b>
                    </div>
                    <p class="text-center">Panggilan Ke <strong class="badge bg-dark" id="panggilanKe">0</strong></p>
                    <button type="button" class="btn btn-secondary w-100" disabled id="btnPanggilUlang"
                        onclick="panggilUlang()">Panggil
                        Ulang</button>
                    <button type="button" class="btn btn-info w-100 mt-2"
                        onclick="panggil_berikutnya()">Berikutnya</button>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card border-start border-3 border-info">
                <div class="card-header">
                    <h6>Data Antrian</h6>
                </div>
                <div class="card-body">
                    <table class="table-hover table" id="table-antrian">
                        <thead>
                            <tr>
                                <th>KODE</th>
                                <th>KATEGORI</th>
                                <th>Jenis</th>
                                <th>JAM</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('templates/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        var table;
        var id_poli;
        var idarahkan;
        $(() => {
            id_poli = $("#poli").find(":selected").val();
            let url = "{{ route('getArahkan', ':id') }}";
            url = url.replace(':id', id_poli);
            table = $("#table-antrian").DataTable({
                serverSide: true,
                "searching": false,
                ajax: url,
                columns: [{
                        data: 'no_antrian',
                        name: 'no_antrian',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kategori',
                        name: 'kategori',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'jenisKategori',
                        name: 'jenisKategori',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        })

        function updateData() {
            id_poli = $("#poli").find(":selected").val();
            let url = "{{ route('getArahkan', ':id') }}";
            url = url.replace(':id', id_poli);
            table.ajax.url(url).load();
        }

        function panggil_berikutnya() {
            id_poli = $("#poli").find(":selected").val();
            let url = "{{ route('getLastArahkan', ':id') }}";
            url = url.replace(':id', id_poli);
            $.get(url,
                function(data) {
                    if (data != "kosong") {
                        $("#nomorAntrian").html(data.no_antrian);
                        $("#panggilanKe").html(data.status);
                        $("#btnPanggilUlang").removeAttr('disabled');
                        inputToLog(data.no_antrian, $("#poli").find(':selected').attr('data-suara'));
                        idarahkan = data.id;

                    }
                },
                "json"
            );
        }

        function panggilUlang() {
            let url = "{{ route('arahkan.panggil_ulang', ':id') }}";
            url = url.replace(':id', idarahkan);
            console.log(url);
            $.get(url,
                function(data) {
                    $("#panggilanKe").html(data.status);
                    if ($("#panggilanKe").html() == "3") {
                        $("#btnPanggilUlang").attr('disabled', 'disabled');
                    }
                    inputToLog(data.no_antrian, $("#poli").find(':selected').attr('data-suara'));
                },
                "json"
            );
            // $.post(url,
            //     function(data) {
            //         data;
            //     },
            //     "json"
            // );
        }
        setInterval(() => {
            table.ajax.reload();
        }, 5000);
    </script>
@endsection
