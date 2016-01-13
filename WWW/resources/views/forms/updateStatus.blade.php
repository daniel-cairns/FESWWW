<form action="updateStatus" id="packageStatusForm" novalidate>
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