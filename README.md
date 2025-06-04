# Human Skin Disease Detection AI System

An end-to-end AI system for detecting human skin diseases using deep learning models, deployed via Flask API and integrated with a SkinGuard web application.

## Key Features
- **Multi-class classification** (5-class and 10-class versions)
- **State-of-the-art models** comparison (CNN vs Transformer)
- **Production-ready deployment** with Flask API
- **Web application integration**
- **High accuracy performance** (up to 98% test accuracy)

## Model Performance

### 5-Class Classification (1,000 images per class)
| Model               | Test Accuracy |
|---------------------|---------------|
| MobileNet           | 92%           |
| EfficientNetB3      | 93.3%         |
| InceptionV3         | 93.5%         |
| VGG19               | 94.7%         |
| ResNet152           | 96.8%         |
| Vision Transformer  | **98%**       |


### 10-Class Classification (1,500 images per class)
| Model               | Test Accuracy |
|---------------------|---------------|
| VGG19               | 86%           |
| MobileNet           | 90%           |
| Vision Transformer  | **93%**       |

## Technical Implementation

### Dataset
- Original dataset: 10,189 images
- Augmented to 15,000 images for 10-class version
- Balanced classes (1,500 images per class)

### Models Trained
1. **VGG19** (CNN Architecture)
2. **MobileNetV2** (Lightweight CNN)
3. **Vision Transformer (ViT)**

## Deployment Architecture

### System Flow
```mermaid
graph TD
    A[Client Web App] -->|HTTP Request| B[Flask API Server]
    B --> C[Load Model]
    C --> D[5-class ViT Model]
    C --> E[10-class ViT Model]
    D --> F[Prediction]
    E --> F
    F -->|JSON Response| A
    B --> G[Log to Database]
