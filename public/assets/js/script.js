

'use strict';

(function () {

    /**
         * Adding International code to phone numbers
         */
    function attachIntlCode(input, hiddenField, errorMsg, validMsg) {

        // here, the index maps to the error code returned from getValidationError - see readme
        let errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        // initialize plugin
        let iti = window.intlTelInput(input, {
            initialCountry: "ae",
            separateDialCode: true,
            utilsScript: "../vendor/build/js/utils.js"
        });

        let reset = function () {
            input.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
        };

        // on blur: validate
        input.addEventListener('blur', function () {
            reset();
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                    validMsg.classList.remove("hide");
                    hiddenField.value = iti.getSelectedCountryData().dialCode;
                } else {
                    input.classList.add("error");
                    let errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");
                }
            }
        });

        // on keyup / change flag: reset
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);
    }

    document.addEventListener("DOMContentLoaded", function () {

        attachIntlCode(
            document.querySelector("#phone"),
            document.querySelector('#phoneCode'),
            document.querySelector("#error-msg-phone"),
            document.querySelector("#valid-msg-phone")
        );

        attachIntlCode(
            document.querySelector("#referencePhone"),
            document.querySelector('#referencePhoneCode'),
            document.querySelector("#error-msg-refer"),
            document.querySelector("#valid-msg-refer")
        );

    });

    document.addEventListener("DOMContentLoaded", function () {
        attachIntlCode(
            document.querySelector("#memberPhone"),
            document.querySelector('#memberPhoneCode'),
            document.querySelector("#error-msg-memberPhone"),
            document.querySelector("#valid-msg-memberPhone")
        );
    });

    /**
     * file Upload
     */
    let files = document.querySelector(".files");
    let inputFile = document.querySelector('input[type="file"]');

    files.setAttribute('data-before', "Drag file here or click the above button");
    console.log(files.getAttribute('data-before'));

    inputFile.addEventListener("change", function (e) {
        let fileName = e.target.files[0].name;
        files.setAttribute('data-before', fileName);
    });


})();



