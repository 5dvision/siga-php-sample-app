<div class="modal fade" id="mobileSignModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" id="mobileSignModalHeader">
				<h5 class="modal-title" id="exampleModalLabel">Sign the document with Mobile ID</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
            </div>
            <div class="modal-body">
                <div class="mobileSignModalContent">
					<div id="mobileSignErrorContainer" style="display: none;" class="alert alert-danger"></div>

					<div id="phoneAsking">
						<p class="text-muted"><i><a href="https://github.com/SK-EID/MID/wiki/Test-number-for-automated-testing-in-DEMO" target="_blank">Testing mobile numbers</a></i></p>
						<label for="mid_phone mt-1">Phone number</label>
						<div class="input-group mb-1">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z"/>
									</svg>
								</span>
							</div>
							<input type="text" class="form-control" id="mid_phone" value="+37200000566" placeholder="Phone number">
						</div>

						<label for="mid_idCode">Personal code</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">EE</span>
							</div>
							<input type="text" class="form-control" id="mid_idCode" value="60001018800" placeholder="Personal code">
						</div>
					</div>
					<div id="showChallange" style="display:none;">
						<div class="alert alert-info">Make sure control code matches with one in the phone screen and enter Mobile-ID PIN2.</div>
						<h4 class="text-center">
							<div class="spinner-grow text-secondary" role="status">
								<span class="sr-only">Loading...</span>
							</div>
							Control code:
						</h4>
						<p class="display-4 text-center"><span class="badge badge-success" id="challangeId"></span></p>
					</div>
					
                </div>
            </div>
            <div class="modal-footer" id="mobileSignModalFooter">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="SiGa.startMobileIdSign();">
                    Start signing process
                </button>
            </div>
        </div>
    </div>
</div>