from flask import Flask, request, jsonify
import tensorflow as tf
import numpy as np
import cv2
from tensorflow.keras.models import load_model

# Initialize Flask app
app = Flask(__name__)

# Load the trained model (ensure it's uploaded and accessible)
model_path = "main_model.h5"  # Update with your actual model path
model = load_model(model_path, compile=False)

# Preprocess image function (same as in your script)
def preprocess_image(image_file):
    # Read the image file
    image = cv2.imread(image_file)
    if image is None:
        return None
    
    image = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)  # Convert BGR to RGB
    resized_image = cv2.resize(image, (299, 299))  # Resize for InceptionResNetV2
    img_normalized = resized_image.astype('float32') / 255.0  # Normalize to [0, 1]

    # Expand dimensions to match model input shape (1, 299, 299, 3)
    img_expanded = np.expand_dims(img_normalized, axis=0)

    return img_expanded

# Route to handle image prediction
@app.route('/predict', methods=['POST'])
def predict():
    # Check if a file is provided in the request
    if 'file' not in request.files:
        return jsonify({"error": "No file part"})
    
    file = request.files['file']
    
    if file.filename == '':
        return jsonify({"error": "No selected file"})
    
    # Save the uploaded file
    image_path = "uploaded_image.jpg"  # Temporary location for the uploaded image
    file.save(image_path)

    # Preprocess the image
    preprocessed_img = preprocess_image(image_path)
    if preprocessed_img is None:
        return jsonify({"error": "Image processing failed"})
    
    # Make prediction
    prediction = model.predict(preprocessed_img)
    predicted_class = np.argmax(prediction)  # Get the class with highest probability
    confidence = float(np.max(prediction))  # Get confidence score

    return jsonify({
        "predicted_class": int(predicted_class),
        "confidence": confidence
    })

if __name__ == '__main__':
    app.run(debug=True,port=5000)
