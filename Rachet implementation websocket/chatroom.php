<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between px-6 py-4 border-b"> 
                <select name="from_user" id="from_user">
                    <option value="" selected>Sino ka?</option>
                    <?php for ($i = 1; $i < 3; $i++) {
                        echo "<option value='$i'>From $i</option>";
                    } ?>
                </select> 
                <select name="send_to" id="send_to">
                    <option value="" selected>Di ako sino-ka.</option>
                    <?php for ($i = 1; $i < 3; $i++) {
                        echo "<option value='$i'>To $i</option>";
                    } ?>
                </select>
            </div>
            <div class="px-6 py-4" id="chat-messages">
                <!-- Chat here -->
            </div>
            <div class="flex items-center justify-between px-6 py-4 border-t">
                <input id="message-input" type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-indigo-300 mr-2" placeholder="Type your message...">
                <button id="send-btn" class="px-4 py-2 text-white bg-indigo-500 rounded hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Send</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var conn = new WebSocket('ws://localhost:8080'); 

        $('#from_user, #send_to').on('input change', function() { 
            var from_user = $('#from_user').val();
            var send_to = $('#send_to').val();

            $.ajax({
                url: 'old-chat.php',
                type: 'POST',
                data: {
                    from_user: from_user,
                    send_to: send_to
                },  
                success: function(resp) {
                    $('#chat-messages').html(resp); 
                }
            });
        });

        conn.onmessage = function(e) { 
            var data = JSON.parse(e.data); 

            console.log(e.data);
            if (data.send_to == $('#from_user').val()) {
                var msg = '<div class="block text-left"><span class="bg-blue-600 px-2 text-white font-ligh rounded-full text-lg">'+ data.message +'</span></div>'; 
                $('#chat-messages').append(msg);
            }
        };

        $('#message-input').keydown(function(e) {
            if (e.key === 'Enter') {
                var from_user = $('#from_user').val();
                var send_to = $('#send_to').val();
                var message = $(this).val()

                var data = {
                    from_user: from_user,
                    send_to: send_to,
                    message: message,
                }

                conn.send(JSON.stringify(data));

                $('#message-input').val('');
                var sended = '<div class="block text-right"><span class="bg-blue-600 px-2 text-white font-ligh rounded-full text-lg">'+ message +'</span></div>';
                $('#chat-messages').append(sended);
            }
        });
    </script>
</body>

</html>