<?php
require('core/functions.php');
require('core/menu.php');

require('views/components/components.php');

require('views/partial/head.php');

?>

<span id="name">Jay</span>

<input type="text" id="price">

<button id="printButton">Print</button>


<script>
$(document).ready(function(){
    var printDialogClosed = false;

$("#printButton").click(function() {
    var name = $("#name").text();
    var price = $("#price").val();
    var pdfUrl = "receipt2.php";
    $.ajax({
        type: "POST",
        url: 'savesession.php',
        data: {
            name: name,
            price: price
        },
        success: function(response) {
            var iframe = "<iframe src='" + pdfUrl + "' style='display: none;' ></iframe>";
            $("body").append(iframe);
            var iframeElement = document.querySelector("iframe");
            iframeElement.contentWindow.print();
            setTimeout(checkPrintDialogClosed, 1000);
        }
    });
});

function checkPrintDialogClosed() {
    if (!printDialogClosed) {
        alert("Please click okay.");
        location.reload();
    }
}

window.onbeforeprint = function() {
    printDialogClosed = false;
}

window.onafterprint = function() {
    printDialogClosed = true;
}


});

</script>

<?php 

require('views/partial/foot.php');