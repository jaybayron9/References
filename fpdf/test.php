<?php
require('core/functions.php');
require('core/menu.php');

require('views/components/components.php');

require('views/partial/head.php');

?>

<button id="printButton" class="p-10 font-bold bg-red-400 text-gray-200">Print</button>


<script>
$(document).ready(function(){
    $("#printButton").click(function() {
        var pdfUrl = "receipt.php";
        var iframe = "<iframe src='" + pdfUrl + "' style='display: none;' ></iframe>";
        $("body").append(iframe);
        var iframeElement = document.querySelector("iframe");
        iframeElement.contentWindow.print();
    });
    // $(iframeElement).remove();
});

// Auto print
// $(document).ready(function(){
//     $("#printButton").click(function() {
//         var pdfUrl = "receipt.php";
//         var iframe = "<iframe src='" + pdfUrl + "' style='display: none;' onload='this.contentWindow.print();' ></iframe>";
//         $("body").append(iframe);
//     });
// });
</script>

<?php 

require('views/partial/foot.php');