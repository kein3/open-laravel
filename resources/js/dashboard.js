import Chart from 'chart.js/auto';

const el = document.getElementById('salesChart');
if (el && window.dashboardSales) {
  new Chart(el, {
    type: 'line',
    data: {
      labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
      datasets: [{
        label: 'Ventes',
        data: window.dashboardSales,
        tension: 0.4,
        borderWidth: 2,
        fill: false
      }]
    }
  });
}
