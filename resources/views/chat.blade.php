<!DOCTYPE html>
<html>
<head>
    <title>AI Chat</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chat-box {
            background: #fff;
            padding: 20px;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .response {
            background: #f1f1f1;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            min-height: 40px;
        }

        form {
            display: flex;
            gap: 10px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 15px;
            border: none;
            background: #007bff;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="chat-box">
    <h2>AI Chat</h2>

    <!-- Response -->
    <div class="response">
        @if(isset($reply))
            {{ $reply }}
        @else
            AI response will appear here...
        @endif
    </div>

    <!-- Form -->
    <form method="POST" action="/chat">
        @csrf
        <input type="text" name="message" placeholder="Type message..." required>
        <button type="submit">Send</button>
    </form>
</div>

</body>
</html>