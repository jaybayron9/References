<?php
$conn = new mysqli('localhost', 'root', '', 'rev');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <span id="alert"></span>
    <table style="margin-bottom: 50px;">
        <thead>
            <tr>
                <th><input id="checkAll" type="checkbox" class="checkItem"></th>
                <th>Fname</th>
                <th>lname</th>
                <th>Status</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <form id="edit-form" action="" method="POST">
        <input type="hidden" id="id" name="id">
        <label for="first name">First name</label>
        <input type="text" name="fname" id="fname">
        <label for="last name">Last name</label>
        <input type="text" name="lname" id="lname">
        <br>
        <button type="submit">Submit</button>
        <input type="reset" value="Clear">
    </form>

    <script>
        $(document).ready(function() {
            // update the table rows
            var intervalId;

            function startAjax() {
                intervalId = setInterval(function() {
                    $.ajax({
                        url: 'get-data.php',
                        type: 'POST',
                        dataType: 'json',
                        success: function(data) {
                            $('tbody').html(''); // clear the table rows
                            $.each(data, function(i, item) {
                                // create a new row with the updated data
                                var row = '<tr>';
                                row += '<td>' + '<input name="user_id[]" class="checkItem" type="checkbox" ' + 'value="' + item.user_id + '">' + '</td>'
                                row += '<td>' + item.fname + '</td>';
                                row += '<td>' + item.lname + '</td>';
                                row += '<td>' + item.status + '</td>';
                                row += '<td><a href="#" class="user-id" data-row-data="' + item.user_id + '">Edit</a></td>';
                                row += '</tr>';
                                $('tbody').append(row);

                                $('.checkItem').click(function() {
                                    stopAjax();
                                });

                                $('.user-id').click(function() {
                                    stopAjax();
                                });

                                $('.user-id').click(function() {
                                    $.ajax({
                                        url: 'display.php',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: {
                                            rowData: $(this).data('row-data')
                                        },
                                        success: function(data) {
                                            $('#fname').val(data.fname);
                                            $('#lname').val(data.lname);
                                            $('#id').val(data.user_id);
                                        },
                                        error: function(xhr, status, error) {
                                            console.log(error);
                                        }
                                    });
                                });
                            });
                        }
                    });
                }, 1000);
            }

            function stopAjax() {
                clearInterval(intervalId);
            }

            $('table').click(function() {
                stopAjax();
            });

            $('#edit-form').submit(function(e) {
                $('#alert').hide();
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    data: new FormData($(this)[0]),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    url: 'update.php',
                    success: function(data) {
                        startAjax();
                        $("#checkAll").prop('checked', false);
                        $('#alert').html(data.msg);
                        $('#alert').fadeIn(2000);
                        $('#alert').fadeOut(2000);
                    }
                });
            });

            $("#checkAll").click(function() {
                if ($(this).is(":checked")) {
                    $(".checkItem").prop('checked', true);
                    stopAjax();
                } else {
                    $(".checkItem").prop('checked', false);
                    stopAjax();
                }
            });

            $('#checkAll').click(function() {
                if (this.checked) {
                    stopAjax();
                } else {
                    startAjax();
                }
            });

            startAjax();
        });
    </script>
</body>

</html>