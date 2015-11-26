<form method="POST" action="/username/reset" novalidate>
    {!! csrf_field() !!}
    
    <div>
        Password
        <input type="password" name="password">
    </div>
    @if($errors->resetUsername->first('password'))
        <span class="alert-box warning">{{$errors->resetUsername->first('password')}}</span>
    @endif

    <div>
        New Username
        <input type="text" name="new_username">
    </div>
    @if($errors->resetUsername->first('new_username'))
        <span class="alert-box warning">{{$errors->resetUsername->first('new_username')}}</span>
    @endif

    <div>
        <button type="submit">
            Change Username
        </button>
    </div>
</form>