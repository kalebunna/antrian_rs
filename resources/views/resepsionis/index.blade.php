@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3 class="gilroy-b mb-0">Resepsionis</h3>
            <span>Data Resepsionis</span>
        </div>
        <a href="" id="btn-add-contact" class="btn btn-info" id="btn-tambah" data-bs-toggle="modal"
            data-bs-target="#modal-tambah">
            <i class="ti ti-users fs-5 me-1 text-white"></i> Tambah Data
        </a>
    </div>
    <div class="alert alert-danger" role="alert" hidden id="alert">
        Data Tidak Dapat Di Hapus
    </div>

    <div class="alert alert-success" role="alert" hidden id="alert2">
        Data Telah Di Tambahkan Refresh Halaman
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table-striped table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resepsionis as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->kode }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>
                                        @if ($data->status == '1')
                                            <h5>
                                                <span class="badge bg-success">active</span>
                                            </h5>
                                        @else
                                            <span class="badge bg-danger">incative</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('resepsionis.edit', $data->id) }}"class="btn btn-outline-info btn-sm">
                                            <i class="bx bx-pencil me-0"></i>
                                        </a>
                                        <button type="button"
                                            onclick="hapus({{ $data->id }})"class="btn btn-outline-danger btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#modal-delete">
                                            <i class="bx bx-trash-alt me-0"></i>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tambah-->
    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" id="form-tambah" action="{{ route('resepsionis.store') }}">
                    <div class="modal-header d-flex align-items-center">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Kode</label>
                                <input type="text" class="form-control" required name="kode" id="kode">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Nama</label>
                                <input type="text" class="form-control" required name="nama" id="nama">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Suara</label>
                                <input type="text" class="form-control" required name="suara" id="suara">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Status</label>
                                <select name="status" id="status" required class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal"> kembali </button>
                        <button id="btn-add" class="btn btn-success rounded-pill px-4" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <i class="fas fa-exclamation-circle text-warning"></i> Apakah Anda Yakin Akan
                    Menghapus <i id="modal_nama_kategori"></i>
                </div>
                <div class="modal-footer">
                    <form method="POST" id="form-delete">
                        <button type="button" class="btn btn-secondary px-3 py-1" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger px-3 py-1">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal End --}}

    <!-- Modal tambah-->
    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" id="form-tambah" action="">
                    <div class="modal-header d-flex align-items-center">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">*
                                    </span>Kode</label>
                                <input type="text" class="form-control" required name="kode" id="kode-update">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">*
                                    </span>Nama</label>
                                <input type="text" class="form-control" required name="nama" id="nama-update">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">*
                                    </span>Suara</label>
                                <input type="text" class="form-control" required name="suara" id="nama-update">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">*
                                    </span>Status</label>
                                <select name="status" id="status-update" required class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal"> kembali </button>
                        <button id="btn-add" class="btn btn-success rounded-pill px-4" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#form-tambah").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('resepsionis.store') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processing: true,
                serverSide: true,
                dataType: 'json',
                data: $("#form-tambah").serializeArray(),
                success: function(data) {
                    $('#modal-tambah').modal('hide');
                    $("#alert2").removeAttr('hidden');
                },
                error: function(data) {
                    $('#modal-tambah').modal('hide');
                    // toastError("Data Kategori Gagal Di Tambah");
                }
            });
        });

        function hapus(prm) {
            var url = "{{ route('resepsionis.destroy', ':id') }}";
            url = url.replace(':id', prm);
            $("#form-delete").attr("action", url);
        }
        $("#form-delete").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $(this).attr('action'),
                data: {
                    '_method': 'delete'
                },
                success: function(response) {
                    location.reload(true);
                },
                error: function(data) {
                    $('#modal-delete').modal('hide');
                    $("#alert").removeAttr('hidden');
                }

            });
        })
    </script>
@endsection
