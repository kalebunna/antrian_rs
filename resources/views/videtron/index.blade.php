<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ showIdentitas()->nama }}</title>
    @include('layouts.head')
</head>

<body class="bg-login">
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container-fluid text-white">
            <table class="w-100">
                <tr>
                    <td width="10">
                        <img src="{{ asset('images/' . showIdentitas()->logo) }}" width="50" alt="logo icon">
                    </td>
                    <td class="align-middle">
                        <h3 class="gilroy-b text-white">
                            {{ showIdentitas()->nama }}
                        </h3>
                        <span></span>
                    </td>
                    <td class="gilroy-b align-middle">
                        <p class="gilroy-b mb-2 text-center"><i class="bi bi-calendar4-week"></i> {{-- tanggal --}}
                        </p>

                        <!-- <span class="badge text-bg-white w-100" style="font-size: 20px">
                                                                <i class="bi bi-clock"></i>
                                                                <span id="jam"></span>
                                                            </span> -->
                    </td>
                </tr>
            </table>
        </div>
    </nav>

    <div class="container-fluid mb-5 mt-3">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body bg-gradient-blues">
                        <video autoplay muted width="100%" loop height="300">
                            <source src="{{ asset('video/' . showIdentitas()->video) }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <!-- antrian ditangani -->
                <div class="row" id="data-resepsionis">
                    @foreach ($resepsioniss as $data)
                        <div class="col row">
                            <div class="col">
                                <div class="card radius-15 text-center">
                                    <div class="bg-gradient-orange text-white">
                                        <h3 class="mt-2 text-white">{{ $data->nama }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <h6>No Antrian</h6>
                                        <h1 class="display-3 fw-bold" id="resepsionis{{ $data->id }}"
                                            data-id="{{ $data->id }}">-</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- end antrian ditangani -->
            </div>
        </div>
        <!-- antiran poli -->
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body bg-gradient-ohhappiness text-white">
                        Jumlah Antrian Poli
                        <div class="row" id="data-poli">
                            @foreach ($poli as $data)
                                <div class="col">
                                    <div class="card radius-15 text-center">
                                        <div class="bg-gradient-orange text-white">
                                            <h5 class="mt-2 text-white">{{ $data->nama }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <h6>No Antrian</h6>
                                            <h1 class="fw-bold display-6" id="poli{{ $data->id }}"
                                                data-id="{{ $data->id }}">-</h1>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end antrian poli -->
    </div>

    <div class="card fixed-bottom">
        <div class="card-body bg-success pb-0 pt-0" style="padding-left: 0;">
            <div class="row">
                <div class="col-2 bg-white text-center">
                    <table width="100%" height="100%">
                        <tr>
                            <td class="gilroy-b align-middle"></td>
                            <td>
                                <h3 id="clock-wrapper"></h3>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-10">
                    <marquee>
                        <h4 class="gilroy-b mb-0 text-white">{{ showIdentitas()->deskripsi }}</h4>
                    </marquee>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.foot')
</body>
<script>
    function update_resepsionis() {
        $('#data-resepsionis h1').each(function() {
            let id = $(this).attr('id')
            let link = "{{ route('videotron.antrian', ':id') }}"
            link = link.replace(':id', $(this).attr('data-id'));
            $.get(link,
                function(data) {
                    if (data.data != null) {
                        $("#" + id).html(data.data.antrian.no_antrian);
                    }
                },
                "json"
            );
        });
    }

    function update_poli() {
        $('#data-poli h1').each(function() {
            let id = $(this).attr('id')
            let link = "{{ route('videotron.arahkan', ':id') }}"
            link = link.replace(':id', $(this).attr('data-id'));
            $.get(link,
                function(data) {
                    if (data.data != null) {
                        console.log(data);
                        $("#" + id).html(data.data.no_antrian)
                    }
                    "json"
                    // );
                });
        });
    }
    setInterval(() => {
        update_poli();
        update_resepsionis();
    }, 1000);
</script>

</html>
