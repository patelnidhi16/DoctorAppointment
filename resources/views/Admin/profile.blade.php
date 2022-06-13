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

<div class="card m-5">
    <div class="card-body">
        <form class="forms-sample" method="POST" id="profile" enctype="multipart/form-data">
            @csrf
<input type="hidden" name="id" id="id" value="{{Auth::guard('admin')->user()->id}}">
            <div class="form-group">
                <label for="name">Enter Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{Auth::guard('admin')->user()->name}}">
                <span class="error"></span>

            </div>
            <div class="form-group">
                <label for="email">Enter Email</label>
                <input type="text" class="form-control" id="email" placeholder="Enter email"  name="email" value="{{Auth::guard('admin')->user()->email}}">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="image">Upload profuile Picture</label>
                <input type="file" class="form-control" id="image" name="image">
                <span class="error"></span>

            </div>

            <button type="submit" class="btn btn-primary mr-2 " id="submit">Submit</button>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

@endsection


@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<script>
    $('#profile').validate({
        rules: {

            email: {
                required: true,

            },
        },
         messages: {

            email: {
                required: "Email is required field",
            },
        },
        submitHandler: function(form) {
         
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route("admin.createprofile")}}',
                type: 'post',
                data: new FormData(form),
            
                success: function(data) {
                    alert(1);

                },
                error: function(data) {


                },
            });

        }
    });
</script>
@endpush