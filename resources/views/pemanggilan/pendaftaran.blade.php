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
                    <select name="resepsionis" id="resepsionis" class="form-control">
                        @foreach ($lokets as $item)
                            <option value="{{ $item->id }}" data-nama="{{ $item->nama }}">{{ $item->nama }}</option>
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
                                <th>JAM</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit-->
    <div class="modal fade" id="modal_arahkan" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title">Update Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Arahkan Pasien Ke :</h5>
                    @foreach ($polis as $poli)
                        {{-- <form action="{{ route('arahkan.store') }}" id="form-arahkan">
                            <input type="hidden" name="poli_id" value="{{ $poli->id }}">
                            <input type="submit" class="btn btn-danger w-100 mt-2">
                        </form> --}}

                        <a href="#" onclick="arahkan({{ $poli->id }})"
                            class="btn btn-danger w-100 mt-2">{{ $poli->nama }}</a>
                    @endforeach
                    <hr>
                    <a href="" class="btn btn-danger w-100 mt-2">Pasien Tidak Hadir</a>
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
        var id_antrian;
        $(() => {
            table = $("#table-antrian").DataTable({
                serverSide: true,
                "searching": false,
                ajax: "{{ route('getAntrian') }}",
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
                        data: 'tanggal',
                        name: 'tanggal',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        })

        function panggil_berikutnya() {
            if ($("#nomorAntrian").html() != "-") {
                $("#modal_arahkan").modal('show');
            } else {
                let resepsionis_id = $("#resepsionis").find(":selected").val();
                let url = "{{ route('getLastAntrian', ':id') }}";
                url = url.replace(':id', resepsionis_id);

                $.get(url,
                    function(data) {
                        if (data != "kosong") {
                            console.log("res" + $("#resepsionis").find(':selected').attr('data-nama'));
                            $("#nomorAntrian").html(data.no_antrian);
                            $("#panggilanKe").html(data.status);
                            $("#btnPanggilUlang").removeAttr('disabled');
                            inputToLog('nomor Antrian ' + convertUrutan(data.no_antrian) + " Menuju Ke " +
                                $("#resepsionis").find(':selected').attr('data-nama'));
                            id_antrian = data.id;
                        }
                    },
                    "json"
                );
            }
        }

        function arahkan(idPoli) {
            let url = "{{ route('arahkan.store', [':idpoli', ':idantrian']) }}";
            url = url.replace(':idpoli', idPoli);
            url = url.replace(':idantrian', id_antrian);
            window.location.href = url;
        }

        setInterval(() => {
            table.ajax.reload();
        }, 5000);

        function panggilUlang() {
            let url = "{{ route('antrian.panggil_ulang', ':id') }}";
            url = url.replace(':id', id_antrian);
            console.log(url);
            $.get(url,
                function(data) {
                    $("#panggilanKe").html(data.status);
                    if ($("#panggilanKe").html() == "3") {
                        $("#btnPanggilUlang").attr('disabled', 'disabled');
                    }
                    inputToLog('nomor Antrian ' + convertUrutan(data.no_antrian) + " Menuju Ke " +
                        $("#resepsionis").find(':selected').attr('data-nama'));
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
    </script>
@endsection
