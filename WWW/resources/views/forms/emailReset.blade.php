<form action="/email/reset" method="POST" novalidate>
	{{ csrf_field() }}
	
	<div>
		Password
		<input type="password" name="password">
		@if($errors->resetEmail->first('password'))
        <span class="alert-box warning">{{$errors->first('password')}}</span>
    	@endif
	</div>

	<div>
		New Email
		<input type="email" name="email">
		@if($errors->resetEmail->first('email'))
        <span class="alert-box warning">{{$errors->first('email')}}</span>
    	@endif
	</div>

	<div>
		Confirm Email
		<input type="email" name="email_confirmation">
		@if($errors->resetEmail->first('email_confirmation'))
        <span class="alert-box warning">{{$errors->first('email_confirmation')}}</span>
    	@endif
	</div>

	<div>
		<button type="submit" name="changeEmail">
			Change Email
		</button>
	</div>
</form>