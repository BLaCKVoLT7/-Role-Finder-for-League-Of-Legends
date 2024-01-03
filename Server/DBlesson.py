import pandas as pd
import MySQLdb
import numpy as np

# To connect to DB
db = MySQLdb.connect("localhost","root","","rolefinder")

# to enter data to DB
insertrec=db.cursor()

# to insert given name to table name
lane_to_table = {"Jungle":"jungle","ADC":"bottom","Middle":"middle","Support":"support","Top":"top_lane"}

for lane in ["Jungle","ADC","Middle","Support","Top"]:
    data_file_name = f'Outputs/{lane}Gold.csv'

    df = pd.read_csv(data_file_name)

    for i in range(df.shape[0]):
        sqlquery = "insert into {}(game_id,Early_game_gold_earned,Middle_game_gold_earned,late_game_gold_earned) values({},{},{},{})".format(lane_to_table[lane],i,
                                        df.iloc[i]['early_goldblue'] if not np.isnan(df.iloc[i]['early_goldblue']) else -1,
                                        df.iloc[i]['mid_goldblue'] if not np.isnan(df.iloc[i]['mid_goldblue']) else -1,
                                        df.iloc[i]['late_goldblue'] if not np.isnan(df.iloc[i]['late_goldblue']) else -1)

        insertrec.execute(sqlquery)
        db.commit()
        # print(sqlquery)

    print("Saved")
db.close()