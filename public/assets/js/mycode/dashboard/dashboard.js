var datakelembaban = [];
var datakualitasudara = [];
var datasuhu = [];

var time = [];

$(document).ready(function () {
    function convertDateToIndonesianFormat(dateString) {
        const date = new Date(dateString);
        const day = date.getDate();
        const month = date.getMonth();
        const year = date.getFullYear();
        const hour = date.getHours();
        const minute = date.getMinutes();
        const second = date.getSeconds();

        const monthNames = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];
        const indonesianMonthName = monthNames[month];

        const formattedDate = `${day} ${indonesianMonthName} ${year} ${
            hour < 10 ? "0" + hour : hour
        }:${minute < 10 ? "0" + minute : minute}:${
            second < 10 ? "0" + second : second
        }`;

        return formattedDate;
    }
    $(".mybtncontrol").click(function (e) {
        e.preventDefault();
        var id = $(this).attr("mybtn-attr-id");

        btncontrol[id] = btncontrol[id] == 0 ? 1 : 0;
        if (id == 0) {
            Toastify({
                text:
                    controlrelayname[id] +
                    " " +
                    `${btncontrol[id] != 0 ? "ON" : "OFF"}`,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: btncontrol[id] != 0 ? "#4fbe87" : "#dc3545",
            }).showToast();
        } else {
            Toastify({
                text:
                    controlrelayname[id] +
                    " " +
                    `${btncontrol[id] == 1 ? "ON" : "OFF"}`,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: btncontrol[id] == 1 ? "#4fbe87" : "#dc3545",
            }).showToast();
        }
    });
    $("#selectdevice").change(function () {
        btncontrol = [0, 0, 0, 0, 0, 0, 0];
        btncontrol.forEach((element, index) => {
            $(`.mybtncontrol[mybtn-attr-id="${index}"]`)
                .removeClass("btn-outline-danger")
                .removeClass("btn-outline-success")
                .addClass("btn-outline-secondary");
            $(".onlineStatusDevice")
                .html(`<div class="parent bg-secondary text-center text-white rounded-pill text-justify"
                            style="padding: 0.4rem">
                            Status Device
                        </div>`);
        });

        if (gaugeKELEMBABAN) {
            gaugeKELEMBABAN.series[0].points[0].update(
                parseFloat(parseFloat(0))
            );
        }
        if (gaugeKualitasUdara) {
            gaugeKualitasUdara.series[0].points[0].update(
                parseFloat(parseFloat(0))
            );
        }
        if (gaugeSUHU) {
            gaugeSUHU.series[0].points[0].update(parseFloat(0));
        }

        chartKelembaban.data.labels = [0];
        chartKualitasUdara.data.labels = [0];
        chartSuhu.data.labels = [0];

        chartKelembaban.data.datasets[0].data = [0];
        chartKualitasUdara.data.datasets[0].data = [0];
        chartSuhu.data.datasets[0].data = [0];

        chartKualitasUdara.update();
        chartSuhu.update();
        chartKelembaban.update();
    });
    setInterval(function () {
        var today = new Date();
        const data_kelembaban = 0;
        const data_kualitasudara = 0;
        const data_suhu = 0;
        const data_ketinggianair = 0;
        if ($("#selectdevice").val() != 0) {
            $.ajax({
                type: "GET",
                dataType: "json",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    // buttonstate: btncontrol,
                },

                url:
                    myserver + "/dashboard/getdata/" + $("#selectdevice").val(),
                success: function (data) {
                    // console.log("data", data);

                    var datakelembaban = data.kelembaban;
                    var datakualitasudara = data.kualitasudara;
                    var datasuhu = data.suhu;

                    var time = [];

                    if (gaugeKELEMBABAN) {
                        gaugeKELEMBABAN.series[0].points[0].update(
                            parseFloat(datakelembaban[0])
                        );
                    }
                    if (gaugeKualitasUdara) {
                        gaugeKualitasUdara.series[0].points[0].update(
                            parseFloat(datakualitasudara[0])
                        );
                    }
                    if (gaugeSUHU) {
                        gaugeSUHU.series[0].points[0].update(
                            parseFloat(datasuhu[0])
                        );
                    }

                    data.created_at.forEach((element) => {
                        time.push(convertDateToIndonesianFormat(element));
                    });

                    datakelembaban.reverse();
                    datakualitasudara.reverse();
                    datasuhu.reverse();

                    time.reverse();
                    const mytime = new Date(data.created_at[0]).getTime();
                    // console.log("mytime", mytime);

                    if (Date.now() - mytime < 10000) {
                        $(".onlineStatusDevice")
                            .html(`<div class="parent bg-success text-center text-white rounded-pill text-justify"
                            style="padding: 0.4rem"> Status Online
                    </div>`);
                    } else {
                        $(".onlineStatusDevice")
                            .html(`<div class="parent bg-danger text-center text-white rounded-pill text-justify"
                            style="padding: 0.4rem">Status Offline
                    </div>`);
                    }

                    chartKelembaban.data.labels = time;
                    chartKualitasUdara.data.labels = time;
                    chartSuhu.data.labels = time;

                    chartKelembaban.data.datasets[0].data = datakelembaban;
                    chartKualitasUdara.data.datasets[0].data =
                        datakualitasudara;
                    chartSuhu.data.datasets[0].data = datasuhu;

                    chartKualitasUdara.update();
                    chartSuhu.update();
                    chartKelembaban.update();
                },
            });
        }

        //chart update
    }, 1000);
});
