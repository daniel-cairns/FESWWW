<div class="row">
	<div class="columns large-6">
		<h2>Users</h2>
			
		<select id="user">
			<option selected="selected">select</option>
			@foreach( $users as $user)
				<option value="{{$user->id}}" data-user-id="{{ $user->id }}">{{$user->name}}</option>
			@endforeach
		</select>
		
		<ul class="small-block-grid-1" id="userDisplay">
			
		</ul>
	</div>

	<div class="columns large-6">
		<h2>Upload Users Images</h2>
		<form action="uploadPackage" method="POST" enctype="multipart/form-data" novalidate>
			{{ csrf_field() }}
			<input type="file" name="myFile[]" multiple class="tiny button radius">
			<input type="hidden" id="userId" value="" name="userId">
			<input type="hidden" id="packageId" value="" name="packageId">
			<span id="currentUser"></span>
			<span id="currentPackage"></span>
			@if($errors->uploadPackage->first())
		  <span class="alert-box warning">{{$errors->uploadPackage->first()}}</span>
		  @endif
			<input type="submit" id="upload" class="tiny button radius" name="upload">
		</form>	
	</div>
</div>

<div class="row" data-equalizer>	
	<div class="columns" >
		<ul class="small-block-grid-3" id="packages">
				
		</ul>
	</div>
</div>

