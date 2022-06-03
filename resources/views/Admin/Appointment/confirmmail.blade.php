<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="">
    <title>Confirmation Mail</title>
</head>

<body style="font-family: 'Rubik', sans-serif; margin: 0px;padding-top: 0;padding-bottom: 0;padding-top: 0;padding-bottom: 0;background-color: #f1f1f1;background-repeat: repeat;width: 100% !important;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;-webkit-font-smoothing: antialiased;">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap');
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css');
    </style>
    <table style="max-width: 600px; width: 600px; margin: 0px auto;" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
          
                <td style="padding-top: 50px; padding-bottom: 50px;">
                    <table width="100%" height="100%" cellpadding="0" cellspacing="0" align="left">
                        <tbody>
                    
                            <tr>
                                <td style="padding: 0; background-color: #fff; border-radius: 10px;">
                                    <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 15px; padding-bottom: 40px;" align="center">
                                                    <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td align="center" style="padding: 40px 20px; background-color: #999898; border-radius: 10px;">
                                                                <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5" style=" text-decoration-line:none;">
                                                                    <h2 class="m-0 text-primary" style="color: black;"><i class="fa fa-book me-3"></i> eHospital</h2>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px 50px;">
                                                    <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td style="padding-bottom: 20px;">
                                                                <h1 style="font-size: 20px; font-weight: 600; color: #000000; margin: 0; margin-bottom: 30px; font-family: 'Rubik', sans-serif; text-align: center;">Appointment Detail</h1>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-bottom: 20px;">
                                                                <p style="font-family: 'Rubik', sans-serif;font-size: 14px; font-weight: 400; line-height: 20px; color: #637b96; margin: 0; letter-spacing: 0.5px; line-height: 24px; ">Dear <b>{{$name}}</b>,<br>
                                                                 Your An  Appointment has been scheduled with Doctor <b>{{$doctor}}</b>.  <br>
                                                                   <p style="font-size: 20px;"> <b>Schedule:</b></p>
                                                                <b>Date:</b> {{$date}}<br>
                                                                <b>Startt Time:</b> {{$starttime}}<br>
                                                                <b>End Time:</b> {{$endtime}}<br>
                                                                   
                            
                                                              
                            
                                                               
                                                            </td>
                                                        </tr>
                                                       
                                                     
                                                        <tr>
                                                            <td style="padding-bottom: 50px;">
                                                                <div style="display: block; font-family: 'Rubik', sans-serif;">
                                                                    <p style="font-size: 14px; font-family: 'Rubik', sans-serif; font-weight: 400; line-height: 20px; color: #637b96;margin: 0; letter-spacing: 0.5px; line-height: 24px;">
                                                                        Warm regards,</p>
                                                                    <h6 style="font-family: 'Rubik', sans-serif;margin:0;font-size: 15px; font-weight: 600; color: #1e2e50;">Elearning</h6>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>