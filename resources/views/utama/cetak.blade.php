<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body class="bg-login">

    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-lg-0 my-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-11 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="rounded border p-4">
                                    <div class="text-center">
                                        <div class="mb-4 text-center">
                                            <img src="{{ Storage::url('public/logo/' . showIdentitas()->logo) }}"
                                                width="100" alt="" />
                                        </div>
                                        <h3 class="">{{ $identitas->nama }}</h3>
                                        <p>{{ $identitas->alamat }}</p>
                                    </div>
                                    <hr>
                                    <h4 class="text-center">Tekan Tombol Dibawah Untuk Mencetak Antrian</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="col-6">
                                            <form action="" method="post">
                                                <a href="{{ route('antrian.create', ['umum', $token->token]) }}"
                                                    class="btn btn-success w-100 my-4 pt-3 shadow-sm">
                                                    <h3 class="text-white">UMUM</h3>
                                                </a>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-success w-100 my-4 pt-3 shadow-sm"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <h3 class="text-white">PRIORITAS</h3>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
    <!--end wrapper-->

    <!-- Modal -->
    <div class="modal modal-lg fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Pilih Kategori</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a href="{{ route('antrian.create', ['prioritas', $token->token, 'lansia']) }}"
                        class="btn btn-warning w-100 my-1 pt-3">
                        <h3 class="text-white">LANSIA</h3>
                    </a>
                    <a href="{{ route('antrian.create', ['prioritas', $token->token, 'Bayi & Ibu Hamil']) }}"
                        class="btn btn-info w-100 my-1 pt-3">
                        <h3 class="text-white">BAYI & IBU HAMIL</h3>
                    </a>
                    <a href="{{ route('antrian.create', ['prioritas', $token->token, 'Disabilitas']) }}"
                        class="btn btn-primary w-100 my-1 pt-3">
                        <h3 class="text-white">DISABILITAS</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.foot')
</body>

</html>
