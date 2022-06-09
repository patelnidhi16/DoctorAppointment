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

      <button type="button" title="Add Patient" class="btn btn-primary add" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false">

        <span class="iconify" data-icon="carbon:user-avatar-filled" data-width="20" data-height="20"></span>
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
<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
{!! $dataTable->scripts() !!}
<script>
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
  $(document).on('click', '.add', function() {
    $('#createpatient').trigger('reset');

    $('.error').html("");
    $(document).on('click', '#submit', function() {

      $('.error').html("");
      $('#createpatient').validate({
        rules: {
          first_name: {
            required: true,
          },
          last_name: {
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
       messages:{
         first_name:{
           required:"First name is required field",
         },
         last_name:{
           required:"Last name is required field",
         },
         email:{
           required:"Email  is required field",
         },
         mobile:{
           required:"Mobile  is required field",
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
              swal("patient inserted successfully");
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
    $('#addappointment').trigger('reset');
    $('.error').html("");
    $('.form-control').removeClass('error');
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
          
          shift: {
            required: true,
          },


        },
        messages:{
         date:{
           required:"Date name is required field",
         },
         start_time:{
           required:"Start time name is required field",
         },
         end_time:{
           required:"End Time  is required field",
         },
         shift:{
           required:"Shift  is required field",
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
                $('span.error ').html("");
                swal(data.msg);
              } else {
                $('.modal-backdrop').remove();
                $('.modal').remove();
                swal(data.msg);

                setTimeout(function() {
                  window.location.reload(1);
                }, 3000);
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
              window.LaravelDataTables["patient-table"].draw();


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
        var name = data.name;

        var first_name = name.split(' ')[0];
        var last_name = name.split(' ')[1];
        $('#id').val(data.id);
        $('#first_name').val(first_name);
        $('#last_name').val(last_name);
        $('#email').val(data.email);
        $('#mobile').val(data.mobile);
      }
    });
  });

  $(document).on('click', '#submit', function() {

    $('#editpatient').validate({
      rules: {
          first_name: {
            required: true,
          },
          last_name: {
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
       messages:{
         first_name:{
           required:"First name is required field",
         },
         last_name:{
           required:"Last name is required field",
         },
         email:{
           required:"Email  is required field",
         },
         mobile:{
           required:"Mobile  is required field",
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
                  swal("patient updated successfully");

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