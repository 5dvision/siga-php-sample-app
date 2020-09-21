
<div class="row">
	<div class="col">
		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="create_new_doc"/>
			<div class="card">
				<h5 class="card-header">Upload file to sign</h5>
				<div class="card-body">
					<div class="form-group">
						<input type="file" name="datafile" class="form-control-file">
					</div>
					<div class="form-group">
						<label for="conversionType">Choose container conversion type</label>
						<select class="form-control" name="containerType" id="containerType">
							<option value="HASHCODE">HASHCODE</option>
							<option value="ASIC" disabled>ASIC</option>
						</select>
					</div>	
				</div>
				<div class="card-footer">
						<button type="submit" class="btn btn-primary">Upload file to sign</button>
				</div>
			</div>
		</form>
	</div>
</div>