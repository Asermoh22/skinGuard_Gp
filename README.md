# Human Skin Disease Detection AI System

![Skin Disease Detection]([https://via.placeholder.com/800x300.png?text=Skin+Disease+Detection+AI](https://www.google.com/url?sa=i&url=https%3A%2F%2Fv0.dev%2Fcommunity%2Fnewest&psig=AOvVaw2xEIt1wofL1J7pm7_49BIJ&ust=1749126302500000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCKDf3Mjh140DFQAAAAAdAAAAABAE)https://www.google.com/url?sa=i&url=https%3A%2F%2Fv0.dev%2Fcommunity%2Fnewest&psig=AOvVaw2xEIt1wofL1J7pm7_49BIJ&ust=1749126302500000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCKDf3Mjh140DFQAAAAAdAAAAABAE)  

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
| VGG19               | 94.7%         |
| MobileNet           | 92%           |
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
    A[Client Web/Mobile App] -->|HTTP Request| B[Flask API Server]
    B --> C[Load Model]
    C --> D[5-class ViT Model]
    C --> E[10-class ViT Model]
    D --> F[Prediction]
    E --> F
    F -->|JSON Response| A
    B --> G[Log to Database]
