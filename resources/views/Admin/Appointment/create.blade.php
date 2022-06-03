<div class="modal fade" id="createapointment" tabindex="-1" role="dialog" aria-labelledby="createapointment" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Add Doctors</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="forms-sample" method="POST" id="createappointment">
                    @csrf

                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                        <span class="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                        <span class="error"></span>

                    </div>

                    <div class="form-group">
                        <label for="mobile">Mobile No.</label>
                        <input type="number" class="form-control" id="mobile" placeholder="Mobile No." name="mobile">
                        <span class="error"></span>

                    </div>
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
                            @foreach($doctors as $doctor)
                            <option value="{{$doctor->id}}" name="doctor_id">{{$doctor->name}}</option>
                            @endforeach
                        </select>
                        <span class="error"></span>

                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" placeholder="Mobile No." name="date">
                        <span class="error"></span>

                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input type="time" class="form-control" id="start_time" placeholder="start time " name="start_time">
                        <span class="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="end_time">End Time</label>
                        <input type="time" class="form-control" id="end_time" placeholder="end time" name="end_time">
                        <span class="error"></span>

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