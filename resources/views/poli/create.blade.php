@extends('layouts.app')
@section('content')
    <h3 class="gilroy-b mb-0">Poli</h3>
    <span>Tambah Data Poli</span>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <form method="POST" id="form-tambah" action="{{ route('poli.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">*
                                    </span>Kode</label>
                                <input type="text" class="form-control" required name="kode" id="kode">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">*
                                    </span>Nama</label>
                                <input type="text" class="form-control" required name="nama" id="nama">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">*
                                    </span>Kode Antrian</label>
                                <input type="text" class="form-control" required name="kode_antrian" id="kode_antrian">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">*
                                    </span>Status</label>
                                <select name="status" id="status" required class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal"> kembali </button>
                        <button id="btn-add" class="btn btn-success rounded-pill px-4" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
