<!DOCTYPE html>
<html>
<head>
    <title>Date Range Search in Datatables using PHP</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="container">
        <h1>Date Range Search in Datatables using PHP</h1>
        <form>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" class="form-control">
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" class="form-control">
            </div>
            <button type="button" id="search_button" class="btn btn-primary">Search</button>
            <button type="button" id="clear_button" class="btn btn-secondary">Clear</button>
        </form>
        <br>
        <table id="my_table" class="display">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Column 2</th>
                    <th>Column 3</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Example PHP code to dynamically populate the table rows
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<tr>";
                        echo "<td>" . date('Y-m-d', strtotime('-' . $i . ' days')) . "</td>";
                        echo "<td>Row " . $i . ", Column 2</td>";
                        echo "<td>Row " . $i . ", Column 3</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#my_table').DataTable({
                columns: [
                    { title: 'Date' },
                    { title: 'Column 2' },
                    { title: 'Column 3' }
                ]
            });

            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var minDate = $('#start_date').val();
                    var maxDate = $('#end_date').val();
                    var date = data[0]; // assuming the date is in the first column
                    if (minDate === '' || maxDate === '') {
                        return true;
                    }
                    if (date >= minDate && date <= maxDate) {
                        return true;
                    }
                    return false;
                }
            );

            $('#search_button').on('click', function() {
                table.draw();
            });

            $('#clear_button').on('click', function() {
                $('#start_date').val('');
                $('#end_date').val('');
                table.draw();
            });
        });
    </script>
</body>
</html>
