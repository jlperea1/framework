import smbus
import time
import sys

# for RPI version 1, use "bus = smbus.SMBus(0)"
bus = smbus.SMBus(1)

# This is the address we setup in the Arduino Program
address = 0x04

def writeNumber(value1,value2):
    bus.write_i2c_block_data(address,value1  , [value2]) 
    # bus.write_i2c_block_data(address,1 , [1, value2])
    # bus.write_byte(address, value) escribe otro dato
    # bus.write_byte_data(address, 0, value)
    return -1

def readNumber():
    number = bus.read_byte(address)
    # number = bus.read_byte_data(address, 1)
    return number


try:
    # var = int(raw_input("Enter 1 - 9: "))
    var1 = int(sys.argv[1])
    var2 = int(sys.argv[2])
except ValueError:
    print "Could you at least give me an actual number?"

writeNumber(var1,var2)

# print "RPI: Hi Arduino, I sent you ", var2
# sleep one second
time.sleep(1)

number = readNumber()
print number
