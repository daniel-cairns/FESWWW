<form action="storeImage" method="POST" enctype="multipart/form-data" novalidate>
	{{ csrf_field() }}

	<div class="row">
		<div class="columns">
			<h2>Upload an Image to the {{$subbrand->name}} page</h2>
		</div>		
  
  	<div class="columns large-6">
      <label for="photo"><h2>Image</h2></label>
      <input type="file" name="photo" class="tiny button radius">
      @if(count($errors) > 0)
      <span class="alert-box warning">{{$errors->first('photo')}}</span>
      @endif
    </div>

    <div class="columns large-6">
      <label for="description"><h2>Image Description</h2></label>
      <input type="text" id="description" name="description" placeholder="Image Description">
      @if(count($errors) > 0)
      <span class="alert-box warning">{{$errors->first('description')}}</span>
      @endif
    </div>
  </div>  

<input type="hidden" name="MAX_FILE_SIZE" value="5000000">
<input type="hidden" value="{{$subbrand->id}}" name="subbrand">
<input type="submit" value="Upload a new Image" name="image{{$subbrand->id}}" class="tiny button radius">
</form>
