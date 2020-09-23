<div class="row">
	<div class="col">
		<div class="card">
			<h5 class="card-header">Sign the document</h5>
			<div class="card-body p-0">
				<table class="table table-striped table-borderless">
					<thead>
						<tr>
							<th>Name</th>
							<th>Mime</th>
							<th>Size</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($files as $file): ?>
							<tr>
								<td><?=$file['name']?></td>
								<td><?=$file['mime']?></td>
								<td><?=human_filesize($file['size'])?></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
			<div class="card-footer bg-white">
				<button type="button" class="btn btn-sign bg-light border" onclick="SiGa.addIDCardSignature();">
					<img src="assets/img/eid_idkaart_mark.svg" />
				</button>
				<button type="button" class="btn btn-sign bg-light border">
					<img src="assets/img/eid_mobiilid_mark.svg" />
				</button>

				<a href="index.php?action=download_container" target="_blank" id="download-signed-file" class="btn btn-primary float-right d-none">Download Signed File</a>
			</div>
		</div>
	</div>
</div>