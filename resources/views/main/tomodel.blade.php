@extends('layout')
@section('title')
    Upload Image - Model
@endsection

@section('content')

<link rel="stylesheet" href="{{ url('css/uppform.css') }}">

@if ($errors->any())
    <div class="background-shadow" id="backgroundShadow"></div>
    <div class="alert alert-danger" id="errorAlert">
        <span class="close" onclick="closeAlert()">&times;</span>
        <strong>Error!</strong>
        <p>Please fix the following issues :</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script>
function closeAlert() {
    document.getElementById('errorAlert').style.display = 'none'; 
    document.getElementById('backgroundShadow').style.display = 'none'; 
}
</script>

<div class="navbar" id="navbar">
    <div class="navbar-brand" id="navbar-brand">SKINGUARD</div>
    <div class="navbar-links" style="display: flex;align-items: center;">
        <a href="{{route('main.main')}}" class="nav-link" id="nav-link">Home</a>
        <a href="/about" class="nav-link" id="nav-link">About</a>
        <a href="/contact" class="nav-link" id="nav-link">Contact</a>
        <a class="nav-link" href={{route('doctors.finddoctors')}} id="nav-link" >Find Doctors</a>

    </div>
</div>

<div class="upload-container">
    <h1>Upload Image</h1>

    <div class="instructions">
        <p>Please select an image file to upload. Accepted formats : JPG, PNG, GIF. Maximum file size : 2MB.</p>
    </div>

    <form action="{{ route('main.uploadimage') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
        @csrf
        <div class="form-group">
            <label for="image">Select Image</label>
            <input type="file" name="img" id="image" class="form-control" required accept=".jpg, .jpeg, .png, .gif">
        </div>
        <div class="image-preview" id="imagePreview" style="display : none;">
            <h3>Image Preview :</h3>
            <img id="previewImg" src="" alt="Image Preview" style="max-width  : 300px; margin-top  : 10px; border : 1px solid #ccc; border-radius : 5px;">
        </div>
        <button type="submit" class="submit-button">Upload</button>
    </form>
</div>
</script>
@if(session('image'))
    <div class="classification-result">
        <!---<p><strong>Condition:</strong> {{ session('image')->classification }}</p>--->
        <p><strong>{{ session('image')->classification }} ({{ session('classification_ar') }})</strong></p>
    </div>
@endif
<style>
    .classification-result>p {
        display: flex;
        font-size: 2rem;
        justify-content: center;
        align-items: center;
        margin-top: 30px;
        padding: 30px;
    }

</style>
<script>
    const fileInput = document.getElementById('image');
    const previewImg = document.getElementById('previewImg');
    const imagePreviewContainer = document.getElementById('imagePreview');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                previewImg.setAttribute('src', event.target.result);
                imagePreviewContainer.style.display = 'block'; 
            }
            reader.readAsDataURL(file);
        } else {
            imagePreviewContainer.style.display = 'none'; 
        }
    });
</script>




<!-- Chat Widget Code -->
<div class="chat-widget" id="chat-widget">
    <img src="{{ asset('speech-bubbles.png') }}" alt="Chat Icon">
</div>

<div class="chat-window" id="chat-window">
    <div class="chat-header">Chatbot</div>
    <div class="chat-body" id="chat-body"></div>
    <div id="options-container" class="options-container"></div>
    
    <!-- User Input Field & Send Button -->
    <div class="chat-input">
        <input type="text" id="user-message" placeholder="Type a message..." />
        <button id="send-message">Send</button>
    </div>
</div>

<style>
    
    .chat-widget img {
        width: 50px;
        height: 50px;
        object-fit: contain;
    }
    .chat-widget {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 70px;
        height: 70px;
        background-color: #cda678;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        z-index: 1000;
    }
    .chat-window {
        display: none;
        position: fixed;
        bottom: 100px;
        right: 30px;
        width: 350px;
        height: 500px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        flex-direction: column;
    }
    .chat-header {
        background: #cda678;
        color: white;
        padding: 15px;
        text-align: center;
        font-weight: bold;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .chat-body {
        padding: 10px;
        overflow-y: auto;
        flex-grow: 1;
        height: 100%;
        border-bottom: 1px solid #ccc;
    }
    .options-container {
        margin-top: 15px;
        padding: 10px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #e0e0e0;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        width: 100%;
    }
    .chat-input {
        display: flex;
        padding: 10px;
        border-top: 1px solid #ccc;
        background: white;
    }
    .chat-input input {
        flex-grow: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .chat-input button {
        background: #cda678;
        color: white;
        border: none;
        padding: 10px 15px;
        margin-left: 10px;
        border-radius: 5px;
        cursor: pointer;
    }
    .message {
        margin: 8px 0;
        padding: 10px;
        border-radius: 20px;
    }
    .user-message {
        background-color: #beccae;
        text-align: right;
        border-top-right-radius: 0;
    }
    .bot-message {
        background-color: #f7f4d9;
        text-align: left;
        border-top-left-radius: 0;
    }
    .option-message {
        background-color: #f0f0f0;
        text-align: left;
        border-radius: 8px;
        cursor: pointer;
        margin: 5px 0;
    }
    .option-message:hover {
        background-color: #e0e0e0;
    }
</style>

<script>
    const chatWidget = document.getElementById('chat-widget');
    const chatWindow = document.getElementById('chat-window');
    const chatBody = document.getElementById('chat-body');
    const optionsContainer = document.getElementById('options-container');
    const userMessageInput = document.getElementById('user-message');
    const sendMessageButton = document.getElementById('send-message');

    const questions = [
        { text: "Have you ever experienced persistent itching or irritation on your skin?", options: ["Yes", "No", "Occasionally", "Not Sure"] },
        { text: "Have you noticed any unusual moles, discoloration, or skin patches recently?", options: ["Yes, dark patches", "Yes, red spots", "Yes, other changes", "No changes"] },
        { text: "Do you have a history of eczema, psoriasis, or other skin conditions?", options: ["Yes, eczema", "Yes, psoriasis", "Other conditions", "No"] }
    ];

    let questionIndex = 0;

    chatWidget.addEventListener('click', () => {
        chatWindow.style.display = chatWindow.style.display === 'none' ? 'flex' : 'none';
        if (chatWindow.style.display === 'flex') {
            askQuestion();
        }
    });

    function appendMessage(text, className) {
        const message = document.createElement('div');
        message.classList.add('message', className);
        message.textContent = text;
        chatBody.appendChild(message);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function askQuestion() {
        optionsContainer.innerHTML = "";
        if (questionIndex < questions.length) {
            const question = questions[questionIndex];
            appendMessage(question.text, 'bot-message');

            question.options.forEach(option => {
                const optionMessage = document.createElement('div');
                optionMessage.classList.add('message', 'option-message');
                optionMessage.textContent = option;
                optionMessage.addEventListener('click', () => {
                    appendMessage(option, 'user-message');
                    questionIndex++;
                    askQuestion();
                });
                chatBody.appendChild(optionMessage);
            });
        } else {
            appendMessage("Thank you for your responses!", 'bot-message');
        }
    }

    // Send User Message to Laravel Chat API
    function sendMessage() {
        const message = userMessageInput.value.trim();
        if (message === '') return;

        appendMessage(message, 'user-message');
        userMessageInput.value = '';

        fetch('/chat', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content 
            },
            body: JSON.stringify({ message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.response) {
                appendMessage(data.response, 'bot-message');
            } else {
                appendMessage("Error: No response from chatbot.", 'bot-message');
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            appendMessage("Error connecting to the chatbot.", 'bot-message');
        });
    }

    // Attach event listener to button
    sendMessageButton.addEventListener('click', sendMessage);

    // Allow sending messages with Enter key
    userMessageInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
</script>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
