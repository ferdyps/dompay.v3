function ocr_get() {
    //Prepare form data
    var formData = new FormData();
    formData.append("url", "https://ib.bri.co.id/ib-bri/login/captcha");
    formData.append("language"   , "eng");
    formData.append("apikey"  , "773631c37488957");
    formData.append("isOverlayRequired", true);
    //Send OCR Parsing request asynchronously
    jQuery.ajax({
        url: "https://api.ocr.space/parse/image",
        data: formData,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function (ocrParsedResult) {
            console.log(ocrParsedResult);
            // //Get the parsed results, exit code and error message and details
            // var parsedResults = ocrParsedResult["ParsedResults"];
            // var ocrExitCode = ocrParsedResult["OCRExitCode"];
            // var isErroredOnProcessing = ocrParsedResult["IsErroredOnProcessing"];
            // var errorMessage = ocrParsedResult["ErrorMessage"];
            // var errorDetails = ocrParsedResult["ErrorDetails"];
            // var processingTimeInMilliseconds = ocrParsedResult["ProcessingTimeInMilliseconds"];
            // //If we have got parsed results, then loop over the results to do something
            // if (parsedResults!= null) {
            //     //Loop through the parsed results
            //     $.each(parsedResults, function (index, value) {
            //         var exitCode = value["FileParseExitCode"];
            //         var parsedText = value["ParsedText"];
            //         var errorMessage = value["ParsedTextFileName"];
            //         var errorDetails = value["ErrorDetails"];

            //         var textOverlay = value["TextOverlay"];
            //         var pageText = '';
            //         switch (+exitCode) {
            //             case 1:
            //                 pageText = parsedText;
            //                 break;
            //             case 0:
            //             case -10:
            //             case -20:
            //             case -30:
            //             case -99:
            //             default:
            //                 pageText += "Error: " + errorMessage;
            //                 break;
            //         }

            //         console.log(pageText);

            //         $.each(textOverlay["Lines"], function (index, value) {
            //             console.log(value + " | " + index)
            //         });
            //     });
            // }
        }
    });
}