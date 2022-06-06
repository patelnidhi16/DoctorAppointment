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

      <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false">
        Add Patient
      </button>
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
{!! $dataTable->scripts() !!}
<script>
 
  $(document).on('click', '.add', function() {


    $(document).on('click', '#submit', function() {

      $('.error').html("");
      $('#createpatient').validate({
        rules: {
          name: {
            required: true,
          },
          email: {
            required: true,
            email: true,
          },
          mobile: {
            required: true,
          },


        },
        submitHandler: function(form) {

          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{route("admin.patient.create")}}',
            type: 'post',
            data: new FormData(form),
            processData: false,
            contentType: false,
            success: function(data) {
              $('#exampleModal').hide();

              $('.modal-backdrop').remove();
              swal("data inserted successfully");
              window.LaravelDataTables["patient-table"].draw();
            },
            error: function(data) {
              console.log(data);
              var errors = $.parseJSON(data.responseText);

              $.each(errors.errors, function(key, value) {
                console.log(key);
                console.log(value);
                $('#createpatient').find('[name=' + key + ']').nextAll('span').html(value[0]);
              });
            },
          });
        }
      });
    });

  });
  $(document).on('click', '.schedule', function() {
    var user_id = $(this).attr('dataid');

    $(document).on('click', '#submit', function() {

      $('#addappointment').validate({
        rules: {
          date: {
            required: true,
          },
          start_time: {
            required: true,
          },
          end_time: {
            required: true,
          },
          date: {
            required: true,
          },
          shift: {
            required: true,
          },


        },
        submitHandler: function(form) {
          $('#addappointment').find('#user_id').val(user_id);
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
                swal(data.msg);
              } else {
                $('.modal-backdrop').remove();
                $('.modal').remove();
                swal({
                  title: "Good job!",
                  text: data.msg,
                  type: "success",
                  button: "Aww yiss!",
                  timer: 5000
                });

                window.LaravelDataTables["patient-table"].draw();
              }
            },
            error: function(data) {
              console.log(data);
              var errors = $.parseJSON(data.responseText);

              $.each(errors.errors, function(key, value) {
                console.log(key);
                console.log(value);
                $('#addappointment').find('[name=' + key + ']').nextAll('span').html(value[0]);
              });
            },
          });
        }
      });
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
            url: '{{route("admin.patient.delete")}}',
            type: 'GET',
            data: {
              id: id
            },
            success: function(data) {
              swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
              });
              window.LaravelDataTables["doctor-table"].draw();


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
    $(document).find('#createpatient').attr('id', 'editpatient');
    var id = $(this).attr('dataid');

    // $('.address,#remove').parent().remove();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '{{route("admin.patient.edit")}}',
      type: 'get',
      data: {
        id: id
      },
      success: function(data) {
        $('#id').val(data.id);
        $('#name').val(data.name);
        $('#email').val(data.email);
        $('#mobile').val(data.mobile);
      }
    });
  });

  $(document).on('click', '#submit', function() {

    $('#editpatient').validate({
      rules: {
        name: {
          required: true,
        },
        email: {
          required: true,
          email: true,
        },

        mobile: {
          required: true,
        },


      },
      submitHandler: function(form) {
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
                url: '{{route("admin.patient.create")}}',
                type: 'post',
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function(data) {
                  $('#exampleModal').hide();
                  $('.modal-backdrop').remove();
                  swal("your data updated successfully");
                  window.LaravelDataTables["patient-table"].draw();
                },
                error: function(data) {
                  var errors = $.parseJSON(data.responseText);
                  $.each(errors.errors, function(key, value) {
                    console.log(key);
                    console.log(value);
                    $('#editpatient').find('[name=' + key + ']').nextAll('span').html(value[0]);
                  });
                },
              });
            } else {
              swal("Your imaginary file is safe!");
            }
          });
        // 

      }
    });
  });
</script>
@endpush