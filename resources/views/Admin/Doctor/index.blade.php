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

      <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false">
        Add Doctor
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
@include('Admin.Doctor.create')
@endsection


@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{!! $dataTable->scripts() !!}
<script>
  $(document).on('click', '.add', function() {
    
    $(document).find('#editdoctor').attr('id', 'createdoctor');
    $('#createdoctor').trigger('reset');

    $(document).on('click', '#submit', function() {

      $('.error').html("");
      $('#createdoctor').validate({
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
            type: 'post',
            data: new FormData(form),
            processData: false,
            contentType: false,
            success: function(data) {
              $('#exampleModal').hide();
           
              $('.modal-backdrop').remove();
              swal("data inserted successfully");
            },
            error: function(data) {
              console.log(data);
              var errors = $.parseJSON(data.responseText);

              $.each(errors.errors, function(key, value) {
                console.log(key);
                console.log(value);
                $('#createdoctor').find('[name=' + key + ']').nextAll('span').html(value[0]);
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
    $(document).find('#createdoctor').attr('id', 'editdoctor');
    var id = $(this).attr('dataid');

    // $('.address,#remove').parent().remove();
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
        console.log(data);
        $('#id').val(data.id);
        $('#name').val(data.name);
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

      start_time: {
        required: true,
      },
      end_time: {
        required: true,
      },
    },
    submitHandler: function(form) {
      alert(121);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{route("admin.doctor.update")}}',
        type: 'post',
        data: new FormData(form),
        processData: false,
        contentType: false,
        success: function(data) {
         
        },
        error: function(data) {
          alert(21);
          console.log(data);
          var errors = $.parseJSON(data.responseText);

          $.each(errors.errors, function(key, value) {
            console.log(key);
            console.log(value);
            $('#editdoctor').find('[name=' + key + ']').nextAll('span').html(value[0]);
          });
        },
      });
    }
  });
  });
</script>
@endpush