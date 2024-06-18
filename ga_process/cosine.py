from sklearn.cluster import KMeans
import sys
from sklearn import metrics
from scipy.spatial.distance import cdist
import numpy as np
np.set_printoptions(threshold=np.inf)
np.set_printoptions(threshold=sys.maxsize)
import matplotlib.pyplot as plt
import pandas as pd
import seaborn as sns
import mysql.connector
from sklearn.preprocessing import StandardScaler

mydb = mysql.connector.connect(
host="localhost",
user="root",
password="",
database="rmr_sys"
)

mycursor = mydb.cursor()

mycursor.execute("SELECT * FROM data2")
myresult = mycursor.fetchall()
# df = myresult
df = pd.DataFrame(myresult)
df.columns = ['q_1','id_user','id_product','rating','created_at','updated_at']

