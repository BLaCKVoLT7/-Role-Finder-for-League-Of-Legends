from flask import Flask, request, jsonify
import pandas as pd
import joblib

import riot

number_to_lane = {1:'BOTTOM',2:'TOP',3:'MIDDLE',4:'JUNGLE',5: 'UTILITY'}

app = Flask(__name__)

@app.route("/about")
def hello_world():
    return "<p>Hello, World!</p>"

@app.route('/predict', methods=['POST'])
def predict():
    json_ = request.json
    query_df = pd.DataFrame(json_)
    query = pd.get_dummies(query_df)
    prediction = clf.predict(query)
    return jsonify({'prediction':list(prediction)})

@app.route('/test', methods=['POST'])
def test():
    if request.method == 'POST':
        prediction = clf.predict([[request.form['early'],request.form['mid'],request.form['late']]])
        riot.update_role(request.form["summoner_name"],prediction[0])
        return number_to_lane[prediction[0]]
    else:
        return "not a post"

# new route for download matches
@app.route('/downloadmatches', methods=['POST'])
def getmatches():
    if request.method == 'POST':
        riot.get_user_details(request.form["server_name"],request.form["summoner_name"])
        return "Success!"
    else:
        return "not a post"

# new route for get matches by role

if __name__ == '__main__':
    clf = joblib.load('model1.pkl')
    app.run(port=5000)

