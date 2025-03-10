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

<div class="navbar">
    <div class="navbar-brand">SKINGUARD</div>
    <div class="navbar-links">
        <a href="{{route('main.main')}}" class="nav-link">Home</a>
        <a href="/about" class="nav-link">About</a>
        <a href="/contact" class="nav-link">Contact</a>
        <a class="nav-link" href={{route('doctors.finddoctors')}} >Find Doctors</a>

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
</div>

<style>
    .chat-widget img {
        width  : 50px;  /* تحديد عرض الصورة */
        height  : 50px; /* تحديد ارتفاع الصورة */
        object-fit : contain; /* يضمن أن الصورة لا تفقد تناسبها */
    }
    .chat-widget {
        position : fixed;
        bottom  : 30px;
        right  : 30px;
        width  : 70px; /* Increased width */
        height  : 70px; /* Increased height */
        background-color : #cda678;
        border-radius : 50%; /* Circular shape */
        display : flex;
        justify-content : center;
        align-items : center;
        cursor : pointer;
        box-shadow : 0 4px 12px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
        z-index : 1000;
    }
    .chat-window {
        display : none;
        position : fixed;
        bottom : 100px;
        right : 30px;
        width : 350px; /* Width remains the same */
        height : 500px; /* Set minimum height */
        max-height : 700px; /* Set maximum height */
        background : white;
        border-radius : 15px; /* Rounder corners */
        box-shadow : 0 4px 12px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
        overflow : hidden;
        flex-direction : column;
    }
    .chat-header {
        background : #cda678;
        color : white;
        padding : 15px; /* Increased padding */
        text-align : center;
        font-weight : bold;
        border-top-left-radius : 15px; /* Match window border radius */
        border-top-right-radius : 15px; /* Match window border radius */
    }
    .chat-body {
        padding : 10px;
        overflow-y : auto;
        flex-grow : 1;
        height : 100%;
        border-bottom : 1px solid #ccc;
    }
    .options-container {
        margin-top : 15px;
        padding : 10px;
        background : #ffffff; /* Clean white background */
        border-radius : 10px; /* Smooth rounded corners */
        box-shadow : 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        border : 1px solid #e0e0e0; /* Light gray border for structure */
        display : flex;
        flex-direction : column; /* Stack elements vertically */
        align-items : center; /* Center elements horizontally */
        gap : 15px; /* Space between elements */
        width : 100%; /* Full width for better alignment */
    }
   
    .message {
        margin : 8px 0;
        padding : 10px; /* Increased padding for messages */
        border-radius : 20px; /* Changed shape of messages */
    }
    .user-message {
        background-color : #beccae;
        text-align : right;
        border-top-right-radius : 0; /* Adjusted corners */
    }
    .bot-message {
        background-color : #f7f4d9;
        text-align : left;
        border-top-left-radius : 0;
    }
    .option-message {
        background-color : #f0f0f0;
        text-align : left;
        border-radius : 8px;
        cursor : pointer;
        margin : 5px 0;
    }
    .option-message :hover {
        background-color : #e0e0e0;
    }
</style>

<script>
    const chatWidget = document.getElementById('chat-widget');
    const chatWindow = document.getElementById('chat-window');
    const chatBody = document.getElementById('chat-body');
    const optionsContainer = document.getElementById('options-container');

    const questions = [
        { text : "Have you ever experienced persistent itching or irritation on your skin?", options : ["Yes", "No", "Occasionally", "Not Sure"] },
        { text : "Have you noticed any unusual moles, discoloration, or skin patches recently?", options : ["Yes, dark patches", "Yes, red spots", "Yes, other changes", "No changes"] },
        { text : "Do you have a history of eczema, psoriasis, or other skin conditions?", options : ["Yes, eczema", "Yes, psoriasis", "Other conditions", "No"] },
        { text : "How often do you experience dryness or flaking of your skin?", options : ["Always", "Sometimes", "Rarely", "Never"] },
        { text : "Do you experience sudden skin rashes or allergic reactions?", options : ["Frequently", "Occasionally", "Rarely", "Never"] },
        { text : "How often do you apply sunscreen when going outside?", options : ["Always", "Sometimes", "Rarely", "Never"] },
        { text : "Do you have any family history of skin diseases?", options : ["Yes", "No", "Not Sure", "Prefer not to say"] },
        { text : "Have you recently used any new skincare products that caused a reaction?", options : ["Yes", "No", "Not Sure", "I don't use skincare products"] },
        { text : "Do you experience excessive oiliness or acne on your skin?", options : ["Yes, frequently", "Sometimes", "Rarely", "Never"] },
        { text : "Have you consulted a dermatologist regarding skin concerns in the past year?", options : ["Yes", "No", "Thinking about it", "Not necessary"] },
        { text : "What steps do you take to protect your skin?", options : ["Use sunscreen", "Stay hydrated", "Follow a skincare routine", "None of the above"] }
    ];

    let questionIndex = 0;

    chatWidget.addEventListener('click', () => {
        chatWindow.style.display = chatWindow.style.display === 'none' ? 'flex'  : 'none';
        if (chatWindow.style.display === 'flex') {
            askQuestion();
        }
    });

    function appendMessage(text, className) {
        const message = document.createElement('div');
        message.classList.add('message', className);
        message.textContent = text;
        chatBody.appendChild(message);
        chatBody.scrollTop = chatBody.scrollHeight; // Scroll to the bottom
    }

    function askQuestion() {
        optionsContainer.innerHTML = ""; // Clear previous options
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
</script>

@endsection