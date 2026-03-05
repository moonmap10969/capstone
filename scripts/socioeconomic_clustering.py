import pandas as pd
from sklearn.cluster import KMeans
import sys
import json

try:
    # 1. Load Data passed from Laravel
    data = json.loads(sys.argv[1])
    df = pd.DataFrame(data)

    if df.empty or len(df) < 3:
        print(json.dumps({"error": "Not enough data for 3 clusters"}))
        sys.exit(1)

    # 2. Feature Encoding (Converting text to numbers for the math model)
    income_map = {'below_25k': 1, '25k_to_50k': 2, '50k_to_100k': 3, 'above_100k': 4}
    emp_map = {'unemployed': 1, 'retired': 2, 'employed_part': 3, 'employed_full': 4, 'self_employed': 5}

    df['income_val'] = df['household_income'].map(income_map).fillna(2)
    df['emp_val'] = df['employment_status'].map(emp_map).fillna(3)
    df['size_val'] = pd.to_numeric(df['household_size'], errors='coerce').fillna(4)

    # Features used for clustering
    X = df[['income_val', 'emp_val', 'size_val']]

    # 3. Apply K-Means Clustering
    kmeans = KMeans(n_clusters=3, random_state=42, n_init=10)
    df['raw_cluster'] = kmeans.fit_predict(X)

    # 4. Intelligently Sort Clusters (Identify which is High, Med, Low Need)
    # Higher Need = Lower Income + Lower Employment Status + Larger Household
    df['need_score'] = (5 - df['income_val']) * 2 + (5 - df['emp_val']) + df['size_val']
    
    # Calculate average need score per cluster
    cluster_scores = df.groupby('raw_cluster')['need_score'].mean().sort_values(ascending=False)
    
    # Map raw clusters to standardized tiers based on the need score
    # 0 = High Need, 1 = Moderate Need, 2 = Low Need
    cluster_mapping = {
        cluster_scores.index[0]: 'high_need',
        cluster_scores.index[1]: 'moderate_need',
        cluster_scores.index[2]: 'low_need'
    }
    
    df['risk_tier'] = df['raw_cluster'].map(cluster_mapping)

    # 5. Return the results back to Laravel
    results = df[['id', 'risk_tier']].to_dict(orient='records')
    print(json.dumps(results))

except Exception as e:
    print(json.dumps({"error": str(e)}))
    sys.exit(1)