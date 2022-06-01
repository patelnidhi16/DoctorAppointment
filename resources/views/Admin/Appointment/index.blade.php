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

            <button type="button" class="btn btn-primary addappointment" data-toggle="modal" data-target="#createapointment" data-backdrop="static" data-keyboard="false">
                Add Appointment
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
@include('Admin.Appointment.create')
@endsection


@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    $(document).on('click', '.addappointment', function() {

        $(document).find('#editdoctor').attr('id', 'createdoctor');
        $('#createdoctor').trigger('reset');

        $(document).on('click', '#submit', function() {

            $('.error').html("");
            $('#createappointment').validate({
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
                    doctor: {
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

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{route("admin.appointment.create")}}',
                        type: 'post',
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            $('.modal').remove();
                            $('.modal-backdrop').remove();
                            swal(1);
                        },
                        error: function(data) {
                            console.log(data);
                            var errors = $.parseJSON(data.responseText);

                            $.each(errors.errors, function(key, value) {
                                console.log(key);
                                console.log(value);
                                $('#createappointment').find('[name=' + key + ']').nextAll('span').html(value[0]);
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
                        url: '{{route("admin.appointment.delete")}}',
                        type: 'GET',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                            });
                            $('.modal-backdrop').remove();

                        }
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });

    });
</script>
@endpush