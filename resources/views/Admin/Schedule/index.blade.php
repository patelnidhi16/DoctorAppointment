@extends('Admin.layouts.master')
@push('style')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
  .error,
  span.error {
    color: red;
    font-size: 15px;
  }
</style>
@endpush
@section('content')
<div class="col-12 grid-margin stretch-card">
  <div class="card m-3">
    <div class="card-body">
      <!-- Button trigger modal -->


      <!-- Modal -->
      <div class="card">
        <div class="card-body">

          {!! $dataTable->table(['class' => 'table table-striped zero-configuration dataTable']) !!}
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
@section('modal')
@include('Admin.Patient.create')
@endsection


@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
{!! $dataTable->scripts() !!}
<script>
  $(document).ready(function() {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '{{route("admin.schedule.list")}}',
      type: 'get',
      success: function(data) {
        var list = "";

        $('#doctor').html('<option value="">Select Doctor</option>');
        $.each(data, function(key, value) {
          $("#doctor").append('<option value="' + value.id + '">' + value.name + '</option>');
        });
      }
    });
    $(function() {
      var dtToday = new Date();

      var month = dtToday.getMonth() + 1;
      var day = dtToday.getDate();
      var year = dtToday.getFullYear();
      if (month < 10)
        month = '0' + month.toString();
      if (day < 10)
        day = '0' + day.toString();

      var minDate = year + '-' + month + '-' + day;

      $('#date').attr('min', minDate);
    });
    $(document).on('click', '.delete', function() {
      id = $(this).attr('dataid');
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: '{{route("admin.schedule.delete")}}',
              type: 'GET',
              data: {
                id: id
              },
              success: function(data) {
                swal("Poof! Your imaginary file has been deleted!", {
                  icon: "success",
                });
                window.LaravelDataTables["schedule-table"].draw();


              }
            });
          } else {
            swal("Your imaginary file is safe!");
          }
        });

    });

    $(document).on('click', '.edit', function() {
      $('.error').html("");
      $('.form-control').removeClass('error');
      $(document).find('#addappointment').attr('id', 'editappointment');
      var id = $(this).attr('dataid');
      // $('.address,#remove').parent().remove();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{route("admin.schedule.edit")}}',
        type: 'get',
        data: {
          id: id
        },
        success: function(data) {
          $('#shift').val(data.shift);
          $('#doctor').val(data.doctor_id);
          $('#user_id').val(data.user_id);
          $('#editappointment').find('#id').val(data.id);
          $('#date').val(data.date);
          $('#start_time').val(data.start_time);
          $('#end_time').val(data.end_time);
        }
      });
    });

    $(document).on('change', '#shift', function() {
      id = $(this).val();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{route("admin.patient.getdoctorlist")}}',
        type: 'get',
        data: {
          id: id,
        },

        success: function(data) {
          var list = "";
          $('#doctor').html('<option value="">Select Doctor</option>');
          $.each(data, function(key, value) {
            $("#doctor").append('<option value="' + value.id + '">' + value.name + '</option>');
          });
        }
      });
    });
    $(document).on('click', '#submit', function() {

      $('#editappointment').validate({
        rules: {
          shift: {
            required: true,
          },
          doctor_id: {
            required: true,

          },

          date: {
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
          //  
          swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this imaginary file!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: '{{route("admin.schedule.create")}}',
                  type: 'post',
                  data: new FormData(form),
                  processData: false,
                  contentType: false,
                  success: function(data) {
                 
                    if (data.status == false) {
                      $('span.error').html("");
                      swal(data.msg);
                    } else {
                      $('.modal').remove();
                      $('.modal-backdrop').remove();
                      swal(data.msg);
                    }
                    window.LaravelDataTables["schedule-table"].draw();
                  },
                  error: function(data) {

                    console.log(data);
                    var errors = $.parseJSON(data.responseText);

                    $.each(errors.errors, function(key, value) {
                      console.log(key);
                      console.log(value);
                      $('#editdoctor').find('[name=' + key + ']').nextAll('span').html(value);
                    });
                  },
                });
              } else {
                swal("Your imaginary file is safe!");
              }
            });

        }
      });
    });
    $(document).on('change', '#shift', function() {
      id = $(this).val();

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{route("admin.schedule.getdoctorlists")}}',
        type: 'get',
        data: {
          id: id,
        },

        success: function(data) {
          var list = "";
          console.log(data);
          $('#doctor').html('<option value="">Select Doctor</option>');
          $.each(data, function(key, value) {
            $("#doctor").append('<option value="' + value.id + '">' + value.name + '</option>');
          });
        }
      });
    });
  });
</script>
@endpush