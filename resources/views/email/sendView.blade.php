
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
               <h2>WELCOME</h2>	
               <h4> Thank You For Signing Up! </h4>
                <div class="panel-body">
                  <p>To verify Email <a href="{{route('sendEmailDone',['email' => $user->email,'verifyToken'=>$user->verifyToken])}}">click here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
