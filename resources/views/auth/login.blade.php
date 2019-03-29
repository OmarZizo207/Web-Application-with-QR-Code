<!DOCTYPE html>
<html>
<head>
   
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   
   <title> {{ lang() === 'ar' ? setting()->sitename_ar : setting()->sitename_en . ' . ' . trans('admin.login') }} </title>

   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,600" rel="stylesheet">
   
   <!-- Bootstrap -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
   
   
   <link rel="stylesheet" href="{{ url('design/style') }}/css/login/login.css">

</head>
<body>

<div class="container">
   <section id="formHolder">
        @include('auth.message')

      <div class="row">

         <!-- Brand Box -->
         <div class="col-sm-6 brand">
            <a href="#" class="logo"> <img src="{{ Storage::url(setting()->logo) }}"> </a>

            <div class="heading">
               <h2>{{ lang() === 'ar' ? setting()->sitename_ar : setting()->sitename_en }}</h2>
               <p >{{ trans('user.your_right_choice') }}</p>
            </div>

            <div class="success-msg">
               <p>{{ trans('user.welcome_message') }}</p>
               <a href="#" class="profile">Your Profile</a>
            </div>
         </div>

         <!-- Form Box -->
         <div class="col-sm-6 form">
            
            <!-- Login Form -->
            <div class="login form-peice">
               <form class="login-form" action="{{ url('login') }}" method="post">
                @csrf
                  <div class="form-group">
                     <label for="email">{{ trans('user.email_address') }}</label>
                     <input type="email" name="email" value="{{ old('email') }}" id="loginemail" required>
                  </div>

                  <div class="form-group">
                     <label for="password">{{ trans('user.password') }}</label>
                     <input type="password" name="password" id="loginPassword" required>
                  </div>
                  <div class="CTA">
                     <input type="submit" value="{{ trans('user.login') }}">
                     <a href="#" class="switch">{{ trans('user.im_new') }}</a> <br>
                     <a href="{{ url('forget/password') }}"> {{ trans('user.forget_password') }} </a>
                  </div>
               </form>
            </div><!-- End Login Form -->


            <!-- Signup Form -->
            <div class="signup form-peice switched">
               <form class="signup-form" action="{{ url('signup') }}" method="post">
                @csrf
                  <div class="form-group">
                     <label for="name">{{ trans('user.full_name') }}</label>
                     <input type="text" name="name" value="{{ old('name') }}" id="name" class="name">
                     <span class="error">
                     </span>
                  </div>

                  <div class="form-group">
                     <label for="email">{{ trans('user.email_address') }}</label>
                     <input type="email" name="email" value="{{ old('email') }}" id="email" class="email">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="phone_number">{{ trans('user.phone_number') }} - <small>{{ trans('user.optional') }}</small></label>
                     <input type="text" name="phone_number" id="phone" value="{{ old('phone_number') }}">
                  </div>

                  <div class="form-group">
                     <label for="password">{{ trans('user.password') }}</label>
                     <input type="password" name="password" id="password" class="pass">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="passwordCon">{{ trans('user.password_confirm') }}</label>
                     <input type="password" name="passwordCon" id="passwordCon" class="passConfirm">
                     <span class="error"></span>
                  </div>

                  <div class="CTA">
                     <input type="submit" value="{{ trans('user.signup') }}" id="submit">
                     <a href="#" class="switch">{{ trans('user.have_account') }}</a>
                  </div>
               </form>
            </div><!-- End Signup Form -->
         </div>
      </div>

   </section>


   <footer>
      <p>
         Form made by: <a href="http://mohmdhasan.tk" target="_blank">Mohmdhasan.tk</a>
      </p>
   </footer>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ url('design/style') }}/js/login.js"></script>
</body>
</html>