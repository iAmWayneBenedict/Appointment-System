$(() => {
	const url = document.querySelector("meta[name = base_url]").getAttribute("content");
	let date = new Date();
	let global_year = date.getFullYear();
	let dayFlags = [];
	let MAX_APPOINTMENT_PER_DAY = $(".hour option").length * $(".minutes option").length;
	let dateFlags = [];
	const MINUTES_LENGTH = $(".minutes option").length;
	let timeFlags = [];

	function getDate(month, year) {
		let date = new Date();
		let dayOfTheWeek = new Date(year, month, 1);
		let lastDay = new Date(year, month + 1, 0);

		return [dayOfTheWeek.getDay() + 1, lastDay.getUTCDate()];
	}
	populateDateFlags();
	populateCalendar(getDate(date.getMonth(), date.getFullYear()), date.getMonth(), global_year);
	$(".day").each(function () {
		$(this).click(handleClickDay);
	});

	function populateDateFlags() {
		// get employee incharge based on selected purpose
		$.ajax({
			type: "get",
			url: `${url}/user/all-appointments`,
			success: function (response) {
				let data = JSON.parse(response).data;
				for (const value of data) {
					let [date, time] = value.schedule.split(" ");
					let [year, month, day] = date.split("-");
					let [hours, minutes, seconds] = time.split(":");

					dateFlags.push({
						month,
						day,
						year,
						hours,
						minutes,
					});
				}
			},
		});
	}

	$("#select-date, .select-date-btn").click(function () {
		let month = convertMonthToNumber($(".calendar-title").text()) + 1;
		handleConflictingDay(month);
		handleFullyBooked();
		getHolidays();
	});

	function handleConflictingDay(month) {
		$(".days-entries a").each(function () {
			dayFlags.push({
				month,
				year: global_year,
				day: $(this).find("h6").text(),
				flags: 0,
			});
		});
		for (const iterator of dateFlags) {
			for (const iterator2 of dayFlags) {
				if (
					parseInt(iterator.month) === iterator2.month &&
					parseInt(iterator.day) === parseInt(iterator2.day) &&
					parseInt(iterator.year) === iterator2.year
				) {
					iterator2.flags++;
				}
			}
		}
	}

	$(".hour option").each(function () {
		timeFlags.push({
			time: $(this).val(),
			minutes: [],
			flags: 0,
		});
	});

	function populateTimeFlags(date) {
		for (const iterator of timeFlags) {
			iterator.flags = 0;
			iterator.minutes = [];
		}

		for (const iterator of dateFlags) {
			if (
				iterator.month === date.month &&
				iterator.day === date.day &&
				iterator.year === date.year
			) {
				for (const iterator2 of timeFlags) {
					if (iterator.hours === iterator2.time) {
						iterator2.minutes.push(iterator.minutes);
						iterator2.flags++;
					}
				}
			}
		}
	}

	function handleConflictingDates(isChanged = false) {
		handleConflictingHours(isChanged);
		handleConflictingMinutes();
	}

	function handleConflictingHours(isChanged) {
		$(".hour option").each(function () {
			$(this).removeAttr("disabled");
			$(this).removeAttr("selected");
			$(this).removeClass("text-danger");
			$(this).addClass("text-dark");
		});

		$(".hour option").each(function () {
			for (const iterator of timeFlags) {
				if ($(this).val() !== iterator.time) continue;

				if (iterator.flags === MINUTES_LENGTH) {
					$(this).attr("disabled", true);
					$(this).removeClass("text-dark");
					$(this).addClass("text-danger");
				}
			}
		});
		// console.log(timeFlags, 1);
		if (!isChanged) {
			$(".hour option").each(function () {
				if (!$(this).attr("disabled")) {
					$(this).parent().val($(this).val());
					$(this).attr("selected", true);
					return false;
				}
			});
		}
	}

	function handleFullyBooked() {
		// dayFlags[6].flags = MAX_APPOINTMENT_PER_DAY;
		let fullyBookedDate = dayFlags.filter(
			(dayFlag) => dayFlag.flags === MAX_APPOINTMENT_PER_DAY
		);
		let month = convertMonthToNumber($(".calendar-title").text()) + 1;
		let allDays = $(".days-entries td a").filter(function () {
			return !$(this).hasClass("disabled");
		});

		if (fullyBookedDate) {
			allDays.each(function () {
				self = $(this);
				fullyBookedDate.map((value) => {
					if (self.find("h6").text() === value.day && value.month === month) {
						self.first().attr("aria-disabled", true);
						self.first().addClass("disabled");
						self.first().removeClass("text-dark");
						self.first().addClass("text-danger");
					}
				});
			});
		}
	}

	function handleConflictingMinutes() {
		$(".minutes option").each(function () {
			$(this).removeAttr("disabled");
			$(this).removeClass("text-danger");
			$(this).removeAttr("selected");
		});
		// console.log(timeFlags);
		for (const iterator of timeFlags) {
			if (iterator.flags) {
				let counter = 1;
				if (counter <= iterator.flags && $(".hour").val() === iterator.time) {
					iterator.minutes.map((element) => {
						$(".minutes option").each(function () {
							if ($(this).val() === element) {
								$(this).attr("disabled", true);
								$(this).addClass("text-danger");
								$(this).attr("selected", true);
							}
						});
						counter++;
					});
				}
			}
		}

		$(".minutes option").each(function () {
			if (!$(this).attr("disabled")) {
				$(this).parent().val($(this).val());
				return false;
			}
		});
	}

	function getHolidays() {
		$.ajax({
			type: "get",
			url: `${url}/admin/get-holidays`,
			async: true,
			dataType: "json",
			success: function (response) {
				$("table.calendar-table td a").each(function () {
					for (let i = 0; i < response.length; i++) {
						if ($(this).hasClass("disabled")) continue;

						let holidayFrom = new Date(response[i].holiday_from);
						let holidayTo = new Date(response[i].holiday_to);
						let month = convertMonthToNumber($(".calendar-title").text());
						// console.log($(this).find('h6'));
						if (holidayTo == "Invalid Date") {
							if (
								month === holidayFrom.getMonth() &&
								holidayFrom.getDate() === parseInt($(this).find("h6").text())
							) {
								$(this).attr("aria-disabled", true);
								$(this).addClass("disabled");
								$(this).removeClass("text-dark");
								$(this).addClass("text-danger");
								continue;
							}
						}

						if (
							month === holidayFrom.getMonth() &&
							holidayTo.getDate() >= parseInt($(this).find("h6").text()) &&
							holidayFrom.getDate() <= parseInt($(this).find("h6").text())
						) {
							$(this).attr("aria-disabled", true);
							$(this).addClass("disabled");
							$(this).removeClass("text-dark");
							$(this).addClass("text-danger");
						}
					}
				});
			},
		});
	}

	function populateCalendar([dayOfTheWeek, lastDayOfTheMonth], month, year) {
		$(".days-entries").html("");

		let allDates = "";
		let isFirstWeekDone = false;

		let openingTR = "<tr>";
		let closingTR = "</tr>";
		let currentWeek = "";
		let nextThreeDaysCounter = 0;
		let isNextThreeDaysCounterStart = false;
		let isCurrentDayFound = false;

		// populate first week of the month
		for (let index2 = 1; index2 < dayOfTheWeek; index2++) {
			currentWeek += "<td></td>";

			if (index2 === dayOfTheWeek - 1) {
				isFirstWeekDone = true;
			}
		}

		// populate the remaining weeks

		for (let j = 0, days = 1; j <= lastDayOfTheMonth; j++, days++) {
			let currentDayOfTheWeekNumber = getCurrentDayOfTheWeek(month, days, year);
			let currentDayOfTheWeekName = convertDayToName(currentDayOfTheWeekNumber);
			if (date.getUTCDate() === days && date.getMonth() === month) {
				isCurrentDayFound = true;
				// Date today
				if (currentDayOfTheWeekName === "Sun" || currentDayOfTheWeekName === "Sat") {
					currentWeek +=
						'<td class="active"><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' +
						days +
						"</h6>" +
						"</div></a></td>";
				} else {
					currentWeek +=
						'<td class="active"><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' +
						days +
						"</h6>" +
						"</div></a></td>";
				}

				isNextThreeDaysCounterStart = true;
			} else {
				// while the days counter is not 3 days and the counter is started
				// disable day from picking
				if (nextThreeDaysCounter < 3 && isNextThreeDaysCounterStart) {
					currentWeek +=
						'<td class=""><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' +
						days +
						"</h6>" +
						"</div></a></td>";
					nextThreeDaysCounter++;
				} else {
					// other day of the month

					// if weekend disable day
					if (currentDayOfTheWeekName === "Sun" || currentDayOfTheWeekName === "Sat") {
						currentWeek +=
							'<td class=""><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' +
							days +
							"</h6>" +
							"</div></a></td>";
					} else {
						// disable previous days
						if (!isCurrentDayFound && month === date.getMonth())
							currentWeek +=
								'<td class=""><a role="button" aria-disabled="true" class="disabled text-decoration-none day opacity-50 text-dark"><div><h6>' +
								days +
								"</h6>" +
								"</div></a></td>";
						else
							currentWeek +=
								'<td class=""><a role="button" class="text-decoration-none day text-dark"><div><h6>' +
								days +
								"</h6>" +
								"</div></a></td>";
					}
				}
			}

			if (currentDayOfTheWeekName === "Sat") {
				allDates += openingTR + currentWeek + closingTR;
				currentWeek = "";
			}

			if (j === lastDayOfTheMonth) {
				allDates += openingTR + currentWeek + closingTR;
				currentWeek = "";
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

		handleConflictingDay(convertMonthToNumber(selectedMonth) + 1);
		handleFullyBooked();
		getHolidays();
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

		handleConflictingDay(convertMonthToNumber(selectedMonth) + 1);
		handleFullyBooked();
		getHolidays();
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

	function convertMonthToNumber(monthName) {
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
			if (months[index] === monthName) return index;
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

	function getCurrentDate() {
		let dayStr = $(".days-entries .bg-primary").find("h6").text();
		let hours = $(".hour").val();
		let minutes = $(".minutes").val();
		let day = parseInt(dayStr) < 10 ? "0" + dayStr : dayStr;
		let month = convertMonthToNumber($(".calendar-title").text()) + 1 + "";
		let year = global_year + "";

		return {
			month,
			day,
			year,
			hours,
			minutes,
		};
	}

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

		let dayStr = $(".days-entries .bg-primary").find("h6").text();
		let day = parseInt(dayStr) < 10 ? "0" + dayStr : dayStr;

		// handle conflicting dates
		populateTimeFlags(getCurrentDate());
		handleConflictingDates();

		$(".save-date-btn").data("day", day);

		prevDayElement = $(this);
	}

	$(".hour").change(changeHour);
	changeHour();

	function changeHour() {
		$(".save-date-btn").data("hour", $(".hour").val());
		if ($(".hour").val() > 12) $(".datetime").text("pm");
		else $(".datetime").text("am");

		populateTimeFlags(getCurrentDate());
		handleConflictingDates(true);
	}

	$(".minutes").change(changeMinutes);
	changeMinutes();

	function changeMinutes() {
		$(".save-date-btn").data("minutes", $(".minutes").val());
	}

	$(".save-date-btn").click(function () {
		// get all date values
		let month = $(".calendar-title").data("month") + 1;
		let day = $(this).data("day");
		let hour = $(".hour").val();
		let minutes = $(".minutes").val();

		// convert date values
		let currentDayOfTheWeekNumber = getCurrentDayOfTheWeek(month - 1, day, global_year);
		let currentDayOfTheWeekName = convertDayToName(currentDayOfTheWeekNumber);
		let selectedDate = `${global_year}-${month}-${day} ${hour}:${minutes}`;
		let datetime = hour > 12 ? "pm" : "am";

		// redefine elements
		$(".selected-date-con").removeClass("d-none");
		$("#sched").val(selectedDate);
		$("#new-sched").val(selectedDate);
		$(".selected-date").val(
			`${currentDayOfTheWeekName}, ${convertMonthToName(month - 1)} ${parseInt(
				day
			)}, ${global_year} ${hour % 12}:${minutes} ${datetime}`
		);
		$(this).prev().click();
	});

	$("#purpose").on("change", displayPersonIncharge);
	displayPersonIncharge();

	// display person incharge
	function displayPersonIncharge() {
		// hide person incharge and show others textarea
		if ($("#purpose").val() == "other") {
			$("#concern").prop("disabled", false);
			$("#concern").parent().removeClass("d-none");
			$(".person-incharge-con").parent().addClass("d-none");
			$(".person-incharge-con").html("");
			return;
		}

		let purpose = $("#purpose").val();

		// get employee incharge based on selected purpose
		$.ajax({
			type: "get",
			url: `${url}/user/get-incharge-employee/${purpose}`,
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

	// html template for person incharge
	function personInChargeCardTemplate(name, designation) {
		return `<div class="alert alert-info" role="alert">
                        <h6 class="m-0 fw-semibold">${name}</h5>
                        <small class="m-0">${designation}</small>
                    </div>`;
	}
});
