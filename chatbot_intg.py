from flask import Flask, request, jsonify
from sentence_transformers import SentenceTransformer, util
import pandas as pd

# Initialize Flask app
app = Flask(__name__)

# Load the dataset (Make sure the correct path is set)
df = pd.read_csv("combined_data.csv")  # Update with the actual path

# Check if dataset contains necess
# ary columns
if "prompt" not in df.columns or "response" not in df.columns:
    raise ValueError("Dataset must contain 'prompt' and 'response' columns")

# Load the Sentence-Transformer model
model = SentenceTransformer("all-MiniLM-L6-v2")

# Encode all prompts into embeddings
prompt_embeddings = model.encode(df["prompt"].tolist(), convert_to_tensor=True)

# Function to get the chatbot response based on user input
def get_response(user_input):
    user_embedding = model.encode(user_input, convert_to_tensor=True)
    similarities = util.pytorch_cos_sim(user_embedding, prompt_embeddings)
    best_match_idx = similarities.argmax().item()
    return df.loc[best_match_idx, "response"]

# Route to handle chatbot interaction
@app.route('/chat', methods=['POST'])
def chat():
    # Check if user input is provided in the request
    if not request.json or 'message' not in request.json:
        return jsonify({"error": "No message provided"}), 400

    # Get user input from the request
    user_input = request.json['message']
    
    # Get the chatbot's response
    response = get_response(user_input)
    
    return jsonify({
        "response": response
    })

if __name__ == '__main__':
    
    app.run(debug=True, port=5001)  # Run on port 5001

