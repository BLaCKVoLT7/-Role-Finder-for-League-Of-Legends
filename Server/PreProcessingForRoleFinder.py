import pandas as pd
import matplotlib.pyplot as plt

print(pd.__version__)

data_file_name = 'C:/xampp/htdocs/RoleFinder/Server/Inputs/LeagueofLegends.csv'

df = pd.read_csv(data_file_name)

print(df)

df["gamelength"].plot.hist()
plt.title("Gamelength Histogram")
# plt.show()

def make_gold_table(lane):
    df[f'goldblue{lane}'] = df[f'goldblue{lane}'].apply(lambda x: eval(x) if type(x) is str else x )
    #
    df[f'early_goldblue'] = df[f'goldblue{lane}'].apply(lambda x:  x[14] / 15 )
    #
    df[f'mid_goldblue'] = df[f'goldblue{lane}'].apply(lambda x: ((x[24] if len(x) > 24 else x[-1] ) - x[14] ) / (10 if len(x) > 24 else (len(x)-15) ) )
    #
    df[f'late_goldblue'] = df[f'goldblue{lane}'].apply(lambda x: ((x[-1] - x[24]) / (len(x)-25) if len(x) > 25 else None))
    #
    df['lane'] = lane
    #
    df[[f'early_goldblue',f'mid_goldblue',f'late_goldblue','lane']].to_csv(f'./Outputs/{lane}Gold.csv',index=False)


for lane in ['Top','Middle','Jungle','ADC','Support']:
    print(lane)
    make_gold_table(lane)

# df.to_csv('newRoleFinderProcessedData.csv', index=False)  # load this file next time





