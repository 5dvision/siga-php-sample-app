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
        SiGa.showSpinner();
        $('#errorMessage').hide();

        var hwcCertificate = null;
        var signatureId = null;
        var language = 'en';

        window.hwcrypto.getCertificate({
            lang: language
        }).then(function (certificate) {
            hwcCertificate = certificate;

            const formData = new FormData();

            formData.append('action', 'prepare_signing');
            formData.append('certificateHex', hwcCertificate.hex);

            return axios.post('index.php', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
        }).then(function (response) {
            //console.log(response.data);
            signatureId = response.data.generatedSignatureId;

            var dataToSignHash = new Uint8Array(base64js.toByteArray(response.data.dataToSignHash));

            return window.hwcrypto.sign(hwcCertificate, {
                type: response.data.digestAlgorithm,
                value: dataToSignHash
            }, {
                lang: language
            });
        }).then(function (signature) {
            const formData = new FormData();

            formData.append('action', 'finalize_signing');
            formData.append('signatureId', signatureId);
            formData.append('signatureHex', signature.hex);

            return axios.post('index.php', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
        }).then(function () {
            SiGa.hideSpinner();
            $('#download-signed-file').removeClass('d-none');
        }).catch(function (error) {
            console.log(error);
            SiGa.hideSpinner();
        });
    }
}
