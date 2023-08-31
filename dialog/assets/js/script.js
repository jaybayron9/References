$(function() { 
    var $dialog = $("<div>", { 
        id: "dialog", 
        title: 'My Dialog Title',
        text: "Dialog content goes here." 
    });
    $("body").append($dialog);

    $("#dialog").dialog({
        autoOpen: false,
        modal: true,
        opacity: 0.5,
        zIndex: 9999,
        dialogClass: "my-custom-dialog-class", // add a custom class to the dialog container
        buttons: [
            {
                text: "OK",
                class: "bg-green-500 text-white font-bold hover:font-bold py-2 px-4 rounded hover:bg-green-600",
                click: function() {
                    alert("OK button clicked");
                }
            },
            {
                text: "Cancel",
                class: "bg-red-500 text-white font-bold hover:font-bold py-2 px-4 rounded hover:bg-red-600",
                click: function() {
                    $(this).dialog("close");
                }
            }
        ]
    });

    $(".ui-button").each(function() {
        $(this).addClass($(this).attr("class")); // add any custom classes specified in the buttons object
        $(this).addClass("text-sm"); // add a small text size to all buttons
      }); // add Tailwind CSS classes to the buttons      
    $(".ui-dialog").addClass(" bg-white rounded shadow-lg"); // add Tailwind CSS classes to the dialog container
    $(".ui-dialog-title").addClass("text-sm my-1 font-bold text-gray-800"); // add Tailwind CSS classes to the dialog title

});