@extends('layouts.dashboard-layouts')

@section('title', 'Webcam Absensi')

@section('content')
    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center"><i class="material-icons">home</i> Beranda</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/internal-images/icon-absensi.png') }}"
                                class="d-flex align-items-center me-1" width="16px" height="16px" />
                            Absensi
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="profile">
        <div class="container">
            <div class="box-profile">
                <div class="header-profile">
                    <a href="" class="d-flex align-items-center">
                        <i class="material-icons">arrow_back</i>
                    </a>
                    Absensi
                </div>
                <div class="webcam-present">
                    <h6>Absensi Masuk</h6>
                    <form>
                        <div class="webcam" id="my-camera"></div>
                        <div class="d-flex">
                            <div class="btn-webcam" id="btn-webcam"></div>
                            <div class="btn-refresh"> <i class="fa fa-refresh"></i> </div>
                        </div>
                        <div class="time-webcam-present">
                            <table>
                                <tr>
                                    <td class="date-webcam">Tanggal</td>
                                    <td class="px-2">:</td>
                                    <td id="date-present"></td>
                                </tr>
                                <tr>
                                    <td class="date-webcam">Waktu</td>
                                    <td class="px-2">:</td>
                                    <td id="time-present"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn-submit-present">Masuk</button>
                        </div>

                    </form>
                </div>
                {{-- <div id="my-camera"></div> --}}
            </div>
        </div>
    </section>
@endsection

@push('addon-javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

    <script language="JavaScript">
        Webcam.set({
            image_format: 'jpeg',
            jpeg_quality: 90,
            swfURL: "https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.22/webcam.swf",
            flashNotDetectedText: "Your device is not compatible."
        });

        Webcam.attach('#my-camera');
        const btnWebcam = document.querySelector("#btn-webcam");
        const btnRefresh = document.querySelector(".btn-refresh");
        btnWebcam.addEventListener("click", () => {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('my-camera').innerHTML = '<img src="' + data_uri + '"/>';
            });
            btnWebcam.style.display = "none";
            btnRefresh.style.display = "flex";
        })
        btnRefresh.addEventListener("click", () => {
            Webcam.unfreeze();
            document.getElementById('my-camera').innerHTML = " ";
            Webcam.attach('#my-camera');
            btnRefresh.style.display = "none";
            btnWebcam.style.display = "block"
        })
    </script>
    <script>
        function dateTime() {
            const datePresent = document.querySelector("#date-present");
            const timePresent = document.querySelector("#time-present");
            const clientTime = new Date();
            const timeNow = new Date(clientTime.getTime());
            let hours = timeNow.getHours().toString();
            let minute = timeNow.getMinutes().toString();
            let second = timeNow.getSeconds().toString();
            let date = timeNow.getDate();
            let month = timeNow.getMonth() + 1;
            let year = timeNow.getFullYear();

            if (hours.length == 1) {
                hours = "0" + hours;
            }
            if (minute.length == 1) {
                minute = "0" + minute;
            }
            if (second.length == 1) {
                second = "0" + second;
            }
            if (date < 10) {
                date = "0" + date;
            }
            if (month < 10) {
                month = "0" + month;
            }
            datePresent.innerHTML = date + "/" + month + "/" + year;
            timePresent.innerHTML = hours + ":" + minute + ":" + second;

            setTimeout(dateTime, 1000);
        }

        dateTime();
    </script>
@endpush
