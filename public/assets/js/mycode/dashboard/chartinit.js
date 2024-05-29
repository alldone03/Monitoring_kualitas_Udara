const chartSuhu = new Chart(document.getElementById("Chart-SUHU"), {
    type: "line",
    data: {
        labels: ["0"],
        datasets: [
            {
                label: "Suhu",
                data: [0],
                borderWidth: 1,
            },
        ],
    },

    options: {
        animations: false,
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});

const chartKelembaban = new Chart(document.getElementById("Chart-KELEMBABAN"), {
    type: "line",
    data: {
        labels: ["0"],
        datasets: [
            {
                label: "Kelembaban",
                data: [0],
                borderWidth: 1,
            },
        ],
    },
    options: {
        animations: false,
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});
const chartKualitasUdara = new Chart(
    document.getElementById("Chart-KualitasUdara"),
    {
        type: "line",
        data: {
            labels: ["0"],
            datasets: [
                {
                    label: "Kualitas Udara",
                    data: [0],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            animations: false,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    }
);
