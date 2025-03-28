<link rel="stylesheet" href="css/cssadmin.css">


<body>
	<div class="trangchuadmin">
		<div class="trangchuadmin--inner">
			<div class="trangchuadmin--total-list">
				<div class="trangchuadmin--total-item blue">
					<div class="trangchuadmin--total-item__row">
						<div class="trangchuadmin--total-item__info">
							<h2 class="trangchuadmin--total-item__heading">Người dùng</h2>
							<p class="trangchuadmin--total-item__number"><?php echo $soLuongND; ?></p>
						</div>
						<img src="css/icons/total-item-01.svg" alt="" class="trangchuadmin--total-item__icon">
					</div>
					<div class="trangchuadmin--total-item__percent">
						<?php
						if ($soLuongNDPercent > 0) {
							echo '<img src="css/icons/total-item-increse.svg" alt="" class="trangchuadmin--total__percent-img">';
						} else if ($soLuongNDPercent < 0) {
							echo '<img src="css/icons/total-item-decrease.svg" alt="" class="trangchuadmin--total__percent-img">';
						} else {
							echo '<img src="css/icons/math-almost-equal-to-svgrepo-com (2).svg" alt="" class="trangchuadmin--total__percent-img-a">';
						}
						?>
						<div class="trangchuadmin--total__percent-number" id="percentND">
							<?php echo $soLuongNDPercent; ?>%
						</div>
						<p class="trangchuadmin--total__percent-desc">from yesterday</p>
					</div>
				</div>
				<div class="trangchuadmin--total-item yellow">
					<div class="trangchuadmin--total-item__row">
						<div class="trangchuadmin--total-item__info">
							<h2 class="trangchuadmin--total-item__heading">Sản phẩm</h2>
							<p class="trangchuadmin--total-item__number"><?php echo $soLuongSP; ?></p>
						</div>
						<img src="css/icons/total-item-02.svg" alt="" class="trangchuadmin--total-item__icon">
					</div>
					<div class="trangchuadmin--total-item__percent">
						<?php
						if ($soLuongSPPercent > 0) {
							echo '<img src="css/icons/total-item-increse.svg" alt="" class="trangchuadmin--total__percent-img">';
						} else if ($soLuongSPPercent < 0) {
							echo '<img src="css/icons/total-item-decrease.svg" alt="" class="trangchuadmin--total__percent-img">';
						} else {
							echo '<img src="css/icons/math-almost-equal-to-svgrepo-com (2).svg" alt="" class="trangchuadmin--total__percent-img-a">';
						}
						?>
						<div class="trangchuadmin--total__percent-number" id="percentSP">
							<?php
							if ($soLuongSPPercent < 0)
								echo $soLuongSPPercent * -1;
							else
								echo $soLuongSPPercent; ?>%
						</div>
						<p class="trangchuadmin--total__percent-desc">from yesterday</p>
					</div>
				</div>
				<div class="trangchuadmin--total-item green">
					<div class="trangchuadmin--total-item__row">
						<div class="trangchuadmin--total-item__info">
							<h2 class="trangchuadmin--total-item__heading">Đặt hàng</h2>
							<p class="trangchuadmin--total-item__number"><?php echo $soLuongDH; ?></p>
						</div>
						<img src="css/icons/total-item-03.svg" alt="" class="trangchuadmin--total-item__icon">
					</div>
					<div class="trangchuadmin--total-item__percent">
						<?php
						if ($soLuongDHPercent > 0) {
							echo '<img src="css/icons/total-item-increse.svg" alt="" class="trangchuadmin--total__percent-img">';
						} else if ($soLuongDHPercent < 0) {
							echo '<img src="css/icons/total-item-decrease.svg" alt="" class="trangchuadmin--total__percent-img">';
						} else {
							echo '<img src="css/icons/math-almost-equal-to-svgrepo-com (2).svg" alt="" class="trangchuadmin--total__percent-img-a">';
						}
						?>
						<div class="trangchuadmin--total__percent-number" id="percentDH">
							<?php
							if ($soLuongDHPercent < 0)
								echo $soLuongDHPercent * -1;
							else
								echo $soLuongDHPercent; ?>%
						</div>
						<p class="trangchuadmin--total__percent-desc">from yesterday</p>
					</div>
				</div>
				<div class="trangchuadmin--total-item brown">
					<div class="trangchuadmin--total-item__row">
						<div class="trangchuadmin--total-item__info">
							<h2 class="trangchuadmin--total-item__heading">Feedback</h2>
							<p class="trangchuadmin--total-item__number"><?php echo $soLuongFB; ?></p>
						</div>
						<img src="css/icons/total-item-04.svg" alt="" class="trangchuadmin--total-item__icon">
					</div>
					<div class="trangchuadmin--total-item__percent">
						<?php
						if ($soLuongFBPercent > 0) {
							echo '<img src="css/icons/total-item-increse.svg" alt="" class="trangchuadmin--total__percent-img">';
						} else if ($soLuongFBPercent < 0) {
							echo '<img src="css/icons/total-item-decrease.svg" alt="" class="trangchuadmin--total__percent-img">';
						} else {
							echo '<img src="css/icons/math-almost-equal-to-svgrepo-com (2).svg" alt="" class="trangchuadmin--total__percent-img-a
								">';
						}
						?>
						<div class="trangchuadmin--total__percent-number" id="percentFB">
							<?php
							if ($soLuongFBPercent < 0)
								echo $soLuongFBPercent * -1;
							else
								echo $soLuongFBPercent; ?>%
						</div>
						<p class="trangchuadmin--total__percent-desc">from yesterday</p>
					</div>
				</div>
			</div>
			<div class="banthan">
				<div class="jack">
					<canvas id="myChart" width="400" height="200"></canvas>
					</br>
					<div class="title_chart">Biểu đồ thống kê số tour bán được theo tuần</div>
				</div>
				<div class="kicm">
					<table id="tableData" class="custom-table tableTopTour" style="box-shadow: none;">
						<thead class="table-head">
							<tr class="table--head" style="background-color:#a7bced;">
								<th class="table-header" width="10px">Top</th>
								<th class="table-header">Tour</th>
								<th class="table-header">Số lượng bán</th>
							</tr>
						</thead>

						<tbody class="table-body">
							<?php $stt = 0;
							if ($tourSellToday != null) {
								foreach ($tourSellToday as $tour) :
									$stt++;
									if ($stt == 6)
										break;
									$style = "color: black;";
									if ($stt == 1)
										$style = "color: #8280ff; font-weight:600; font-size: 20px;";
									elseif ($stt == 2)
										$style = "color: #fec53d; font-weight:600; font-size: 17px;";
									elseif ($stt == 3)
										$style = "color: #4ad991; font-weight:600; font-size: 17px;";
							?>

									<tr class="table-row" height="42px" style="<?php echo $style ?>;">
										<td class="table-cell id">#<?php echo $stt ?></td>
										<td class="table-cell id"><?php echo $tour['title']; ?></td>
										<td class="table-cell id"><?php echo $tour['total_quantity']; ?></td>
										</td>
									</tr>
							<?php endforeach;
							} ?>
						</tbody>
					</table>
					</br>
					<div class="title_chart tableTop">Top các tour bán chạy trong tuần</div>
				</div>
			</div>
			<div class="banthan">
				<div class="jack">
					<div class="containChartDonut">
						<canvas id="myDoughnutChart" width="200" height="200"></canvas>
					</div>
				</div>
				<div class="kicm">
					<canvas id="myChartDuDoan" width="400" height="230"></canvas>
				</div>
			</div>
		</div>
	</div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
	var ctxDonut = document.getElementById('myDoughnutChart').getContext('2d');

	// Khởi tạo biểu đồ Doughnut
	var myDoughnutChart = new Chart(ctxDonut, {
		type: 'doughnut',
		data: {
			labels: ['Tour hủy', 'Tour đặt'],
			datasets: [{
				label: 'Dataset',
				data: [<?php echo json_encode($tourHuy) . ',' . json_encode($tongTour); ?>], // Dữ liệu
				backgroundColor: [
					'rgba(255, 99, 132, 0.5)',
					'rgba(54, 162, 235, 0.5)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			plugins: {
				title: {
					display: true,
					text: 'Số tour bị hủy so với tổng tour đã đặt thành công',
					align: 'center', // Canh giữa tiêu đề
					position: 'bottom',
					padding: {
						bottom: 20,
						top: 20 // Khoảng cách dưới tiêu đề
					}
				}
			}
		}
	});

	// Lấy danh sách các hàng của bảng
	var rows = document.querySelectorAll(".tableTopTour tr");

	// Duyệt qua từng hàng và áp dụng hiệu ứng nhảy vào
	rows.forEach(function(row, index) {
		setTimeout(function() {
			row.classList.add("show");
		}, index * 200); // Tạo khoảng cách thời gian giữa các hiệu ứng
	});

	var data = [1, 2, 3, 4, 5, 6, 7]
	var ctx = document.getElementById('myChart').getContext('2d');

	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ['Sunday', 'Monday', 'Tuesday', 'Webnesday', 'Thursday', 'Friday', 'Saturday'],
			datasets: [{
				label: 'This week',
				data: <?php echo json_encode($dataPoints1); ?>,
				fill: true,
				backgroundColor: 'rgba(75, 192, 192, 0.3)',
				borderColor: 'rgb(75, 192, 192)',
				tension: 0.3
			}, {
				label: 'Last week',
				data: <?php echo json_encode($dataPoints2); ?>,
				fill: true,
				backgroundColor: 'rgba(255, 99, 132, 0.3)',
				borderColor: 'rgb(255, 99, 132)',
				tension: 0.3
			}]
		},
		options: {

		}
	});

	var ctx2 = document.getElementById('myChartDuDoan').getContext('2d');

	var myChart2 = new Chart(ctx2, {
		type: 'line',
		data: {
			labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
			datasets: [{
				label: '2024',
				data: <?php echo json_encode($predicted_sales_this_year); ?>,
				fill: true,
				backgroundColor: 'rgba(74, 217, 145, 0.3)',
				borderColor: '#4ad991',
				tension: 0.3
			}]
		},
		options: {
			plugins: {
				title: {
					display: true,
					text: 'Dự đoán số lượng tour bán theo tháng trong năm nay',
					align: 'center', // Canh giữa tiêu đề
					position: 'bottom',
					padding: {
						bottom: 20,
						top: 20 // Khoảng cách dưới tiêu đề
					}
				}
			}
		}
	});

	// Lấy phần tử có id là "percentNumber"
	var percentND = document.getElementById("percentND");
	var soLuongNDPercent = <?php echo $soLuongNDPercent; ?>;

	var percentSP = document.getElementById("percentSP");
	var soLuongSPPercent = <?php echo $soLuongSPPercent; ?>;

	var percentDH = document.getElementById("percentDH");
	var soLuongDHPercent = <?php echo $soLuongDHPercent; ?>;

	var percentFB = document.getElementById("percentFB");
	var soLuongFBPercent = <?php echo $soLuongFBPercent; ?>;

	function checkPercent(percent, soluong) {
		if (soluong > 0) {
			percent.classList.add("success");
		} else if (soluong < 0) {
			percent.classList.add("error");
		} else {
			percent.classList.add("warning");
		}
	}

	checkPercent(percentND, soLuongNDPercent);
	checkPercent(percentSP, soLuongSPPercent);
	checkPercent(percentDH, soLuongDHPercent);
	checkPercent(percentFB, soLuongFBPercent);
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function() {
		$('.trangchuadmin--total-list').find('.trangchuadmin--total-item__number').each(function() {
			$(this).prop('Counter', 0).animate({
				Counter: $(this).text()
			}, {
				duration: 2000, // Thời gian chạy hiệu ứng (milliseconds)
				easing: 'swing',
				step: function(now) {
					$(this).text(Math.ceil(now)); // Hiển thị số nguyên gần nhất
				}
			});
		});
	});
</script>