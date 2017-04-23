#Energinie Socket Control
#
#Note: K and D are interchangagle
#       K is short for Key - the key code for each socket K0-K3
#       D is short for data pin and directly relates to K
#       D0-D3 = K0-K3
##print("To clear socket programming, press green button")
##print("for 5 seconds until red light flashes slowly")
##print("The socket is learning and waiting for a control code")

import RPi.GPIO as GPIO
import time

#set the pins numbering mode
GPIO.setmode(GPIO.BOARD)

#set GPIO pins used for the encoder K0-K3 data inputs
GPIO.setup(11, GPIO.OUT)
GPIO.setup(15, GPIO.OUT)
GPIO.setup(16, GPIO.OUT)
GPIO.setup(13, GPIO.OUT)


#set GPIO pin used used to set ASK/FSK
GPIO.setup(18, GPIO.OUT)

#set GPIO pin used to enable/disable modulator
GPIO.setup(22, GPIO.OUT)

#Disable modulator - set pin22 low
GPIO.output(22, False)

#Set modulator tto ASK - set pin 18 low
GPIO.output(18, False)

#Initialse all other pins to low
GPIO.output(11, False)
GPIO.output(15, False)
GPIO.output(16, False)
GPIO.output(13, False)


#possible pairs are: (K3-K0)
#1011 and 0011 - all on/off
#1111 and 0111 - 1, on/off
#1110 and 0110 - 2, on/off
#1101 and 0101 - 3, on/off
#1100 and 0100 - 4, on/off

socket_id = []   #List of socket id's
#(k0, k1, k2) - D's and K's interchangerable
#bits are in reverse order for python list purposes
socket_id.append([1,1,1])     # Socket 1
socket_id.append([0,1,1])     # Socket 2
socket_id.append([1,0,1])     # Socket 3
socket_id.append([0,0,1])     # Socket 4

# For easier reference:
#k0-3 is the 'key' (id) for each socket
#which map to the following pins on the pi
k = []
k.append(11)    #K0
k.append(15)    #K1
k.append(16)    #K2
#k.append(13)   #K3 (on/off)

def switch_socket(socket, switch):
    # 'socket' is which socket to control (0 to 3)
    # 'switch' is the state to set that socket to (True/False)
        try:
                print("id bits")
                for bit in range(0, len(k)):
                        print("setting K" + str(bit))
                        GPIO.output(k[bit], socket_id[socket][bit])
                        print("setting ", k[bit], " ", socket_id[socket][bit])

                print("setting on/off bit to: ", switch)
                GPIO.output(13, switch)       #Set 'on' or 'off' bit

                time.sleep(0.1)
                
                # Transmit to socket:
                GPIO.output(22, True)   # Enable modulator
                #time.sleep(0.25)
                time.sleep(1)
                GPIO.output(22, False)  # Disable modulator
        except:
                print("something not right...")
                pass

##	if(switch):
##		try:
##            #set socket 1 on:
##			GPIO.output(k0, True)
##			GPIO.output(k1, True)
##			GPIO.output(k2, True)
##			GPIO.output(k3, True)
##            #wait a bit
##			time.sleep(0.1)
##            #enable modulator
##			GPIO.output(22, True)
##            #allow time to send
##			time.sleep(0.25)
##            #dissable modulator
##			GPIO.output(22, False)
##		except:
##			pass
##
##	elif(not switch):
##		try:
##            #set K0-K3 to turn socket 1 off:
##			GPIO.output(11, True)
##			GPIO.output(15, True)
##			GPIO.output(16, True)
##			GPIO.output(13, False)
##            #wait a bit
##			time.sleep(0.1)
##            #enable modulator
##			GPIO.output(22, True)
##            #allow time to send
##			time.sleep(0.25)
##            #dissable modulator
##			GPIO.output(22, False)
##		except:
##			pass
        ##GPIO.cleanup() #clear all the GPIO stuff
        return

def close():
    GPIO.cleanup()
    exit()
    return
