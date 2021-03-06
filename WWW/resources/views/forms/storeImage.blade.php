<form action="/storeImage" method="POST" enctype="multipart/form-data" novalidate>
	{{ csrf_field() }}

	<div class="row">
		<div class="columns">
			<h2>Upload an Image to the {{$subbrand->name}} page</h2>
		</div>		
  
  	<div class="columns large-6">
      <p>Max file size is 5mb</p>

      <label for="photo"><h2>Image</h2></label>
      <input type="file" name="photo" class="tiny button radius">
      @if($errors->storeImage->first('photo'))
      <span class="alert-box warning">{{$errors->storeImage->first('photo')}}</span>
      @endif
    </div>

    <div class="columns large-6">
      <p>Ideal pixel ratio is 1366x500</p>
      <label for="description"><h2>Image Description</h2></label>
      <input type="text" id="description" name="description" placeholder="Image Description">
      @if($errors->storeImage->first('description'))
      <span class="alert-box warning">{{$errors->storeImage->first('description')}}</span>
      @endif
      @if($errors->storeImage->first('subbrand'))
      <span class="alert-box warning">{{$errors->storeImage->first('subbrand')}}</span>
      @endif
    </div>
  </div>  

  <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
  <input type="hidden" value="{{$subbrand->id}}" name="subbrand">
  <input type="submit" value="Upload a new Image" name="image{{$subbrand->id}}" class="tiny button radius">
</form>
