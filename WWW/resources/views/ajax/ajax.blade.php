<div class="columns large-6">
	<select id="user">
		<option selected="selected" >select</option>
		
		@foreach( $users as $user)
			@if( $user->messages )
			<option value="{{$user->id}}" data-user-id="{{ $user->id }}">{{$user->name}}</option>
			@endif
		@endforeach

	</select>

	<form action="">
  		<div id="message"></div>
  		
  	<input type="submit" id="submit" class="tiny button radius">
	</form>
</div>

