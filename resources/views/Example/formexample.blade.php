<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <style type="text/css">
        #personal_information,
        #company_information {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col">
            <form class="form-horizontal" action="" method="POST" id="myform">
                <fieldset id="account_information" class="">
                    <legend>Account information</legend>
                    <input type="text" name="fname" placeholder="First Name"  class="form-control col-10"/>
                    <input type="text" name="lname" placeholder="Last Name"  class="form-control col-10"/>
                    <input type="text" name="phone" placeholder="Phone"  class="form-control col-10"/>
                    <p><a class="btn btn-primary next">next</a></p>
                </fieldset>


                <fieldset id="company_information" class="">
                    <legend>Account information</legend>

                    <input type="text" name="twitter" placeholder="Twitter" class="form-control col-10"/>
                    <input type="text" name="facebook" placeholder="Facebook"  class="form-control col-10"/>
                    <input type="text" name="gplus" placeholder="Google Plus" class="form-control col-10" />
                    <p><a class="btn btn-primary next">next</a></p>
                </fieldset>

                <fieldset id="personal_information" class="">
                    <legend>Personal information</legend>

                    <input type="text" name="email" placeholder="Email"  class="form-control col-10"/>
                    <input type="password" name="pass" placeholder="Password" />
                    <input type="password" name="cpass" placeholder="Confirm Password" class="form-control col-10" />
                    <p><a class="btn btn-primary" id="previous">Previous</a></p>
                    <p><input class="btn btn-success" type="submit" value="submit"></p>
                </fieldset>

            </form>

        </div>
    </div>


</body>

</html>


<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/jquery-1.9.0.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>

<script>
    $(document).ready(function() {

        $(".next").click(function() {
            var form = $("#myform");
            console.log(form);
            form.validate({
                rules: {
                    fname: {
                        required: true,


                    },
                    lname: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    twitter: {
                        required: true,
                    },
                    google: {
                        required: true,
                    },
                    facebook: {
                        required: true,
                    },


                },

            });
            if (form.valid() === true) {
                if ($('#account_information').is(":visible")) {
                    current_fs = $('#account_information');
                    next_fs = $('#company_information');
                } else if ($('#company_information').is(":visible")) {
                    current_fs = $('#company_information');
                    next_fs = $('#personal_information');
                }
                next_fs.show();
                current_fs.hide();
            }
        });

        $('#previous').click(function() {
            if ($('#company_information').is(":visible")) {
                current_fs = $('#company_information');
                next_fs = $('#account_information');
            } else if ($('#personal_information').is(":visible")) {
                current_fs = $('#personal_information');
                next_fs = $('#company_information');
            }
            next_fs.show();
            current_fs.hide();
        });


    });
</script>
</body>

</html>