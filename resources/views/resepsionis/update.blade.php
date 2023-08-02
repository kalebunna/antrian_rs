@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3 class="gilroy-b mb-0">Resepsionis</h3>
            <span>Update Resepsionis {{ $resepsionis->nama }}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-6">

            <div class="card">
                <div class="card-body">
                    <h6>Update Data</h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('resepsionis.update', $resepsionis->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Kode</label>
                                <input type="text" class="form-control" required name="kode" id="kode"
                                    value="{{ $resepsionis->kode }}">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Nama</label>
                                <input type="text" class="form-control" required name="nama" id="nama"
                                    value="{{ $resepsionis->nama }}">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Status</label>
                                <select name="status" id="status" required class="form-control">
                                    <option value="1" @if ($resepsionis->status == '1') selected @endif)>Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <a class="btn btn-warning" href="{{ route('resepsionis.index') }}">Kembali</a>
                        <button class="btn btn-info" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
