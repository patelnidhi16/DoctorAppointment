<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sunshine</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
    <!-- End layout styles -->
    <!-- <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.png')}}" /> -->
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5" style="height: 400px;width: 532px;">
                            <h3 class="card-title text-left mb-3">Login</h3>
                            <form method="POST" id="loginform" action="{{route('admin.login')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input type="text" class="form-control p_input" name="email" value="{{old('email')}}">
                                    @error('email')
                                    <div class="error text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password *</label>
                                    <input type="password" class="form-control p_input" name="password">
                                    @error('password')
                                    <div class="error text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                             
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
   

    <!-- endinject -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>

<script>
    $('#loginform').validate({
        rules: {
            email: {
           
                required: true,
                email: true,
                pattern:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i,
            },
            password: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Email field is required",
                email: "Please enter email in valid formate",
                pattern:"Please enter email in valid formates",
            },
            password: {
                required:  "Password field is required",
            },
        },
       
    });
</script>

</html>