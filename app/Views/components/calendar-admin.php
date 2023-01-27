<!-- modal -->
<div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Choose a date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="calendar flex-fill" style="max-width: 25rem;">
                    <div class="calendar-grid m-0 p-0 calendar-set-appointment">
                        <div class="w-full">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn prev-month">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                                        <line x1="19" y1="12" x2="5" y2="12"></line>
                                        <polyline points="12 19 5 12 12 5"></polyline>
                                    </svg>
                                </button>
                                <h3 class="fw-semibold calendar-title">January</h3>
                                <button type="button" class="btn next-month">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="calendar-con">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Sun</th>
                                        <th scope="col">Mon</th>
                                        <th scope="col">Tue</th>
                                        <th scope="col">Wed</th>
                                        <th scope="col">Thu</th>
                                        <th scope="col">Fri</th>
                                        <th scope="col">Sat</th>
                                    </tr>
                                </thead>
                                <tbody class="days-entries">

                                </tbody>
                            </table>
                            <div class="d-flex flex-column align-items-center">
                                <div style="width: fit-content;">
                                    <h4 class="fw-semibold">Time</h4>
                                </div>
                                <div class="d-flex gap-3 align-items-center" style="max-width: 15rem;">
                                    <select class="form-select text-center hour">
                                        <option value="07">7</option>
                                        <option value="08">8</option>
                                        <option value="09">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="13">1</option>
                                        <option value="14">2</option>
                                        <option value="15">3</option>
                                    </select>
                                    <span>:</span>
                                    <select class="form-select text-center minutes">
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </select>
                                    <div class="datetime">
                                        pm
                                    </div>
                                </div>
                                <!-- <div class="spinner-border text-primary mt-3" style="width: 20px; height: 20px" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="alert text-danger py-2" role="alert">
                                        <small>asd</small>
                                    </div> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <div>
                    <small><b>Legend:</b></small>
                    <div class="d-flex align-items-center" role="alert">
                        <span class="bg-danger rounded-circle" style="width: 10px; height: 10px;"></span>
                        <small class="ms-2">
                            Cannot set appointment
                        </small>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-date-btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url("/src/js/calendar-admin.js") ?>">

</script>