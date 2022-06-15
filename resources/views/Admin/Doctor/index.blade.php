@extends('Admin.layouts.master')
@push('style')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css" rel="stylesheet">


<style>
  .error {
    color: red;
    font-size: 15px;
  }

  label.error {
    display: inline-block !important;
  }
</style>
@endpush
@section('content')


<div class="col-12 grid-margin stretch-card">
  <div class="card m-3">
    <div class="card-body">
      <!-- Button trigger modal -->

      <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false">
        <span class="iconify" data-icon="carbon:add-filled" data-width="20" data-height="20"></span>
      </button>
      <!-- Modal -->
      <div class="card">
        <div class="card-body">
          <select class="form-control col-2 ml-5" id="shift_filter" name="date">
            <option value=" ">Select Shift </option>
            <option value="1">Morning</option>
            <option value="2">Evening</option>
          </select>
          {!! $dataTable->table(['class' => 'table table-striped zero-configuration dataTable']) !!}
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
@section('modal')
@include('Admin.Doctor.create')
@endsection


@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
{!! $dataTable->scripts() !!}
<script>
  $('#doctor-table').on('preXhr.dt', function(e, settings, data) {
    data.shift = $('#shift_filter').val();

    console.log(data.doctor);
    // data.title = $('#title_filter').val();
    console.log(data);
  });
  $(document).on('change', '#shift_filter', function() {
    window.LaravelDataTables['doctor-table'].draw();

  });
  $(document).on('click', '.add', function() {
    $('.error').html("");
    $(document).find('#editdoctor').attr('id', 'createdoctor');
    $('#createdoctor').trigger('reset');

    $(document).on('click', '#submit', function() {

      $('.error').html("");
      $('#createdoctor').validate({
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
          shift: {
            required: true,
          },

          start_time: {
            required: true,
          },
          end_time: {
            required: true,
          },
        },

        messages: {
          first_name: {
            required: "First name is required field",
          },
          shift: {
            required: "Shift is required field",
          },
          last_name: {
            required: "Last name is required field",
          },
          email: {
            required: "Email  is required field",
          },
          mobile: {
            required: "Mobile  is required field",
          },
          start_time: {
            required: "Start time  is required field",
          },
          end_time: {
            required: "End time  is required field",
          },
        },
        submitHandler: function(form) {

          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{route("admin.doctor.create")}}',
            type: 'post',
            data: new FormData(form),
            processData: false,
            contentType: false,
            success: function(data) {
              $('#exampleModal').hide();
              $('.modal-backdrop').remove();
              swal("doctor inserted successfully");
              window.LaravelDataTables["doctor-table"].draw();

            },
            error: function(data) {
              console.log(data);
              var errors = $.parseJSON(data.responseText);

              $.each(errors.errors, function(key, value) {
                console.log(key);
                console.log(value);
                $('#createdoctor').find('[name=' + key + ']').next('label').html(value[0]);
              });
            },
          });
        }
      });
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
            url: '{{route("admin.doctor.delete")}}',
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
          swal("Your record is safe!");
        }
      });
  });

  $(document).on('click', '.edits', function() {
    // $('body').addClass('modal-open');
    // $('body').addClass('modal-open');
    // $('#exampleModal').addClass('modal fade show');
    $('.error').html("");
    $('.form-control').removeClass('error');
    $(document).find('#createdoctor').attr('id', 'editdoctor');
    var id = $(this).attr('dataid');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '{{route("admin.doctor.edit")}}',
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
        $('#password').val(data.password);
        $('#mobile').val(data.mobile);
        $('#shift').val(data.shift);
        $('#start_time').val(data.start_time);
        $('#end_time').val(data.end_time);
      }
    });
  });
  $(document).on('click', '#submit', function() {

    $('#editdoctor').validate({
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
        shift: {
          required: true,
        },

        start_time: {
          required: true,
        },
        end_time: {
          required: true,
        },
      },

      messages: {
        first_name: {
          required: "First name is required field",
        },
        shift: {
          required: "Shift is required field",
        },
        last_name: {
          required: "Last name is required field",
        },
        email: {
          required: "Email  is required field",
        },
        mobile: {
          required: "Mobile  is required field",
        },
        start_time: {
          required: "Start time  is required field",
        },
        end_time: {
          required: "End time  is required field",
        },
      },
      submitHandler: function(form) {
        //  
        swal({
            title: "Are you sure?",
            text: "Once updated, you will not be able to recover this imaginary file!",
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
                url: '{{route("admin.doctor.create")}}',
                type: 'post',
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function(data) {

                  $('#exampleModal').hide();
                  $('.modal-backdrop').remove();
                  swal("doctor updated successfully");
                  window.LaravelDataTables["doctor-table"].draw();
                },
                error: function(data) {

                  console.log(data);
                  var errors = $.parseJSON(data.responseText);

                  $.each(errors.errors, function(key, value) {
                    console.log(key);
                    console.log(value);
                    $('#editdoctor').find('[name=' + key + ']').next('label').html(value[0]);
                  });
                },
              });
            } else {
              swal("Your record file is safe!");
            }
          });
        // 

      }
    });
  });
  
</script>
@endpush