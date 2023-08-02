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
        var msg = new SpeechSynthesisUtterance();
        msg.lang = 'id-ID';
        msg.rate = 0.6;
        var dataFromServer;
        // const ut = new window.SpeechSynthesisUtterance('No warning should arise');
        $(() => {
            retriveData();
        });

        function startRetrievingData() {
            console.log("retrive");
            retriveData();
        }

        function retriveData() {
            $.get("{{ route('logPanggilan.index') }}",
                function(data) {
                    console.log("data telah di retrive");
                    dataFromServer = data;
                    data.forEach(element => {
                        $('#table-log > tbody:first').append(`
                    <tr>
                        <td id="id">` + element.id + `</td>
                        <td panggilan="panggilan">` + element.panggilan + `</td>
                        </tr>
                `);
                    });

                    panggil(data);
                },
                "json"
            );
        }

        async function panggil(data) {
            let jumlah = data.length;
            for (const element of data) {
                await antrianPanggilan(element.panggilan, element, );
            }
            setTimeout(startRetrievingData, 5000);
        }

        async function antrianPanggilan(text, element) {
            console.log(text);
            msg.text = text;
            speechSynthesis.speak(msg);
            hapus(element.id)
            return new Promise(resolve => {
                msg.onend = resolve;
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
    </script>
@endsection
