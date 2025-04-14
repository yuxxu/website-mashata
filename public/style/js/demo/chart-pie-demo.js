document.addEventListener("DOMContentLoaded", function () {
  fetch('/chart/pasien-per-poli')
      .then(response => response.json())
      .then(chartData => {
          const ctx = document.getElementById("myPieChart").getContext('2d');
          new Chart(ctx, {
              type: 'doughnut',
              data: {
                  labels: chartData.labels,
                  datasets: [{
                      data: chartData.data,
                      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'],
                      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#f4b619', '#d2352c', '#6c757d'],
                      hoverBorderColor: "rgba(234, 236, 244, 1)",
                  }],
              },
              options: {
                  maintainAspectRatio: false,
                  tooltips: {
                      backgroundColor: "rgb(255,255,255)",
                      bodyFontColor: "#858796",
                      borderColor: '#dddfeb',
                      borderWidth: 1,
                      xPadding: 15,
                      yPadding: 15,
                      displayColors: true,
                      caretPadding: 10,
                  },
                  legend: {
                      display: true,
                      position: 'right',
                  },
                  cutoutPercentage: 70,
              }
          });
      });
});