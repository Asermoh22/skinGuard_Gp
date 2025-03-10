@extends('layout')

@section('title')
    Upload Image
@endsection

@section('content')

<link rel="stylesheet" href="{{ url('css/upform.css') }}">

@if ($errors->any())
    <div class="background-shadow" id="backgroundShadow"></div>
    <div class="alert alert-danger" id="errorAlert">
        <span class="close" onclick="closeAlert()">&times;</span>
        <strong>Error!</strong>
        <p>Please fix the following issues:</p>
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
    </div>
</div>

<div class="upload-container">
    <h1>Upload Image</h1>

    <div class="instructions">
        <p>Please select an image file to upload. Accepted formats: JPG, PNG, GIF. Maximum file size: 2MB.</p>
    </div>

    <form action="{{ route('main.uploadimage') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
        @csrf
        <div class="form-group">
            <label for="image">Select Image</label>
            <input type="file" name="img" id="image" class="form-control" required accept=".jpg, .jpeg, .png, .gif">
        </div>
        <div class="image-preview"></div>
        <button type="submit" class="submit-button">Upload</button>
    </form>
</div>

<!-- Chat Widget Code -->
<div class="chat-widget" id="chat-widget">
    <img src="https://img.icons8.com/ios-filled/50/ffffff/chat.png" alt="Chat Icon">
</div>

<div class="chat-window" id="chat-window">
    <div class="chat-header">Chat with Us</div>
    <div class="chat-body" id="chat-body"></div>
    <div id="options-container" class="options-container"></div>
</div>

<style>
    .chat-widget {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        background-color: #cda678;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }
    .chat-window {
        display: none;
        position: fixed;
        bottom: 100px;
        right: 30px;
        width: 300px;
        max-height: 400px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        flex-direction: column;
    }
    .chat-header {
        background: #cda678;
        color: white;
        padding: 10px;
        text-align: center;
        font-weight: bold;
    }
    .chat-body {
        padding: 10px;
        overflow-y: auto;
        flex-grow: 1;
        max-height: 300px;
        border-bottom: 1px solid #ccc;
    }
    .options-container {
        margin-top: 10px;
        padding: 10px;
    }
    button {
        background-color: #cda678;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px;
        cursor: pointer;
        width: 100%;
    }
    button:hover {
        background-color: #caa06f;
    }
    .message {
        margin: 5px 0;
        padding: 5px;
        border-radius: 5px;
    }
    .user-message {
        background-color: #e2f0d9;
        text-align: right;
    }
    .bot-message {
        background-color: #d9edf7;
        text-align: left;
    }
</style>

<script>
    const chatWidget = document.getElementById('chat-widget');
    const chatWindow = document.getElementById('chat-window');
    const chatBody = document.getElementById('chat-body');
    const optionsContainer = document.getElementById('options-container');

    const questions = [
    { text: "Have you ever experienced persistent itching or irritation on your skin?", options: ["Yes", "No", "Occasionally", "Not Sure"] },
    { text: "Have you noticed any unusual moles, discoloration, or skin patches recently?", options: ["Yes, dark patches", "Yes, red spots", "Yes, other changes", "No changes"] },
    { text: "Do you have a history of eczema, psoriasis, or other skin conditions?", options: ["Yes, eczema", "Yes, psoriasis", "Other conditions", "No"] },
    { text: "How often do you experience dryness or flaking of your skin?", options: ["Always", "Sometimes", "Rarely", "Never"] },
    { text: "Do you experience sudden skin rashes or allergic reactions?", options: ["Frequently", "Occasionally", "Rarely", "Never"] },
    { text: "How often do you apply sunscreen when going outside?", options: ["Always", "Sometimes", "Rarely", "Never"] },
    { text: "Do you have any family history of skin diseases?", options: ["Yes", "No", "Not Sure", "Prefer not to say"] },
    { text: "Have you recently used any new skincare products that caused a reaction?", options: ["Yes", "No", "Not Sure", "I don't use skincare products"] },
    { text: "Do you experience excessive oiliness or acne on your skin?", options: ["Yes, frequently", "Sometimes", "Rarely", "Never"] },
    { text: "Have you consulted a dermatologist regarding skin concerns in the past year?", options: ["Yes", "No", "Thinking about it", "Not necessary"] },
    { text: "What steps do you take to protect your skin?", options: ["Use sunscreen", "Stay hydrated", "Follow a skincare routine", "None of the above"] }
];



    let questionIndex = 0;

    chatWidget.addEventListener('click', () => {
        chatWindow.style.display = chatWindow.style.display === 'none' ? 'flex' : 'none';
        if (chatWindow.style.display === 'flex') {
            askQuestion();
        }
    });

    function askQuestion() {
        optionsContainer.innerHTML = ""; // Clear previous options
        if (questionIndex < questions.length) {
            const question = questions[questionIndex];
            const questionMessage = document.createElement('div');
            questionMessage.classList.add('message', 'bot-message');
            questionMessage.textContent = question.text;
            chatBody.appendChild(questionMessage);

            question.options.forEach(option => {
                const optionDiv = document.createElement('div');
                optionDiv.innerHTML = `
                    <input type="radio" name="answer" value="${option}" id="${option}">
                    <label for="${option}">${option}</label>
                `;
                optionsContainer.appendChild(optionDiv);
            });

            const submitButton = document.createElement('button');
            submitButton.textContent = "Submit Answer";
            submitButton.addEventListener('click', () => {
                const selectedOption = document.querySelector('input[name="answer"]:checked');
                if (selectedOption) {
                    const userMessage = document.createElement('div');
                    userMessage.classList.add('message', 'user-message');
                    userMessage.textContent = `${selectedOption.value}`;
                    chatBody.appendChild(userMessage);

                    questionIndex++;
                    askQuestion(); // Ask the next question
                } else {
                    alert("Please select an option before submitting.");
                }
            });
            optionsContainer.appendChild(submitButton);
        } else {
            const endMessage = document.createElement('div');
            endMessage.classList.add('message', 'bot-message');
            endMessage.textContent = "Thank you for your responses!";
            chatBody.appendChild(endMessage);
            optionsContainer.innerHTML = ""; // Clear options
        }
    }
</script>



@endsection