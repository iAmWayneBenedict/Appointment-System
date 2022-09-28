$(() => {
	const url = document.querySelector("meta[name = base_url]").getAttribute("content");
	let date = new Date();
	let global_year = date.getFullYear();

	function getDate(month, year) {
		let date = new Date();
		let firstDay = new Date(year, month, 1);
		let lastDay = new Date(year, month + 1, 0);

		return [firstDay.getDay() + 1, lastDay.getUTCDate()];
	}

	populateCalendar(getDate(date.getMonth(), date.getFullYear()), date.getMonth(), global_year);
	$(".day").each(function () {
		$(this).click(handleClickDay);
	});

	function populateCalendar([firstDay, lastUTCDay], month, year) {
		$(".days-entries").html("");

		let allDates = "";
		let isFirstWeekDone = false;

		let openingTR = "<tr>";
		let closingTR = "</tr>";
		let currentDay = "";
		let nextThreeDaysCounter = 0;
		let isNextThreeDaysCounterStart = false;
		let isCurrentDayFound = false;

		// populate first week of the month
		for (let index2 = 1; index2 < firstDay; index2++) {
			currentDay += "<td></td>";

			if (index2 === firstDay - 1) {
				isFirstWeekDone = true;
			}
		}

		// populate the remaining weeks

		for (let j = firstDay, days = 1; j <= lastUTCDay + firstDay; j++, days++) {
			let currentDayOfTheWeekNumber = getCurrentDayOfTheWeek(month, days, year);
			let currentDayOfTheWeekName = convertDayToName(currentDayOfTheWeekNumber);
			if (date.getUTCDate() === days && date.getMonth() === month) {
				isCurrentDayFound = true;
				// Date today
				if (currentDayOfTheWeekName === "Sun") {
					currentDay +=
						'<td class="active"><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' +
						days +
						"</h6>" +
						"</div></a></td>";
				} else if (currentDayOfTheWeekName === "Sat") {
					currentDay +=
						'<td class="active"><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' +
						days +
						"</h6>" +
						"</div></a></td>";
				} else {
					currentDay +=
						'<td class="active"><a role="button" class="text-decoration-none day text-dark"><div><h6>' +
						days +
						"</h6>" +
						"</div></a></td>";
				}

				isNextThreeDaysCounterStart = true;
			} else {
				if (nextThreeDaysCounter < 3 && isNextThreeDaysCounterStart) {
					currentDay +=
						'<td class=""><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' +
						days +
						"</h6>" +
						"</div></a></td>";
					nextThreeDaysCounter++;
				} else {
					// other day of the month
					if (currentDayOfTheWeekName === "Sun") {
						currentDay +=
							'<td class=""><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' +
							days +
							"</h6>" +
							"</div></a></td>";
					} else if (currentDayOfTheWeekName === "Sat") {
						currentDay +=
							'<td class=""><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' +
							days +
							"</h6>" +
							"</div></a></td>";
					} else {
						if (!isCurrentDayFound && month === date.getMonth())
							currentDay +=
								'<td class=""><a role="button" aria-disabled="true" class="disabled text-decoration-none day opacity-50 text-dark"><div><h6>' +
								days +
								"</h6>" +
								"</div></a></td>";
						else
							currentDay +=
								'<td class=""><a role="button" class="text-decoration-none day text-dark"><div><h6>' +
								days +
								"</h6>" +
								"</div></a></td>";
					}
				}
			}
			if (currentDayOfTheWeekName === "Sat") {
				allDates += openingTR + currentDay + closingTR;
				currentDay = "";
			}

			if (j === lastUTCDay + firstDay) {
				allDates += openingTR + currentDay + closingTR;
				currentDay = "";
			}
		}

		$(".days-entries").append(allDates);
	}

	$(".prev-month").click(function () {
		let selectedMonth = $(".calendar-title").text();
		$(".days-entries").html("");
		setCalendarTitle(convertMonthToName(date.getMonth()), date.getMonth());

		$(this).attr("disabled", true);
		$(".next-month").removeAttr("disabled");

		$(this).addClass("opacity-25");
		$(".next-month").removeClass("opacity-25");
		populateCalendar(
			getDate(date.getMonth(), date.getFullYear()),
			date.getMonth(),
			global_year
		);
		$(".day").each(function () {
			$(this).click(handleClickDay);
		});
	});

	$(".next-month").click(function () {
		let selectedMonth = $(".calendar-title").text();
		$(".days-entries").html("");
		let nextDate = undefined;
		if (date.getMonth() == 11) {
			nextDate = new Date(date.getFullYear() + 1, 0, 1);
		} else {
			nextDate = new Date(date.getFullYear(), date.getMonth() + 1, 1);
		}
		console.log(nextDate.getFullYear());
		setCalendarTitle(convertMonthToName(nextDate.getMonth()), nextDate.getMonth());

		$(this).attr("disabled", true);
		$(".prev-month").removeAttr("disabled");
		$(this).addClass("opacity-25");

		$(".prev-month").removeClass("opacity-25");
		global_year = nextDate.getFullYear();
		populateCalendar(
			getDate(nextDate.getMonth(), nextDate.getFullYear()),
			nextDate.getMonth(),
			global_year
		);
		$(".day").each(function () {
			$(this).click(handleClickDay);
		});
	});

	setCalendarTitle(convertMonthToName(date.getMonth()), date.getMonth());

	function setCalendarTitle(month, monthNumber) {
		$(".calendar-title").text(month);
		$(".calendar-title").data("month", monthNumber);
	}

	function convertMonthToName(monthNumber) {
		let months = [
			"January",
			"February",
			"March",
			"April",
			"May",
			"June",
			"July",
			"August",
			"September",
			"October",
			"November",
			"December",
		];
		for (let index = 0; index < months.length; index++) {
			if (index === monthNumber) return months[index];
		}

		return false;
	}

	function getCurrentDayOfTheWeek(month, day, year) {
		let dayOfTheWeek = new Date(year, month, day);

		return dayOfTheWeek.getDay() + 1;
	}

	function convertDayToName(dayNumber) {
		let week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
		for (let index = 0; index < week.length; index++) {
			if (index === dayNumber - 1) return week[index];
		}

		return false;
	}
	let prevDayElement = undefined;

	function handleClickDay() {
		// remove prev clicked styling
		if (prevDayElement) {
			prevDayElement.parent().removeClass("bg-primary");
			prevDayElement.addClass("text-dark");
			prevDayElement.removeClass("text-light");
		}

		if ($(this).hasClass("disabled")) return;

		// add clicked styling
		$(this).parent().addClass("bg-primary");
		$(this).removeClass("text-dark");
		$(this).addClass("text-light");
		$(".save-date-btn").data("day", $(this).find("h6").text());
		prevDayElement = $(this);
	}

	$(".hour").change(changeHour);
	changeHour();

	function changeHour() {
		$(".save-date-btn").data("hour", $(".hour").val());
		if ($(".hour").val() > 12) $(".datetime").text("pm");
		else $(".datetime").text("am");
	}

	$(".minutes").change(changeMinutes);
	changeMinutes();

	function changeMinutes() {
		$(".save-date-btn").data("minutes", $(".minutes").val());
	}

	$(".save-date-btn").each(function () {
		console.log($(this));
		$(this).click(handleSaveDate);
	});

	function handleSaveDate() {
		console.log($(this));
		// get all date values
		let month = $(".calendar-title").data("month") + 1;
		let day = $(this).data("day");
		let hour = $(".save-date-btn").data("hour");
		let minutes = $(".save-date-btn").data("minutes");

		// convert date values
		let currentDayOfTheWeekNumber = getCurrentDayOfTheWeek(month - 1, day, global_year);
		let currentDayOfTheWeekName = convertDayToName(currentDayOfTheWeekNumber);
		let selectedDate = `${global_year}-${month}-${day} ${hour}:${minutes}`;
		let datetime = hour > 12 ? "pm" : "am";

		// redefine elements
		$(this).parents(".form-submit").find(".selected-date-con").removeClass("d-none");
		// $('.selected-date-con').removeClass('d-none')
		$(this).parents(".form-submit").find("#new-sched").val(selectedDate);
		$(this)
			.parents(".form-submit")
			.find(".selected-date")
			.val(
				`${currentDayOfTheWeekName}, ${convertMonthToName(month - 1)} ${parseInt(
					day
				)}, ${global_year} ${hour % 12}:${minutes} ${datetime}`
			);
		$(this).prev().click();
	}

	$("#purpose").on("change", displayPersonIncharge);
	displayPersonIncharge();

	function displayPersonIncharge(personIncharge = undefined) {
		if ($("#purpose").val() == "other") {
			$("#concern").prop("disabled", false);
			$("#concern").parent().removeClass("d-none");
			$(".person-incharge-con").parent().addClass("d-none");
			$(".person-incharge-con").html("");
			return;
		}

		let purpose = $("#purpose").val();

		$.ajax({
			type: "get",
			url: `${url}/user/dashboard/get-incharge-employee/${purpose}`,
			// dataType: "json",
			success: function (response) {
				let data = JSON.parse(response);
				$("#concern").prop("disabled", true);
				$("#concern").parent().addClass("d-none");
				$(".person-incharge-con").parent().removeClass("d-none");
				$(".person-incharge-con").html("");
				for (const incharge of data) {
					$(".person-incharge-con").append(
						personInChargeCardTemplate(incharge.name, incharge.designation)
					);
				}
			},
		});

		return;
	}

	function personInChargeCardTemplate(name, designation) {
		return `<div class="alert alert-info" role="alert">
				<h6 class="m-0 fw-semibold">${name}</h5>
				<small class="m-0">${designation}</small>
			</div>`;
	}
});
