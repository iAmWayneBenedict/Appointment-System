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

		let incharge_to = [];

		let name = $("#name").val();
		let role = $("#role").val();

		$(".incharge-con input").each(function () {
			incharge_to.push($(this).val());
		});

		$.ajax({
			type: "post",
			url: `${url}/add-employee`,
			data: {
				name : name,
				role : role,
				incharge_to : incharge_to,
			},
			// dataType: "json",
			success: function (res) {
				console.log(res);
				display_employees();
			},
			error: function (err) {
				console.error(err);
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
<<<<<<< HEAD
						const secret = "/.,;[]+_-*$#@12~|";
						let encrypted = CryptoJS.AES.encrypt(id, secret).toString();

						generateQr(encrypted);
=======
						const name = $(this).parent().parent().children()[1].textContent;
						let qrCodeData = JSON.stringify({
							id,
							name,
						});
						$.ajax({
							type: "post",
							url: `${url}/encrypt-data`,
							data: {
								qr : qrCodeData
							},
							success: function (response) {							
								console.log(response);
								new QRious(document.getElementById("qr-code"), response);
							}
						});
						// generateQr(qrCodeData);
>>>>>>> cfb0ae5cf8049a5930d6aae8593c257aa72522c3
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
	// let qrCode = new QRCode(document.getElementById("qr-code"));
	// qrForm.addEventListener("submit", generateQr);

	// function generateQr(data) {
	// 	event.preventDefault();
	// 	// qrCode.makeCode(data); // admin scan
	// 	new QRCode(document.getElementById("qr-code"), data)
	// }

	function generateQrv2(data){
		new QRious({element: document.getElementById("qr-code"), value: data });
	}

	$(".add-new-incharge").click(function () {
		let id = $(".incharge-con").children().length;
		$(".incharge-con").append(`<div class="mb-3 added-incharge">
			<div class="d-flex gap-2 align-items-center">
				<input type="text" class="form-control" id="additional_${id}" name="additional_${id}" placeholder="Additional incharge to">
				<a class="btn">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
						<line x1="5" y1="12" x2="19" y2="12"></line>
					</svg>
				</a>
			</div>
		</div>`);

		$(".added-incharge .btn").each(function () {
			$(this).click(function () {
				$(this).parent().parent().remove();
			});
		});
	});
});
