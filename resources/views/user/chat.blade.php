@extends('layouts.userdefault')

@section('content')
<main id="main" class="main d-flex justify-content-center align-items-center" 

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card" style="width: 90%; max-width: 1000px;">
        <div class="row no-gutters">
            <div class="col-md-4 border-right">
                <div class="card-body">
                    <h5 class="card-title">Search Contacts</h5>
                    <input type="text" id="search-contact-input" class="form-control" placeholder="Search contacts...">
                    <ul id="contact-list" class="list-group mt-2"></ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">User Chat Room</h5>
                    <div class="card mb-4" id="chat-container" style="height: 400px; overflow-y: auto;">
                        <ul id="messages" class="list-group"></ul>
                    </div>
                    <input type="text" id="message-input" class="form-control" placeholder="Type your message...">
                    <button id="send-btn" class="btn btn-primary mt-2">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    const receiveSound = new Audio('mp3/tom.mp3');
    let lastMessageCount = 0;

    $('#send-btn').click(function () {
        const message = $('#message-input').val();
        if (!message.trim()) return;

        $.ajax({
            url: '/send-message',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                message: message
            },
            success: function (data) {
                appendMessage(data.user, data.message);
                $('#message-input').val('');
                receiveSound.play();
                scrollToBottom();
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });

    function getMessages() {
        $.ajax({
            url: '/get-messages',
            method: 'GET',
            success: function (data) {
                let isAtBottom = isUserAtBottom();

                if (data.length > lastMessageCount) {
                    receiveSound.play();
                }
                lastMessageCount = data.length;

                $('#messages').empty();
                data.forEach(msg => {
                    appendMessage(msg.user.name, msg.message);
                });

                if (isAtBottom) {
                    scrollToBottom();
                }
            }
        });
    }

    function appendMessage(user, message) {
        const currentUser = '{{ auth()->user()->name ?? "admin" }}';
        const isSender = user === currentUser;
        const alignmentClass = isSender ? 'justify-content-end text-right' : 'justify-content-start text-left';
        const bubbleClass = isSender ? 'bg-primary text-white' : 'bg-light';

        const messageElement = $(`
            <li class="d-flex ${alignmentClass} mb-2">
                <div class="p-2 rounded ${bubbleClass}" style="max-width: 75%;">
                    <strong>${user}</strong><br>${message}
                </div>
            </li>
        `);
        $('#messages').append(messageElement);
    }

    function scrollToBottom() {
        const chatContainer = $('#chat-container');
        chatContainer.scrollTop(chatContainer[0].scrollHeight);
    }

    function isUserAtBottom() {
        const chatContainer = $('#chat-container');
        return chatContainer.scrollTop() + chatContainer.innerHeight() >= chatContainer[0].scrollHeight - 10;
    }

    setInterval(getMessages, 3000);

    // Contact search functionality
    $('#search-contact-input').on('input', function () {
        const query = $(this).val();
        $.ajax({
            url: '/search-contacts',
            method: 'GET',
            data: {
                query: query
            },
            success: function (data) {
                $('#contact-list').empty();
                data.forEach(contact => {
                    $('#contact-list').append(`<li class="list-group-item">${contact.name}</li>`);
                });
            }
        });
    });
});
</script>
@endsection
