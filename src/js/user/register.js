$(document).ready(function () {
	const base_url = document.querySelector("meta[name = base_url]").getAttribute("content");

	$.ajax({
		type: "get",
		url: `${base_url}/user/generate-id`,
		success: function (response) {
			$("#user_id").html(response);
		},
	});

	$("#user-form").submit(function (e) {
		e.preventDefault();
		$(".text-danger").addClass("d-none");

		if ($("#c_password").val() !== $("#password").val()) {
			$("#c_password").next().removeClass("d-none");
			$("#c_password").next().text("Password not match");
			return;
		} else {
			$("#c_password").next().addClass("d-none");
		}

		if (!$("#data-privacy-agreement").is(":checked")) {
			console.log($("#data-privacy-agreement").prev());
			$("#data-privacy-agreement").prev().prev().removeClass("d-none");
			$("#data-privacy-agreement").prev().prev().text("Please check the checkbox to proceed");
			return;
		} else {
			$("#data-privacy-agreement").prev().prev().addClass("d-none");
		}

		$.ajax({
			type: "post",
			url: `${base_url}/user/register-user`,
			data: {
				user_id: $("#user_id").text(),
				fname: $("#fname").val(),
				mname: $("#mname").val(),
				lname: $("#lname").val(),
				address: $("#address").val(),
				email: $("#email").val(),
				number: $("#number").val(),
				social_pos: $("#social_pos").val(),
				password: $("#password").val(),
			},
			dataType: "json",
			beforeSend: function () {
				// Show image container
				//show loading gif
				console.log("please wait....");
				$(".loading").removeClass("d-none");
				$("#preloader").modal("show");
			},
			success: function (res) {
				$("#preloader").modal("hide");
				swal.close();
				if (res.code == 0) {
					$.each(res.errors, function (key, val) {
						$(`#${key}`).next().text(val).removeClass("d-none");
					});
				}

				if (res.code == 1) {
					console.log(res.sms_res);
					Swal.fire({
						icon: "success",
						title: "Registered",
						text: res.msg,
						footer: '<a href="' + `${base_url}/user/login` + '">Take me to Login</a>',
					});
					$("#user-form").trigger("reset");
					return;
				}

				if (res.code == 3) {
					console.log(res.sms_res);
					Swal.fire("Sorry", res.msg, "error");
				}
			},
			complete: function (data) {
				// Hide image container
				//hide loading gif
				console.log("Sent");
				$(".loading").addClass("d-none");
			},
			error: function (err) {
				console.log(err);
			},
		});
	});

	// shows password
	$("#show-password").change(function (event) {
		if ($(this).is(":checked")) {
			$("#password, #c_password").attr("type", "text");
		} else {
			$("#password, #c_password").attr("type", "password");
		}
	});

	// check if password is matched with confirm password
	$("#c_password").change(function (event) {
		if ($(this).val() !== $("#password").val()) {
			$(this).next().removeClass("d-none");
			$(this).next().text("Password not match");
		} else {
			$(this).next().addClass("d-none");
		}
	});

	// setTimeout(() => {
	// 	$("#preloader").modal("hide");
	// }, 1000);
});
