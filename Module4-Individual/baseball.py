import re

class player:
    def __init__(self, name):
        self.name = name
        self.at_bats = 0
        self.hits = 0
        self.runs = 0

data_path = input("Please enter the data path: ")
if data_path == "":
    print("InputERROR: You have to input the data path.")
else:
    file = open(data_path, "r")
    data = file.read()
    file.close()
    
    players = dict()
    
    find_results = re.findall("\w* \w* batted \d+ times with \d+ hits and \d+ runs", data)
    
    for find in find_results:
        match_results = re.match("(\w* \w*) batted (\d+) times with (\d+) hits and (\d+) runs", find)
        name = match_results.group(1)
        at_bats = int(match_results.group(2))
        hits = int(match_results.group(3))
        runs = int(match_results.group(4))
        if name not in players:
            players[name] = player(name)
        players[name].at_bats += at_bats
        players[name].hits += hits
        players[name].runs += runs
    
    player_batting_avg = dict()
    
    for key in players.keys():
        player_batting_avg[key] = players[key].hits/players[key].at_bats
        
    sorted_results = {p: b_a for p, b_a in sorted(player_batting_avg.items(), key=lambda item: item[1], reverse=True)}
    
    for p in sorted_results:
        print("{:s}: {:.3f}".format(p, sorted_results[p]))