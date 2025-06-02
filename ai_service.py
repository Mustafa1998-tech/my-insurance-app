from flask import Flask, request, jsonify
import json

app = Flask(__name__)

# Premium calculation function
def calculate_premium(age, value):
    # Base premium calculation
    base_premium = (age * 50) + (value * 0.005)
    
    # Age-based adjustments
    if age < 30:
        base_premium *= 0.9  # 10% discount for younger customers
    elif age > 60:
        base_premium *= 1.2  # 20% surcharge for older customers
    
    return round(base_premium, 2)

# API endpoint for premium calculation
@app.route('/calculate_premium', methods=['POST'])
def calculate_premium_endpoint():
    try:
        data = request.json
        age = int(data.get('age', 0))
        value = int(data.get('value', 0))
        
        if age <= 0 or value <= 0:
            return jsonify({'error': 'العمر والقيمة يجب أن تكون أكبر من صفر'}), 400
            
        # Calculate premium
        premium = calculate_premium(age, value)
        
        return jsonify({
            'premium': premium,
            'recommendation': 'ننصح بتأمين شامل لحماية أصولك'
        })
    except Exception as e:
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(port=5000, debug=True)

if __name__ == '__main__':
    app.run(port=5000)
