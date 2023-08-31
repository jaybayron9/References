<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="echo.php" method="POST">
            <div class="forms" id="Form1">
                <h3>Appointment Type</h3>
                <input type="text" name="new" placeholder="New Patient">
                <input type="text" name="return" placeholder="Return Patient">

                <div class="btn-box">
                    <button type="button" id="Next1">Next</button>
                </div>
            </div>

            <div class="forms" id="Form2">
                <h3>Date and time</h3>
                <input type="text" name="date" placeholder="date">
                <input type="text" name="time" placeholder="time">

                <div class="btn-box">
                    <button type="button" id="Back1">Back</button>
                    <button type="button" id="Next2">Next</button>
                </div>
            </div>

            <div class="forms" id="Form3">
                <h3>Personal info & Contact</h3>
                <input type="text" name="fname" placeholder="first name">
                <input type="text" name="lname" placeholder="last name">

                <div class="btn-box">
                    <button type="button" id="Back2">Back</button>
                    <button type="submit" name="submit">Submit</button>
                </div>
            </div>

            <div class="step-row">
                <div id="progress"></div>
                    <div class="step-col"><small>Step 1</small></div>
                    <div class="step-col"><small>Step 2</small></div>
                    <div class="step-col"><small>Step 3</small></div>
            </div>
        </form> 
    </div>
    
    <script src="script.js"></script>
</body>
</html>