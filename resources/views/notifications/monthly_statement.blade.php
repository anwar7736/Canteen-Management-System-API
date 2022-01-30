<!DOCTYPE html>
<html lang="en">
<head>
  <title>Monthly Statement</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
   <div class="card">
        <div class="card-header">
        <span><b>Hi</b></span> <span style="color:gray">{{$name}},</span>
            <p style="color:blue">Please Check Your Monthly Statement</p>
            <p>Month of <span style="color:red">{{$month}}</span> <span style="color:green">{{$year}}</span></p>
           
        </div>
        <div class="card-body">
                <p>Total Lunch : <strong>{{$total_lunch}}</strong></p>
                <p>Total Lunch Cost : <strong>{{$total_lunch_cost}}TK</strong></p>
                <p>Total Dinner : <strong>{{$total_dinner}}</strong></p>
                <p>Total Dinner Cost : <strong>{{$total_dinner_cost}}TK</strong></p>
                <p>Total Meal : <strong>{{$total_meal}}</strong></p>
                <p>Total Meal Cost : <strong>{{$total_meal_cost}}TK</strong></p>
                <p>Total Payment : <strong>{{$total_payment}}TK</strong></p>
                <p>Total Due : <strong>{{$total_due}}TK</strong></p>
               <strong style="color:red">N.B : If there any due please clear your due as soon as possible!</strong>
        </div>
        <br><br>
        <div class="card-footer">
            <b style="color:green">Best Regards,</b><br/>
                {{env('APP_NAME')}} Support Team
        </div>
        
  </div>
</body>
</html>