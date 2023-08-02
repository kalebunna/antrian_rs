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
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="rounded border p-4">
                                    <div class="text-center">
                                        <div class="mb-4 text-center">
                                            <img src="{{ asset('images/' . $identitas->logo) }}" width="100"
                                                alt="" />
                                        </div>
                                        <h3 class="">{{ $identitas->nama }}</h3>
                                        <p>{{ $identitas->alamat }}</p>
                                    </div>
                                    <hr>
                                    <h4 class="text-center">Tekan Tombol Dibawah Untuk Mencetak Antrian</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{ route('antrian.create', 'umum') }}"
                                                class="btn btn-warning w-100 my-4 pt-3 shadow-sm">
                                                <h3 class="text-white">UMUM</h3>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('antrian.create', 'prioritas') }}"
                                                class="btn btn-primary w-100 my-4 pt-3 shadow-sm">
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
        <!--end wrapper-->
        @include('layouts.foot')
</body>

</html>
