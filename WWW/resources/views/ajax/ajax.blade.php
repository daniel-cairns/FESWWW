<div class="row">
	<div class="columns large-6">
		<h2>Users</h2>
			
		<select id="user">
			@foreach( $users as $user)
				<option value="{{$user->id}}" data-user-id="{{ $user->id }}">{{$user->name}}</option>
			@endforeach
		</select>
		
		<ul class="small-block-grid-1" id="userDisplay">
			
		</ul>

		<ul class="small-block-grid-1" id="removeUser">
			<li>
				<form action="userRemove" method="POST" novalidate>
					{{ csrf_field() }}
					<input type="hidden" value="" id="userRemove" name="userId">
					<input type="submit" value="Remove User" class="tiny button radius">
					
					@if( $errors->userRemove)->first('userId'))
						<span class="alert-box warning">{{$errors->userRemove->first('userId')}}</span>
		  			@endif

				</form>
			</li>	
		</ul>

	</div>

	<div class="columns large-6">
		<h2>Upload Users Images</h2>
		<form action="uploadPackage" method="POST" enctype="multipart/form-data" novalidate>
			{{ csrf_field() }}
			<input type="file" name="myFile[]" multiple class="tiny button radius">
			@if($errors->uploadPackage->first('myFile'))
		  	<span class="alert-box warning">{{$errors->uploadPackage->first('myFile[]')}}</span>
		  	@endif
			<input type="hidden" id="userId" value="" name="userId">
			@if($errors->uploadPackage->first('userId'))
		  	<span class="alert-box warning">{{$errors->uploadPackage->first('userId')}}</span>
		  	@endif
			<input type="hidden" id="packageId" value="" name="packageId">
			@if($errors->uploadPackage->first('packageId'))
		  	<span class="alert-box warning">{{$errors->uploadPackage->first('packageId')}}</span>
		  	@endif
			<span id="currentUser"></span>
			<span id="currentPackage"></span>
			<input type="submit" id="upload" class="tiny button radius" name="upload">
		</form>	
	</div>
</div>

<div class="row" data-equalizer>	
	<div class="columns" >
		<ul class="small-block-grid-3" id="packages">
				
		</ul>
		<ul class="small-block-grid-4" id="userImages">
			
		</ul>
	</div>
</div>

