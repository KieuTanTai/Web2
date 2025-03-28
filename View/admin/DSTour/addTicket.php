<style>
	.container {
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100vh;
	}

	.themuser {
		width: 400px;
		padding: 20px;
		border: 1px solid #ccc;
		border-radius: 5px;
		background-color: #f9f9f9;
	}

	.themuser h3 {
		text-align: center;
		margin-bottom: 20px;
	}

	.themuser form label {
		display: block;
		margin-top: 5px;
	}

	.themuser form input[type="text"],
	.themuser form input[type="email"],
	.themuser form input[type="password"],
	.themuser form input[type="date"],
	.themuser form input[type="number"] {
		width: 100%;
		padding: 8px;
		margin-bottom: 5px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}

	.themuser form input[type="submit"] {
		width: 100%;
		padding: 10px;
		border: none;
		border-radius: 4px;
		background-color: #4CAF50;
		color: white;
		cursor: pointer;
	}

	.themuser form input[type="submit"]:hover {
		background-color: #45a049;
	}

	.alert {
		color: green;
		text-align: center;
	}

	.form--inner {
		display: flex;
		gap: 30px;
	}

	.validation {
		color: red;
		font-size: 12px;
		/* display: none; */
	}
</style>

<body>
	<?php

	?>
	<div class="container">
		<div class="themuser">
			<h3>Thêm Vé</h3>
			<form action="Controller/trangadmin/Tour/C_addTicket.php" method="POST" class="form" onsubmit="return validateForm()">
				<div class="form--inner">
					<input type="hidden" name="id" value="<?php echo htmlspecialchars($_REQUEST['id']); ?>">
					<div class="flex">
						<label for="fullname">Tên vé:</label><br>
						<input type="text" id="name" name="name"><br>
						<span id="nameValidation" class="validation"></span>

						<!-- <label for="email">Giá vé:</label><br>
						<input type="number" id="price" name="price"><br>
						<span id="priceValidation" class="validation"></span> -->

						<label for="phone_number">Ngày đi:</label><br>
						<input type="date" id="dateStart" name="dateStart"><br>
						<span id="dateStartValidation" class="validation"></span>
					</div>
					<div class="flex">
						<label for="create_at">Ngày kết thúc:</label><br>
						<input type="date" id="dateEnd" name="dateEnd"><br>
						<span id="dateEndValidation" class="validation"></span>

						<label for="status">Số vé</label><br>
						<input type="number" id="numTicket" name="numTicket"><br>
						<span id="numTicketValidation" class="validation"></span>
					</div>
				</div>
				<input type="submit" name="addTicket" value="Thêm">
			</form>
		</div>


	</div>
</body>
<script>
	function validateForm() {
        var name = document.getElementById('name').value;
        // var price = document.getElementById('price').value;
        var dateStart = document.getElementById('dateStart').value;
        var dateEnd = document.getElementById('dateEnd').value;
        var numTicket = document.getElementById('numTicket').value;
        var isValid = true;

        // Kiểm tra trường Tên vé
        if (name.trim() === '') {
            document.getElementById('nameValidation').textContent = 'Tên vé không được để trống';
            isValid = false;
        } else {
            document.getElementById('nameValidation').textContent = '';
        }

        // Kiểm tra trường Giá vé
        // if (isNaN(price) || price <= 0) {
        //     document.getElementById('priceValidation').textContent = 'Giá vé phải là số dương';
        //     isValid = false;
        // } else {
        //     document.getElementById('priceValidation').textContent = '';
        // }

        // Kiểm tra trường Ngày đi
        if (dateStart.trim() === '') {
            document.getElementById('dateStartValidation').textContent = 'Ngày đi không được để trống';
            isValid = false;
        } else {
            document.getElementById('dateStartValidation').textContent = '';
        }

        // Kiểm tra trường Ngày kết thúc
        if (dateEnd.trim() === '') {
            document.getElementById('dateEndValidation').textContent = 'Ngày kết thúc không được để trống';
            isValid = false;
        } else {
            document.getElementById('dateEndValidation').textContent = '';
        }

        // Kiểm tra trường Số vé
        if (isNaN(numTicket) || numTicket <= 0) {
            document.getElementById('numTicketValidation').textContent = 'Số vé phải là số dương';
            isValid = false;
        } else {
            document.getElementById('numTicketValidation').textContent = '';
        }
		// Kiểm tra ngày đi phải nhỏ hơn ngày kết thúc
        var startDate = new Date(dateStart);
        var endDate = new Date(dateEnd);
        if (startDate >= endDate) {
            document.getElementById('dateStartValidation').textContent = 'Ngày đi phải nhỏ hơn ngày kết thúc';
            isValid = false;
        } else {
            document.getElementById('dateStartValidation').textContent = '';
        }

        return isValid;
    }

</script>

</html>