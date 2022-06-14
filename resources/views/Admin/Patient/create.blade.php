<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="overlay"></div>

                <form class="forms-sample" method="POST" id="createpatient">
                    @csrf
                    <input type="hidden" id="id" name="id">

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name">

                        <label class="error"></label>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" placeholder="Enter Name" name="last_name">
                        <label class="error"></label>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                        <label class="error"></label>

                    </div>

                    <div class="form-group">
                        <label for="mobile">Mobile No.</label>
                        <input type="number" class="form-control" id="mobile" placeholder="Mobile No." name="mobile">
                        <label class="error"></label>

                    </div>





                    <button type="submit" class="btn btn-primary mr-2 " id="submit">Submit</button>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="appointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="forms-sample" method="POST" id="addappointment">
                    @csrf

                    <input type="hidden" id="user_id" name="user_id">
                    <input type="hidden" id="id" name="id">


                    <div class="form-group">
                        <label for="shift">Select Shift</label>
                        <select class="form-control" id="shift" name="shift">
                            <option value="">Select Shift</option>
                            <option value="1" class="shift" name="1">Morning</option>
                            <option value="2" class="shift" name="2">Evening</option>
                        </select>
                        <span class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="doctor">Select Doctor</label>
                        <select class="form-control" id="doctor" name="doctor_id">
                            <option value="">Select Doctor</option>

                        </select>
                        <label class="error"></label>

                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" placeholder="Mobile No." name="date">
                        <label class="error"></label>

                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input type="time" class="form-control" id="start_time" placeholder="start time " name="start_time">
                        <label class="error"></label>
                    </div>
                    <div class="form-group">
                        <label for="end_time">End Time</label>
                        <input type="time" class="form-control" id="end_time" placeholder="end time" name="end_time">
                        <label class="error"></label>

                    </div>


                    <button type="submit" class="add_appointment_btn btn btn-primary mr-2 " id="submit">Submit</button>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>