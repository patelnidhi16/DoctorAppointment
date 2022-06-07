@extends('Admin.layouts.master')
@section('content')
<div class="content-wrapper">

  <div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">
                <h4 class="text-muted font-weight-normal"><b>Today's Appointment</b></h4>
                
              </div>
            </div>
            
          </div>
          
          <h3 class="mb-0">{{$todayappointmentcount}}</h3>
         
        </div>
      </div>
      <div class="card ml-4">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">
                <h4 class="text-muted font-weight-normal"><b>Total Patient </b></h4>
                
              </div>
            </div>
            
          </div>
          
         
          <h3 class="mb-0">{{$patientcount}}</h3>
         
        </div>
      </div>
      <div class="card ml-4">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">
                <h4 class="text-muted font-weight-normal"><b>Total Doctors</b></h4>
                
              </div>
            </div>
            
          </div>
          
        
          <h3 class="mb-0">{{$doctorscount}}</h3>
        </div>
      </div>
      <div class="card ml-4">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">
                <h4 class="text-muted font-weight-normal"><b>Total Appointment</b></h4>
                
              </div>
            </div>
            
          </div>
          
        
          <h3 class="mb-0">{{$totalappointmentcount}}</h3>
        </div>
      </div>
     
    </div>
    
  </div>
  <div class="row">
  
      @foreach($doctor_info as $info)
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card mr-4">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">
                <h5 class="text-muted font-weight-normal"><b>Doctor Name:-{{$info['getdoctor'][0]['name']}}</b></h5>   
              </div>
            </div>
            
          </div>
          
          Total Appointment:-<h3 class="mb-0">{{$info['total']}}</h3>
         
        </div>
      </div>
      </div>
      @endforeach
    
    
  </div>
  <div class="row">
    @foreach($today_doctor_info as $info)
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card mr-4">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">
                <h5 class="text-muted font-weight-normal"><b>Doctor Name:-{{$info['getdoctor'][0]['name']}}</b></h5>   
              </div>
            </div>
          </div>
          
          Today Appointment:-<h3 class="mb-0">{{$info['total']}}</h3>
         
        </div>
      </div>
    </div>
    @endforeach
    
  </div>
  

</div>
@endsection