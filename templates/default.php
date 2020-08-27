<div class="container">
	<div class="row">
		<div class="col">
			<form method="post" enctype="multipart/form-data">
				<input type="hidden" name="act" value="create_new_doc"/>
				<div class="card">
					<h5 class="card-header">Upload file to sign</h5>
					<div class="card-body">
							<div class="form-group">
								<input type="file" name="datafile" class="form-control-file">
							</div>
							<div class="form-group">
								<label for="containerType">Choose format</label>
								<select class="form-control" id="containerType">
									<option value="BDOC 2.1">BDOC 2.1(ASiC-E)</option>
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
</div>