$(() => {
	const url = document.querySelector("meta[name = base_url]").getAttribute("content");

	// datatable initialization
	let $table = $("#employees").DataTable();

	$(".add-employee-btn").click(function (event) {
		$(".add-employee-con").addClass("active");
	});

	$(".cancel-add-empoyee-btn").click(function (event) {
		$(".add-employee-con").removeClass("active");
	});

	$(".close-qr-generated").click(function (event) {
		$(".generated-qrcode-con").removeClass("active");
	});
	$("#form-add-employee").submit(addEmployee);

	function addEmployee(event) {
		event.preventDefault();

		$(".cancel-add-empoyee-btn").click();

		$.ajax({
			type: "post",
			url: `${url}/add-employee`,
			data: {
				name: $("#name").val(),
				role: $("#role").val(),
			},
			dataType: "json",
			success: function (res) {
				display_employees();
			},
		});
	}

	function display_employees() {
		// destroy table before updating
		$table.destroy();

		$.ajax({
			type: "get",
			url: `${url}/get-employee`,
			async: true,
			success: function (response) {
				$(".list").html(response);
				$(".generate-qrcode-btn").each(function (index, element) {
					$(this).click(function () {
						$(".generated-qrcode-con").addClass("active");
						const id = $(this).parent().parent().children()[0].textContent;
						const name = $(this).parent().parent().children()[1].textContent;
						let qrCodeData = JSON.stringify({
							id,
							name,
						});
						generateQr(qrCodeData);
						setTimeout(() => {
							let qr = $("#qr-code").children("img").attr("src");
							$("#qrdl").attr("href", qr);
							$("#qrdl").attr("download", "employee-qr-code.png");
							$("#qrdl").removeAttr("hidden");
						}, 500);
					});
				});

				// after population of tbody
				// datatable reinitialization
				$table = $("#employees").DataTable({
					columnDefs: [
						{
							width: "30%",
							targets: 3,
						},
					],
				});
			},
		});
	}
	display_employees();

	// generate qr code
	let qrForm = document.querySelector("form");
	let qrCode = new QRCode(document.getElementById("qr-code"));
	// qrForm.addEventListener("submit", generateQr);

	function generateQr(data) {
		event.preventDefault();
		qrCode.makeCode(data); // admin scan
	}
});
