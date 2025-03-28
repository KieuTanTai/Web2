// script.js

// Dữ liệu mẫu (có thể đến từ server hoặc cơ sở dữ liệu)
var data = {
  labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5'],
  datasets: [
      {
          label: 'Doanh số bán hàng',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1,
          data: [65, 59, 80, 81, 56]
      }
  ]
};

// Lấy thẻ canvas và vẽ biểu đồ
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: {
      scales: {
          y: {
              beginAtZero: true
          }
      }
  }
});
