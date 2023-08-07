@extends('layouts.app')
@section('content')
    <div class="mt-3">
        <div class="card">
            <div class="card-body">

                <table class="table" id="table-log">
                    <thead>
                        <tr>
                            <th style="width: 10%">ID</th>
                            <th>Text</th>
                        </tr>
                    </thead>
                    <tbody id="first">
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var dataFromServer;
        // const ut = new window.SpeechSynthesisUtterance('No warning should arise');
        $(async () => {
            await retriveData();
            panggil();
        });

        function startRetrievingData() {
            console.log("retrive");
            retriveData().then(() => {
                panggil();
            });
        }

        async function retriveData() {
            return new Promise((resolve, reject) => {
                $.get("{{ route('logPanggilan.index') }}",
                    function(data) {
                        console.log("data telah di retrive");
                        dataFromServer = data;
                        data.forEach(element => {
                            $('#table-log > tbody:first').append(`
                    <tr>
                        <td id="id">` + element.kode + `</td>
                        <td panggilan="panggilan">` + element.menuju + `</td>
                        </tr>
                            `);
                        });
                        resolve()
                    },
                    "json"
                );
            });
        }

        async function panggil() {
            let promiseChain = Promise.resolve();

            for (const element of dataFromServer) {
                promiseChain = promiseChain.then(() => antrianPanggilan(element.kode, element));
            }

            promiseChain.then(() => {
                setTimeout(startRetrievingData, 1000);
            });
        }

        async function antrianPanggilan(text, element) {
            return new Promise(resolve => {
                let bagian = text.split(' ');

                hapus(element.id);
                const bel = new Audio("{{ asset('suara/bell1.mp3') }}");
                bel.play();
                bel.addEventListener("ended", function() {
                    bel.pause();
                    // let url = "{{ asset('suara/:suara') }}"
                    let kodeSuara = bagian[0].toLowerCase();
                    // url = url.replace(':suara', kodeSuara + ".wav");
                    // console.log(url);
                    let no = bagian[1];

                    const no_antrian = new Audio("{{ asset('suara/no_antrian.wav') }}");
                    no_antrian.play();

                    no_antrian.addEventListener("ended", function() {
                        no_antrian.pause();

                        const kode_antrian = new Audio(convertAssetWav(kodeSuara));
                        kode_antrian.play();

                        kode_antrian.addEventListener("ended", function() {
                            kode_antrian.pause();

                            if (parseInt(no) > 20 && parseInt(no) < 100) {
                                console.log(1);
                                const puluh = no.toString().substring(0, 1) + 0;
                                const nomer = new Audio(convertAssetWav(puluh));
                                nomer.play();

                                nomer.addEventListener("ended", function() {
                                    nomer.pause();

                                    const number = no.toString().substring(1, 2)

                                    if (number != 0) {
                                        const angka = new Audio(convertAssetWav(
                                            number));
                                        angka.play();

                                        angka.addEventListener("ended",
                                            function() {
                                                angka.pause();
                                                const menujuKe = new Audio(
                                                    convertAssetMp3(
                                                        "segera menuju")
                                                )
                                                menujuKe.play();
                                                menujuKe.addEventListener(
                                                    "ended",
                                                    function() {
                                                        menujuKe
                                                            .pause();

                                                        const tujuan =
                                                            new Audio(
                                                                convertAssetMp3(
                                                                    element
                                                                    .menuju
                                                                )
                                                            );
                                                        tujuan.play();
                                                        tujuan
                                                            .addEventListener(
                                                                "ended",
                                                                function() {
                                                                    resolve
                                                                        ();
                                                                }
                                                            );
                                                    })
                                            })

                                    } else {
                                        const menujuKe = new Audio(
                                            convertAssetMp3("segera menuju")
                                        );
                                        menujuKe.play();
                                        menujuKe.addEventListener("ended",
                                            function() {
                                                menujuKe.pause();

                                                const tujuan = new Audio(
                                                    convertAssetMp3(
                                                        element
                                                        .menuju));
                                                tujuan.play()
                                                tujuan.addEventListener(
                                                    "ended",
                                                    function() {
                                                        resolve();
                                                    }
                                                );
                                            })
                                    }
                                })
                            } else if (parseInt(no) > 100 && parseInt(no) < 200) {
                                console.log(2);
                                const ratus = no.toString().substring(0, 1) + 0 + 0;
                                const nomer = new Audio(convertAssetWav(ratus));
                                nomer.play();

                                nomer.addEventListener("ended", function() {
                                    nomer.pause();

                                    let value = no.toString().substr(1, 3);
                                    let puluh = 0;
                                    if (value < 10) {
                                        puluh = value.replace('0', '');
                                    } else if (value < 20) {
                                        puluh = value;
                                    } else {
                                        puluh = no.toString().substring(1, 2) +
                                            0;
                                    }

                                    const angka = new Audio(convertAssetWav(
                                        puluh));
                                    angka.play();

                                    angka.addEventListener("ended", function() {
                                        angka.pause();

                                        const number = no.toString()
                                            .substring(2, 3)
                                        const number2 = no.toString()
                                            .substring(1,
                                                3)

                                        if (number != 0 && number2 >
                                            20) {
                                            const angka = new Audio(
                                                convertAssetWav(
                                                    number));
                                            angka.play();
                                            angka.addEventListener(
                                                "ended",
                                                function() {
                                                    angka.pause();

                                                    const menujuKe =
                                                        new Audio(
                                                            convertAssetMp3(
                                                                "segera menuju"
                                                            )
                                                        )
                                                    menujuKe.play();
                                                    menujuKe
                                                        .addEventListener(
                                                            "ended",
                                                            function() {
                                                                menujuKe
                                                                    .pause();
                                                                const
                                                                    tujuan =
                                                                    new Audio(
                                                                        convertAssetMp3(
                                                                            element
                                                                            .menuju
                                                                        )
                                                                    );
                                                                tujuan
                                                                    .play();

                                                                tujuan
                                                                    .addEventListener(
                                                                        "ended",
                                                                        function() {
                                                                            resolve
                                                                                ();
                                                                        }
                                                                    );
                                                            })

                                                })
                                        } else {
                                            const menujuKe = new Audio(
                                                convertAssetMp3(
                                                    "segera menuju")
                                            )
                                            menujuKe.play();
                                            menujuKe.addEventListener(
                                                "ended",
                                                function() {
                                                    menujuKe
                                                        .pause();

                                                    const tujuan =
                                                        new Audio(
                                                            convertAssetMp3(
                                                                element
                                                                .menuju
                                                            )
                                                        );
                                                    tujuan.play()
                                                    tujuan
                                                        .addEventListener(
                                                            "ended",
                                                            function() {
                                                                resolve
                                                                    ();
                                                            }
                                                        );
                                                })
                                        }
                                    })
                                })
                            } else {
                                console.log(3);
                                const nomer = new Audio(convertAssetWav(no));
                                nomer.play();

                                nomer.addEventListener("ended", function() {
                                    nomer.pause();

                                    const menujuKe = new Audio(convertAssetMp3(
                                        "segera menuju"));
                                    menujuKe.play();
                                    menujuKe.addEventListener("ended",
                                        function() {
                                            menujuKe.pause();
                                            const tujuan = new Audio(
                                                convertAssetMp3(
                                                    element
                                                    .menuju));
                                            tujuan.play()
                                            tujuan.addEventListener(
                                                "ended",
                                                function() {
                                                    resolve();
                                                }
                                            );


                                        })

                                })
                            }

                        })
                    })
                })

                // return new Promise(resolve => {
                //     msg.onend = resolve;
                // });

            });
        }

        async function waitForAudioEnded(audio) {
            return new Promise(resolve => {
                audio.addEventListener("ended", function() {
                    audio.removeEventListener("ended", arguments.callee);
                    resolve();
                });
            });
        }

        function hapus(id) {
            let link = "{{ route('logPanggilan.destroy', ':id') }}"
            link = link.replace(':id', id);
            $.get(link,
                function(data) {
                    console.log(data);
                },
                "json"
            );
        }

        function convertAssetWav(prm) {
            let url = "{{ asset('suara/:suara') }}"
            url = url.replace(':suara', prm + ".wav");
            // console.log(url);
            return url;
        }

        function convertAssetMp3(prm) {
            let url = "{{ asset('suara/:suara') }}"
            url = url.replace(':suara', prm + ".mp3");
            console.log(url);
            return url;
        }
    </script>
@endsection
