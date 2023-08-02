@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3 class="gilroy-b mb-0">Poli</h3>
            <span>Data Poli</span>
        </div>
        <a href="{{ route('poli.create') }}" id="btn-add-contact" class="btn btn-info">
            <i class="ti ti-users fs-5 me-1 text-white"></i> Tambah Data
        </a>
    </div>
    <div class="alert alert-danger" role="alert" hidden id="alert">
        Data Tidak Dapat Di Hapus
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
                                <th>Kode Antrian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($polis as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->kode }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->kode_antrian }}</td>
                                    <td>
                                        <a href="{{ route('poli.edit', $data->id) }}" class="btn btn-outline-info btn-sm">
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
@endsection
@section('js')
    <script>
        function hapus(prm) {
            var url = "{{ route('poli.destroy', ':id') }}";
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
                    $('#modal-delete').modal('hide');
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
