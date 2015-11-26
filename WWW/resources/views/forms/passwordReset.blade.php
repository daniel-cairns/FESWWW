<form method="POST" action="/password/reset" novalidate>
    {!! csrf_field() !!}
    
    <div>
        Current Password
        <input type="password" name="current_password">
    </div>
    @if($errors->resetPassword->first('current_password'))
        <span class="alert-box warning">{{$errors->first('current_password')}}</span>
    @endif

    <div>
        New Password
        <input type="password" name="new_password">
    </div>
    @if($errors->resetPassword->first('new_password'))
        <span class="alert-box warning">{{$errors->first('new_password')}}</span>
    @endif

    <div>
        Confirm Password
        <input type="password" name="new_password_confirmation">
    </div>
    @if($errors->resetPassword->first('new_password_confirmation'))
        <span class="alert-box warning">{{$errors->first('new_password_confirmation')}}</span>
    @endif

    <div>
        <button type="submit">
            Reset Password
        </button>
    </div>
</form>