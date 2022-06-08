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


<div class="col-12 grid-margin stretch-card">
    <div class="card m-3">
        <div class="card-body">

            <div class="card">
                <div class="card-body">
                <form method="post" action="" id="example">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">

                    </div>
                    <div class="form-group">
                        <label for="myselect">Hobbies</label>
                        <select id='myselect' multiple name="hobbie[]" class="hobbie">
                            <option value="">Select An Option</option>
                            <option value="1"@if(in_array('1',$hobbie)) selected @endif>Option 1</option>
                            <option value="2"@if(in_array('2',$hobbie)) selected @endif>Option 2</option>
                            <option value="3"@if(in_array('3',$hobbie)) selected @endif>Option 3</option>
                        </select>
                    </div>
                    <br>

                    <input type="submit" class="btn btn-primary">
                </form>

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

<script>
    $('#myselect').select2({
        width: '100%',
        placeholder: "Select an Option",
    });

 

</script>
@endpush