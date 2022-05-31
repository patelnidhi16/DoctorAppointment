@extends('Admin.layouts.master')
@push('style')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
  .error {
    color: red;
  }
</style>
@endpush
@section('content')
<div class="col-12 grid-margin stretch-card">
  <div class="card m-3">
    <div class="card-body">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false">
        Add Doctor
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Doctors</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form class="forms-sample" method="POST" id="createadmin">
                @csrf
                <div class="form-group">
                  <label for="exampleInputName1">Name</label>
                  <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" name="name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail3">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                  <label for="mobile">Mobile No.</label>
                  <input type="text" class="form-control" id="mobile" placeholder="Mobile No." name="mobile">
                </div>
                <div class="form-group">
                  <label for="shift">Select Shift</label>
                  <select class="form-control" id="shift" name="shift">
                    <option value="">Select Shift</option>
                    <option value="1">Morning</option>
                    <option value="2">Evening</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="start_time">Start Time</label>
                  <input type="time" class="form-control" id="start_time" placeholder="start time " name="start_time">
                </div>
                <div class="form-group">
                  <label for="end_time">End Time</label>
                  <input type="time" class="form-control" id="end_time" placeholder="end time" name="end_time">
                </div>


                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-dark">Cancel</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
  <div class="card-body">
   
    {!! $dataTable->table(['class' => 'table table-striped zero-configuration dataTable']) !!}
  </div>
</div>

    </div>
  </div>
</div>
@endsection

@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
{!! $dataTable->scripts() !!}
<script>
  $('#createadmin').validate({
    rules: {
      name: {
        required: true,
      },
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
      },
      mobile: {
        required: true,
      },

      start_time: {
        required: true,
      },
      end_time: {
        required: true,
      },
    },
    submitHandler: function(form) {

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{route("admin.doctor.create")}}',
        type: 'POST',
        data: new FormData(form),
        success: function(data) {
          alert(1);
        },
        error: function(data) {
          alert(12);
        }
      });
    }
  });
</script>
@endpush