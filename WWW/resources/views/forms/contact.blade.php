<form action="contact" method="POsT" novalidate>
	{{ csrf_field() }}
	<label for="firstname"><h2>Firstname</h2></label>
	<input type="text" id="firstname" name="firstname" value="{{ old('firstname')}}" placeholder="John">
	@if($errors->contact->first('firstname'))
        <span class="alert-box warning">{{$errors->first('firstname')}}</span>
	@endif
	
	<label for="lastname"><h2>Lastname</h2></label>
	<input type="text" id="lastname" name="lastname" value="{{ old('lastname')}}" placeholder="Smith">
	@if($errors->contact->first('lastname'))
        <span class="alert-box warning">{{$errors->first('lastname')}}</span>
	@endif
	
	<label for="email"><h2>Email</h2></label>
	<input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="email@host.com">
	@if($errors->contact->first('email'))
        <span class="alert-box warning">{{$errors->first('email')}}</span>
	@endif		
	
	<label for="phone"><h2>Phone</h2></label>
	<input type="text" id="phone" name="phone" value="{{ old('phone')}}" placeholder="+64">
	@if($errors->contact->first('phone'))
        <span class="alert-box warning">{{$errors->first('phone')}}</span>
	@endif
	
	<label for="comment"><h2>Comments</h2></label>
	<textarea id="comment" name="comment" rows="8" cols="30"></textarea>
	@if($errors->contact->first('clone'))
        <span class="alert-box warning">{{$errors->first('clone')}}</span>
	@endif	
	
	<input type="submit" value="Send" class="tiny button radius">
</form>