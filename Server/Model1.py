import pandas as pd
from sklearn.tree import DecisionTreeClassifier
from sklearn.model_selection import train_test_split
from sklearn import metrics
import glob
import joblib

# Adding Files to the file
glob.glob('C:\xampp\htdocs\RoleFinder\Server\Outputs\*Gold.csv')

fileList = glob.glob('C:\xampp\htdocs\RoleFinder\Server\Outputs\*Gold.csv')

# Pre-processing
dflist = []

for f in fileList:
    print(f)
    df = pd.read_csv(f)
    dflist.append(df)

df = pd.concat(dflist)

lane_to_number = {'ADC':1 , 'Top':2 , 'Middle':3 , 'Jungle':4 ,'Support':5}
number_to_lane = {lane_to_number[key]:key for key in lane_to_number} # to change values using for loop

df['lane'] = df['lane'].apply(lambda x : (lane_to_number[x]) )

df.dropna(inplace=True) # drop rows that has Nan values
print(df.shape)
""" 
#feature selection # feature = columns in the
y = lane
x = early_goldblue, mid_goldblue,  late_goldblue
"""
# training dataset
X = df[['early_goldblue','mid_goldblue','late_goldblue']]
Y = df['lane']

X_train,X_test,Y_train,Y_test = train_test_split(X,Y,test_size=0.3)

"""
#Builing the model
clf = classifier
"""

# classifier object
clf = DecisionTreeClassifier()
# Train classifier
clf = clf.fit(X_train,Y_train)
# Test run
Y_pred = clf.predict(X_test)

accuracy = metrics.accuracy_score(Y_test,Y_pred)

print(accuracy)

# To try to see whether this passenger survive
players=[[300,400,500],[223,123,545]] # to make it to a Dataframe
playersdf = pd.DataFrame(players,columns=['early_goldblue','mid_goldblue','late_goldblue'])

x = clf.predict(playersdf)

print(x)

joblib.dump(clf,"Model1.pkl")

print([number_to_lane[e] for e in x])