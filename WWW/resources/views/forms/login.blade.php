<form action="/auth/login" method="post" novalidate>
  {{csrf_field()}}

  <div>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="email@photos.com" value="{{ old('email') }}">
    {{ $errors->first('email')}}
  </div>
  <div>
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    {{ $errors->first('password')}}
  </div>
  <input type="submit" value="Login" class="tiny button">
</form>