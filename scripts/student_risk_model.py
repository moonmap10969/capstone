import pandas as pd
from sklearn.ensemble import RandomForestClassifier
import sys
import json

# 1. Feature Engineering: Data passed from Laravel
# Features: [balance, grade_average, year_level_numeric, sibling_count]
try:
    data = json.loads(sys.argv[1])
    df = pd.DataFrame(data)
except Exception as e:
    print(json.dumps({"error": str(e)}))
    sys.exit(1)

# 2. Updated Training Data for Kinder 1-3 (1-3) and Grade 1-10 (4-13)
# Patterns: [Balance, Avg Grade, Year Level (Numeric), Has Sibling (0/1)]
X_train = [
    [15000, 75, 1, 0],  # High balance, low grade, Kinder 1 -> High Risk
    [0, 95, 13, 1],     # No balance, high grade, Grade 10 -> Low Risk
    [8000, 82, 4, 0],   # Mid balance, mid grade, Grade 1 -> Moderate Risk
    [500, 88, 7, 1],    # Low balance, good grade, Grade 4 -> Low Risk
    [20000, 70, 10, 0], # Very high balance, low grade, Grade 7 -> High Risk
]
y_train = [1, 0, 1, 0, 1] # 1 = At-Risk, 0 = Likely to Return

model = RandomForestClassifier(n_estimators=100, random_state=42)
model.fit(X_train, y_train)

# 3. Predict for the current batch from Laravel
predictions = model.predict_proba(df.values)

# Output probability of being 'At-Risk' (index 1)
print(json.dumps(predictions[:, 1].tolist()))