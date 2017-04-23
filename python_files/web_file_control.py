# Idea is to check a file which will hold the state
# of the energenie sockets.

import sys
import time
import switch_control as s

print("starting")

# Filepath to the file that holds the state of the switches:
f = "/usr/share/pi-www/cgi/switch_states.txt"

#FUNCTION: update_states(states)
# Input: list of switch states in sequential order
# Output: none
# Description: used to set the state of switches
# Process: go through the list of switch states
#   and send a command to switch_control module
#   to set the state for the switch
def update_states(states):
    for i in range(0, len(states)):
        s.switch_socket(i, states[i])
    return


#FUNCTION: parse_file(filename)
# Input: full filepath and name of file that holds
#   the state of the switches. (String)
# Output: a list of switch states in sequential order
# Description: Read in the file and get switch states
# Process: Create list strcture for holding states.
#   Open the file found at the filpath input. Read in
#   the states line by line (first line is first switch
#   last line is last switch). Convert string on/off to
#   true/false. Do something safe if 'on' or 'off' is
#   not found where it should be. Close the file and
#   return the list of states.
def parse_file(filename):
    print("PARSE: beginning")
    switch_states = []
    try:
        file = open(filename, 'r')
        print("PARSE: file open")
        for line in file:
            print("PARSE: line = ", line)
            line = line.strip()
            line = line.split('=')
            print("PARSE: line split into: ", line[0], " + ", line[1])
            if(line[1] == 'on'):
                print("PARSE: found 'on'")
                state = True
            elif(line[1] == 'off'):
                print("PARSE: found 'off'")
                state = False
            else:
                #Do something safe here
                print("PARSE: not found 'on' or 'off'")
                state = False
            print("about to append to list")
            switch_states.append(state)
            print("PARSE: switch ", line[0], " set to ", state)
        file.close()
        print("PARSE: file closed")
        
    except:
                 print("PARSE: something not right...")
                 print(sys.exc_info()[0])
                 #s.close()
    print("PARSE: exiting and returning switch states: ", switch_states)
    return switch_states

#---------------------------------------------
#MAIN PROGRAM ENTRY:                 
print("Beginning super loop")           
while(True):
    print("SUPERLOOP: parsing file")
    states = parse_file(f)
    print(states)
    if(not states):
        print("SUPERLOOP: No state to pass to control")
        exit()
    else:
        print("SUPERLOOP: updating switches")
        update_states(states)
    print("SUPERLOOP: sleeping")
    time.sleep(1)
