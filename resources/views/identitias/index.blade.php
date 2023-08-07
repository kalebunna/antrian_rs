@extends('layouts.app')
@section('content')
<h3 class="gilroy-b mb-0">Pengaturan <a href="" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i></a></h3>
<span class="gilroy">Pengaturan awal aplikasi.</span>

<div class="row mt-2">
    <div class="col-6">
        <div class="card border-start border-3 border-info">
            <div class="card-body">
                <form action="{{ route('identitas.update', $identitas->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="jenis" value="identitas" required>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Nama Puskesmas</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="{{ $identitas->nama }}" name="nama" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Alamat</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="{{ $identitas->alamat }}" name="alamat" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Deskripsi </h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <textarea type="text" class="form-control" name="deskripsi" required>{{ $identitas->deskripsi }}
                            </textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>

        <div class="card radius-10 border-start border-3 border-warning border-0">
            <div class="card-header">
                <h5>Upload Logo</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('identitas.update', $identitas->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="jenis" value="logo">
                        <div class="col-8">
                            <input type="file" class="form-control" name="logo" id="logo" required>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-dark w-100"><i class="bx bx-cloud-upload mr-1"></i>Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card radius-10 border-start border-3 border-warning border-0">
            <div class="card-header">
                <h5>Upload Video</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('identitas.update', $identitas->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="jenis" value="video">
                    <div class="row">
                        <div class="col-8">
                            <input type="file" class="form-control" name="video" id="video" required>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-dark w-100"><i class="bx bx-cloud-upload mr-1"></i>Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <table class="table-bordered table">
                    <tbody>
                        <tr>
                            <td>Logo Aplikasi</td>
                            <td>
                                <img src="{{ Storage::url('public/logo/' . showIdentitas()->logo) }}" width="100" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td>Video Profil</td>
                            <td>
                                <video width="400" controls>
                                    <source src="{{ Storage::url('public/video/' . showIdentitas()->video) }}" type="video/mp4">
                                </video>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection