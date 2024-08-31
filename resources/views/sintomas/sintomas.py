import pandas as pd
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.preprocessing import LabelEncoder
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score
import pickle
import os
import sys
import json

def tokenizer(text):
    return text.split(', ')

def load_model():
    script_dir = os.path.dirname(__file__)
    model_path = os.path.join(script_dir, 'model.pkl')
    return pickle.load(open(model_path, 'rb'))

def load_vectorizer():
    script_dir = os.path.dirname(__file__)
    vectorizer_path = os.path.join(script_dir, 'vectorizer.pkl')
    return pickle.load(open(vectorizer_path, 'rb'))

def load_label_encoder():
    script_dir = os.path.dirname(__file__)
    label_encoder_path = os.path.join(script_dir, 'label_encoder.pkl')
    return pickle.load(open(label_encoder_path, 'rb'))

def predict_disease(symptoms):
    model = load_model()
    vectorizer = load_vectorizer()
    label_encoder = load_label_encoder()

    X_new = vectorizer.transform([', '.join(symptoms)])
    prediction = model.predict(X_new)
    return label_encoder.inverse_transform(prediction)[0]

def main():
    if len(sys.argv) > 1:
        symptoms = sys.argv[1:]
        result = predict_disease(symptoms)
        output = json.dumps({"resultado": result})
        print(output)
    else:
        # Training stage (if no arguments are passed)
        script_dir = os.path.dirname(__file__)
        
        file_path = os.path.join(script_dir, 'Sintomas.csv')
        df = pd.read_csv(file_path)
        
        vectorizer = CountVectorizer(tokenizer=tokenizer)
        X = vectorizer.fit_transform(df[['Symptom_1', 'Symptom_2', 'Symptom_3', 'Symptom_4', 'Symptom_5', 'Symptom_6', 'Symptom_7', 'Symptom_8', 'Symptom_9', 'Symptom_10', 'Symptom_11', 'Symptom_12', 'Symptom_13', 'Symptom_14', 'Symptom_15', 'Symptom_16', 'Symptom_17']].apply(lambda row: ', '.join(row.dropna()), axis=1))
        
        label_encoder = LabelEncoder()
        y = label_encoder.fit_transform(df['Disease'])
        
        X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)
        
        model = RandomForestClassifier()
        model.fit(X_train, y_train)
        
        # Save the model and vectorizer
        model_path = os.path.join(script_dir, 'model.pkl')
        vectorizer_path = os.path.join(script_dir, 'vectorizer.pkl')
        label_encoder_path = os.path.join(script_dir, 'label_encoder.pkl')
        
        with open(model_path, 'wb') as f:
            pickle.dump(model, f)
        with open(vectorizer_path, 'wb') as f:
            pickle.dump(vectorizer, f)
        with open(label_encoder_path, 'wb') as f:
            pickle.dump(label_encoder, f)
        
        # Check the model's accuracy
        y_pred = model.predict(X_test)
        print("Accuracy:", accuracy_score(y_test, y_pred))

if __name__ == "__main__":
    main()
