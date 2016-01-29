<h2 id="modalTitle">Update Package Status</h2>
<form action="updateStatus" id="packageStatusForm" method="POST" novalidate>
	{{ csrf_field() }}
	<select name="status">
		<option value="pending">pending</option>
		<option value="printing">printing</option>
		<option value="payed">payed</option>
		<option value="stopped">stopped</option>
		<option value="sent">sent</option>
	</select> 

	<input type="hidden" name="boughtPackage" id="boughtPackage" value="">
	<input type="submit" value="Update Status" class="tiny button radius">
</form>
<h2>Or Delete Package from Users Account?</h2>
<a href="#" class="tiny button radius warning" data-reveal-id="deletePackageModal">Delete</a>

<div id="deletePackageModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  	<h2>Delete Package from Users Account?</h2>
	<form action="removeUserPackage" id="removeUserPackage" method="POST" novalidate>
		{{ csrf_field() }}

		<input type="hidden" name="deleteBoughtPackage" id="deleteBoughtPackage" value="">
		<input type="submit" value="Delete Order" class="tiny button radius">
	</form>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>


