var SiGa = {

    showSpinner: function () {
        $('#spanner').show();
    },

    hideSpinner: function () {
        $('#spanner').hide();
    },

    showError: function (reason) {
        var errorMessage = 'ID-card siging error: ',
            errorContainer = $('#errorMessage');

        errorContainer.text('').hide();

        var hwcrypto = window.hwcrypto;
        switch (reason.message) {
            case 'no_backend':
                errorMessage += 'Cannot find ID-card browser extensions';
                break;
            case hwcrypto.USER_CANCEL:
                errorMessage += 'Signing canceled by user';
                break;
            case hwcrypto.INVALID_ARGUMENT:
                errorMessage += 'Invalid argument';
                break;
            case hwcrypto.NO_CERTIFICATES_FOUND:
                errorMessage += ' Failed reading ID-card certificates make sure. ' +
                    'ID-card reader or ID-card is inserted correctly';
                break;
            case hwcrypto.NO_IMPLEMENTATION:
                errorMessage += ' Please install or update ID-card Utility or install missing browser extension. ' +
                    'More information about on id.installer.ee';
                break;
            case hwcrypto.TECHNICAL_ERROR:
            default:
                errorMessage += 'Unknown technical error occurred'
        }

        errorContainer.text(errorMessage).show();
    },

    addIDCardSignature: function () {
        $('#errorMessage').hide();
        self.showSpinner();

        var hwcCertificate = null;
        var cert = null;

        window.hwcrypto.getCertificate({
            lang: 'et'
        }).then(function (certificate) {
            cert = Array.prototype.slice.call(certificate.encoded);
            hwcCertificate = certificate;

            console.log(cert);
			console.log(hwcCertificate);

			$.post('index.php', { action: "prepare_remote_signing", certificate: cert });


        }, function (reason) {
            self.hideSpinner();
            self.showError(reason);
        });

        hideSpinner();
    }
}
