// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var A06 = document.getElementById("A06");
const countA06 = A06.getAttribute("data");
A06.removeAttribute("data");

var A11 = document.getElementById("A11");
const countA11 = A11.getAttribute("data");
A11.removeAttribute("data");

var A12 = document.getElementById("A12");
const countA12 = A12.getAttribute("data");
A12.removeAttribute("data");

var A14 = document.getElementById("A14");
const countA14 = A14.getAttribute("data");
A14.removeAttribute("data");

var A18 = document.getElementById("A18");
const countA18 = A18.getAttribute("data");
A18.removeAttribute("data");

var A19 = document.getElementById("A19");
const countA19 = A19.getAttribute("data");
A19.removeAttribute("data");

var A21 = document.getElementById("A21");
const countA21 = A21.getAttribute("data");
A21.removeAttribute("data");

var A22 = document.getElementById("A22");
const countA22 = A22.getAttribute("data");
A22.removeAttribute("data");

var A25 = document.getElementById("A25");
const countA25 = A25.getAttribute("data");
A25.removeAttribute("data");

var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["A06", "A11", "A12", "A14", "A18", "A19", "A21", "A22", "A25"],
    datasets: [{
      data: [countA06, countA11, countA12, countA14, countA18, countA19, countA21, countA22, countA25],
      backgroundColor: ['#6f42c1', '#e83e8c', '#e74a3b', '#fd7e14', '#f6c23e', '#1cc88a', '#20c9a6', '#36b9cc', '#858796'],
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
