// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var A11 = document.getElementById("A11");
var A12 = document.getElementById("A12");
var A14 = document.getElementById("A14");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["A11", "A12", "A14"],
    datasets: [{
      data: [A11.getAttribute("data"), A12.getAttribute("data"), A14.getAttribute("data")],
      backgroundColor: ['#1cc88a', '#36b9cc', '#f6c23e'],
      hoverBackgroundColor: ['#17a673', '#2c9faf', '#f4b619'],
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
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
