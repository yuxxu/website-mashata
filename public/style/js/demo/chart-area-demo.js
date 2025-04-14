// Set default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Format angka
function number_format(number, decimals = 0, dec_point = '.', thousands_sep = ',') {
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  let n = isFinite(+number) ? +number : 0;
  let prec = Math.abs(decimals);
  let s = (prec ? (Math.round(n * Math.pow(10, prec)) / Math.pow(10, prec)) : Math.round(n)).toString().split('.');

  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, thousands_sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = (s[1] || '') + '0'.repeat(prec - s[1].length);
  }
  return s.join(dec_point);
}

// Chart logic
document.addEventListener("DOMContentLoaded", function () {
  fetch("/admin/chart-data")
    .then(response => response.json())
    .then(data => {
      const ctx = document.getElementById("myAreaChart");

      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Belum Check-Up", "Sedang Check-Up", "Selesai"],
          datasets: [{
            label: "Jumlah Pasien",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [
              data.belum_checkup || 0,
              data.sedang_checkup || 0,
              data.sudah_checkup || 0
            ],
          }]
        },
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {
            xAxes: [{
              gridLines: {
                display: false,
                drawBorder: false
              },
              ticks: {
                maxTicksLimit: 3
              }
            }],
            yAxes: [{
              ticks: {
                maxTicksLimit: 5,
                padding: 10,
                callback: value => number_format(value)
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
              }
            }]
          },
          legend: {
            display: false
          },
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
              label: (tooltipItem, chart) => {
                const datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
              }
            }
          }
        }
      });
    })
    .catch(error => console.error('Error fetching chart data:', error));
});
