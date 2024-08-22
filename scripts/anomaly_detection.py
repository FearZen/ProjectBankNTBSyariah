import pandas as pd
import numpy as np  # Pastikan numpy diimpor
from scipy import stats
import psycopg2
import requests

# Koneksi ke database PostgreSQL
conn = psycopg2.connect("dbname=Project_BankNTB user=postgres password=zidan100303 host=127.0.0.1")

# Ambil data dari tabel visitors dengan nama kolom yang benar
query = "SELECT id, EXTRACT(EPOCH FROM created_at) AS created_at_timestamp FROM visitors"
df = pd.read_sql(query, conn)

# Tampilkan data yang diambil
print("Data yang diambil dari database:")
print(df.head())

# Statistik dasar data
print("\nStatistik dasar data:")
print(df.describe())

# Hitung Z-Score untuk mendeteksi lonjakan
z_scores = np.abs(stats.zscore(df[['created_at_timestamp']]))
threshold = 2  # Ambang batas Z-Score

# Deteksi lonjakan
df['anomaly'] = z_scores > threshold

# Tampilkan hasil deteksi lonjakan
print("\nHasil deteksi lonjakan:")
print(df['anomaly'].value_counts())

# Filter data yang terdeteksi sebagai anomali
anomalies = df[df['anomaly'] == True]

# Tampilkan data anomali jika ada
if not anomalies.empty:
    print("\nData yang terdeteksi sebagai lonjakan:")
    print(anomalies)

    # Kirim hasil ke Laravel
    anomalies_data = anomalies.to_dict(orient='records')
    try:
        response = requests.post('http://localhost:8000/api/report-anomalies', json=anomalies_data)
        print(f"\nStatus Code: {response.status_code}")
        print(f"Response Text: {response.text}")

        if response.status_code == 200:
            print("Anomali berhasil dilaporkan.")
        else:
            print("Gagal melaporkan anomali.")
    except requests.exceptions.RequestException as e:
        print(f"Request Exception: {e}")
else:
    print("Tidak ada lonjakan yang terdeteksi.")
