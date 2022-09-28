$(() => {
	const url = document.querySelector("meta[name = base_url]").getAttribute("content");

	let global_designation_address = "";

	// datatable initialization
	let $table = $("#employees").DataTable();

	$(".add-employee-btn").click(function (event) {
		$(".add-employee-submit-btn").val("Add");
		$("#popup-overlay-title").text("Add Employee");
		$(".add-employee-con").addClass("active");
	});

	$(".cancel-add-empoyee-btn").click(function (event) {
		$("#form-add-employee")[0].reset();
		$(".added-incharge").each(function () {
			$(this).remove();
		});
		$(".add-employee-con").removeClass("active");
	});

	$(".close-qr-generated").click(function (event) {
		$(".generated-qrcode-con").removeClass("active");
	});
	$("#form-add-employee").submit(handleEmployee);

	$(".choose-designation").click(handleChooseInCharge);

	function handleChooseInCharge(event) {
		global_designation_address = $(this).prev().attr("id");
		$(".select-incharge-con").addClass("active");
	}

	function handleEmployee(event) {
		event.preventDefault();

		let incharge_to = [];

		let id = $("#id").val();
		let name = $("#name").val();
		let role = $("#role").val();

		$(".incharge-con input").each(function () {
			incharge_to.push($(this).val());
		});

		if ($(".cancel-add-empoyee-btn").next().val() === "Add") {
			$.ajax({
				type: "post",
				url: `${url}/admin/dashboard/add-employee`,
				data: {
					name: name,
					role: role,
					incharge_to: incharge_to,
				},
				dataType: "json",
				success: function (res) {
					console.log(res);
					// display_employees();
					location.reload();
				},
				error: function (err) {
					console.error(err);
				},
			});
		} else {
			$.ajax({
				type: "post",
				url: `${url}/admin/dashboard/update-employee`,
				data: {
					id: id,
					name: name,
					role: role,
					incharge_to: incharge_to,
				},
				// dataType: "json",
				success: function (res) {
					console.log(res);
					// display_employees();
					location.reload();
				},
				error: function (err) {
					console.error(err);
				},
			});
		}
	}
	handlePopulateInChargeToChoices();
	function handlePopulateInChargeToChoices() {
		$.ajax({
			type: "get",
			url: `${url}/admin/dashboard/get-all-incharge-to`,
			// dataType: "json",
			success: function (res) {
				$(".list-group").html(res);
				$(".list-group-item").each(function () {
					$(this).click(handleClickInChargeToChoices);
				});
			},
			error: function (err) {
				console.error(err);
			},
		});
	}

	setTimeout(() => {
		$(".save-changes").click(function () {
			$(".list-group-item").each(function () {
				if ($(this).hasClass("active")) {
					$(`#${global_designation_address}`).val($(this).next().data("value"));
					$(".btn-close").click();

					return;
				}
			});
		});
	}, 1000);

	function handleClickInChargeToChoices() {
		$(".list-group-item").each(function () {
			$(this).removeClass("active");
		});

		$(this).addClass("active");
	}

	async function fetchQROptions(url) {
		let options = await fetch(url);

		return await options.json();
	}

	function display_employees() {
		// destroy table before updating
		$table.destroy();

		$.ajax({
			type: "get",
			url: `${url}/scanner/get-employee`,
			async: true,
			success: function (response) {
				$(".list").html(response);

				$(".generate-qrcode-btn").each(function (index, element) {
					$(this).click(function () {
						$(".generated-qrcode-con").addClass("active");
						const id = $(this).parent().parent().children()[0].textContent;
						const secret = "/.,;[]+_-*$#@12~|";
						let encrypted = CryptoJS.AES.encrypt(id, secret).toString();

						// fetch custom qr styling
						fetchQROptions(`${url}/src/json/options.json`).then((options) => {
							options.data = encrypted;
							const qr = new QRCodeStyling(options);
							document.getElementById("qr-code").innerHTML = "";
							qr.append(document.getElementById("qr-code"));

							// download qr code
							$("#qrdl").click(function () {
								qr.download({ name: "qr-code", extension: "png" });
							});
						});
					});
				});

				$(".employee-edit-btn").each(function () {
					$(this).click(handleEditClick);
				});

				$(".employee-delete-btn").each(function () {
					$(this).click(handleDeleteClick);
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

	function handleDeleteClick() {
		let id = $(this).val();

		Swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#ff0000",
			cancelButtonColor: "#d0d0d0d",
			confirmButtonText: "Yes, delete it!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "get",
					url: `${url}/admin/dashboard/delete-employee/${id}`,
					// dataType: "json",
					success: function (res) {
						Swal.fire(
							"Deleted",
							"You have successfully deleted an employee",
							"success"
						);
						display_employees();
					},
					error: function (err) {
						console.error(err);
					},
				});
			}
		});
	}

	function handleEditClick() {
		let id = parseInt($(this).val());
		$("#id").val(id);

		$(".add-employee-submit-btn").val("Edit");
		$("#popup-overlay-title").text("Edit Employee");

		$.ajax({
			type: "get",
			url: `${url}/admin/dashboard/get-employee/${id}`,
			async: true,
			success: function (response) {
				// console.log(response);
				let data = JSON.parse(response).data;

				console.log(data);

				$(".added-incharge").remove();
				for (let index = 0; index < data.length - 1; index++) {
					$(".add-new-incharge").click();
				}
				for (let index = 0; index < data.length; index++) {
					if (index === 0) {
						$("#name").val(data[index].name);
						$("#role").val(data[index].designation);
						$("#incharge_to").val(data[index].incharge_to);

						continue;
					}

					$(".added-incharge").each(function (j, element) {
						if (j + 1 === index)
							$(this).children().find("input").val(data[index].incharge_to);
					});
				}
			},
		});
		$(".add-employee-con").addClass("active");
	}

	// generate qr code
	let qrForm = document.querySelector("form");
	let qrCode = new QRCode(document.getElementById("qr-code"));
	// qrForm.addEventListener("submit", generateQr);

	function generateQr(data) {
		qrCode.makeCode(data); // admin scan
	}

	$(".add-new-incharge").click(function () {
		let id = $(".incharge-con").children().length;
		$(".incharge-con").append(`<div class="mb-3 added-incharge">
			<div class="d-flex gap-2 align-items-center">
				<div class="position-relative flex-fill">
					<input type="text" class="form-control" id="additional_${id}" name="additional_${id}" placeholder="Additional incharge to">
					<div class="choose-designation" data-bs-toggle="modal" data-bs-target="#exampleModal">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
							<circle cx="11" cy="11" r="8"></circle>
							<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
						</svg>
					</div>
				</div>
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

		$(".choose-designation").each(function (index, element) {
			$(this).click(handleChooseInCharge);
		});
	});
});
