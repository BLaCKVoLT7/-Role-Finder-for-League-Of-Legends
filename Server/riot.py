import bfrac
import MySQLdb


lane_to_number = {'BOTTOM':1 , 'TOP':2 , 'MIDDLE':3 , 'JUNGLE':4 ,'UTILITY':5}

appconfig = bfrac.AppConfig("C:/xampp/htdocs/RoleFinder/Server/Settings/aGirakaduwa_config.ini")

rac = bfrac.RiotAPICaller(appconfig, in_last_use=0, in_burst_size=20, in_burst_seconds=1, in_long_size=100, in_long_seconds=120)

qc = bfrac.QueryContext(rac)

def insert_to_user_game_data(dataarray):
    # To connect to DB
    db = MySQLdb.connect("localhost","root","","rolefinder")
    # to enter data to DB
    insertrec=db.cursor()
    sqlquery = "INSERT IGNORE INTO `user_game_data` (`summoner_name`, `game_number`, `Early_game_gold_earned`, `Middle_game_gold_earned`, `late_game_gold_earned`, `main_role`) VALUES (%s, %s, %s, %s, %s, %s)"
    insertrec.execute(sqlquery,dataarray)
    db.commit()
    db.close()

def update_role(summoner_name,new_role):
    # To connect to DB
    db = MySQLdb.connect("localhost","root","","rolefinder")
    # to enter data to DB
    insertrec=db.cursor()
    sqlquery = "UPDATE `user_form` SET `rf_role` = '{}' WHERE `user_form`.`summoner_name` = '{}' ".format(new_role,summoner_name)
    insertrec.execute(sqlquery)
    db.commit()
    db.close()

# get infor of any 1 match
def get_single_match_features(match):
    # for 1 match
    timeline = qc.get_match_timeline(match)
    matchinfo = qc.get_match_info(match)
    participantId_to_summonerName = {p['participantId']:p['summonerName'] for p in matchinfo['info']['participants']}
    participantId_to_lane = {p['participantId']:p['teamPosition'] for p in matchinfo['info']['participants']}
    x = timeline['info']['frames']
    for pnumber in timeline['info']['frames'][15]['participantFrames']:
        pn = timeline['info']['frames'][15]['participantFrames'][pnumber]['participantId']
        sname = participantId_to_summonerName[pn]
        lane = participantId_to_lane[pn]
        laneId = lane_to_number[lane]
        earlygameusergold = timeline['info']['frames'][14]['participantFrames'][pnumber]['totalGold'] /  15
        midgameusergold = ((x[24]['participantFrames'][pnumber]['totalGold'] if len(x) > 24 else x[-1]['participantFrames'][pnumber]['totalGold'] ) - x[14]['participantFrames'][pnumber]['totalGold'] ) / (10 if len(x) > 24 else (len(x)-15) )
        lategameusergold = ((x[-1]['participantFrames'][pnumber]['totalGold'] - x[24]['participantFrames'][pnumber]['totalGold']) / (len(x)-25)) if len(x) > 25 else None
        print(pnumber,pn,sname,lane,laneId,earlygameusergold,midgameusergold,lategameusergold,match)
        insert_to_user_game_data([sname,match,earlygameusergold,midgameusergold,lategameusergold,laneId])

def get_user_details(serverName,summonerName):
    qc.set_region_server(serverName)
    sn = qc.get_summoner_by_name(summonerName)
    ml = qc.get_matches(100, "ranked", 420)
    for match in ml:
        get_single_match_features(match)







