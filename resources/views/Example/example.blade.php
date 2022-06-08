<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <style>

    </style>
</head>

<body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</body>

</html>


@extends('Admin.layouts.master')
@push('style')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

<style>
    .error,
    span.error {
        color: red;
        font-size: 15px;
    }

    #output {
        padding: 20px;
        background: #dadada;
    }

    form {
        margin-top: 20px;
    }

    select {
        width: 300px;
    }
</style>
@endpush
@section('content')
<!-- Button trigger modal -->
<div class="m-5">

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="width: 50px;">
        Add
    </button>
    <a href="{{ route('admin.student.export') }}" class="btn btn-success float-right" style="width: 70px;">
        Export
    </a>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="example">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">

                    </div>
                    <div class="form-group">
                        <label for="myselect">Hobbies</label>
                        <select id='myselect' multiple name="hobbie[]" class="hobbie">
                            <option value="">Select An Option</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                    </div>
                    <br>

                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="col-12 grid-margin stretch-card">
    <div class="card m-3">
        <div class="card-body">

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
<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js">
</script>
{!! $dataTable->scripts() !!}

<script>
    $('#myselect').select2({
        width: '100%',
        placeholder: "Select an Option",
    });

    $('hobbie').each(function() {
        $(this).rules("add", {
            required: true
        })
    });
    $('#example').validate({
        rules: {
            'hobbie[]': {
                required: true,
            },
            name: {
                required: true,
            },
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            $(element).parents("div.form-control").addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).parents(".error").removeClass(errorClass).addClass(validClass);
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parents('.form-group'));
        },
        submitHandler: function(form) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route("admin.examplestore")}}',
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
</script>
@endpush