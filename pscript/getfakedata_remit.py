from faker import Factory
from faker import Faker
import csv, decimal, time, random, datetime , sys
from random import randint

def round_to(n, precision):
    return int(precision * round(float(n)/precision))
    
def randomtranamount(loweramount, upperamount, even_factor):
    #randtranamount = randint(0.00,2000.00)
    randtranamount = decimal.Decimal(randint(loweramount,upperamount))/100
    if  even_factor == 1:
        randtranamount = round_to(randtranamount,even_factor)
    elif  even_factor == 5:
        randtranamount = round_to(randtranamount,even_factor)
    elif  even_factor == 10:
        randtranamount = round_to(randtranamount,even_factor)  

    return randtranamount
    
def gettimestamp():
    #t=int((time.time())*1000)
    t=time.time();
    return t;

def splitwords(stringvalue,character,getval):
    dataarray=stringvalue.split(character)
    return dataarray[getval].strip()
    
def getphonenumber(phonenumber):    
    phonestring=phonenumber.replace('-','').replace(')','').replace('(','').replace('+','').replace('.','').replace(' ','')
    return phonestring[-10:]

def stripnewline(stringvalue):    
    return str(stringvalue.replace('\n','').replace('\r','').strip().rstrip().lstrip())
    
def csv_dict_writer(path, fieldnames, data):
    """
    Writes a CSV file using DictWriter
    """
    with open(path, "wb") as out_file:
      writer = csv.DictWriter(out_file, delimiter=',', fieldnames=fieldnames)
      writer.writeheader()
      for row in data:
        writer.writerow(row)
def getrandomcolumfromfile(filename):
    referenceids = []
    with open(filename,'r') as inf:
        for line in inf:
            referenceids.append(stripnewline(line))
    return referenceids  

def getrandom_element(rand_array):         
    rand_count=len(rand_array)-1
    return rand_array[randint(0,rand_count)]
    
fakerecord = []
fakedata = []
cvsfilename=str(sys.argv[1])
#clientvendorno=int(sys.argv[2])
recordneeded=int(sys.argv[2])
#print scvfilename
fakerecord = 'Remit Code','Business Name','Street Address Field 1','Street Address Field 2','City','State','Zip','Contact phone number ','Global Edge Reference ID'
dictState = {'Alabama':'AL','Alaska':'AK','Arizona':'AZ','Arkansas':'AR','California':'CA','Colorado':'CO','Connecticut':'CT','Delaware':'DE','Florida':'FL','Georgia':'GA','Hawaii':'HI','Idaho':'ID','Illinois':'IL','Indiana':'IN','Iowa':'IA','Kansas':'KS','Kentucky':'KY','Louisiana':'LA','Maine':'ME','Maryland':'MD','Massachusetts':'MA','Michigan':'MI','Minnesota':'MN','Mississippi':'MS','Missouri':'MO','Montana':'MT','Nebraska':'NE','Nevada':'NV','NewHampshire':'NH','NewJersey':'NJ','NewMexico':'NM','NewYork':'NY','NorthCarolina':'NC','NorthDakota':'ND','Ohio':'OH','Oklahoma':'OK','Oregon':'OR','Pennsylvania':'PA','RhodeIsland':'RI','SouthCarolina':'SC','SouthDakota':'SD','Tennessee':'TN','Texas':'TX','Utah':'UT','Vermont':'VT','Virginia':'VA','Washington':'WA','WestVirginia':'WV','Wisconsin':'WI','Wyoming':'WY'}
fake = Factory.create('en_US')

#outputfile= "/var/www/html/pscript/%s"%str(cvsfilename) #vendorload.csv"   #output file
outputfile=str(cvsfilename) 
#outputfile= "C:\\temp\\%s"%str(cvsfilename) #vendorload.csv"   #output file
referenceids_file = "referenceids.csv"  #  Mcc's that will be created
#ref_array=getrandomcolumfromfile(referenceids_file);

file_array = []
file_array=getrandomcolumfromfile(referenceids_file)
#print file_array
#array=['www','wwee','dasdas','asdasdasd','as']
#print getrandom_element(array)
    
#"""
fakedata.append(fakerecord)
fieldnames=fakerecord

for i in range(0,recordneeded):
    postcode=str(splitwords(fake.postcode(),'-',0))
    phone_number=str(getphonenumber(splitwords(fake.phone_number(),'x',0)))
    remit="REMIT%d"%i
    #print file_array
    gereferenceid=getrandom_element(file_array)
    fakerecord= remit,stripnewline(fake.company()),stripnewline(fake.street_address()),'',str(fake.city()),str(dictState[fake.state()]),postcode,phone_number,gereferenceid
    fakedata.append(fakerecord)
    #print gereferenceid
#"""
my_list = []
fieldnames = fakedata[0]
for values in fakedata[1:]: 
    inner_dict = dict(zip(fieldnames,values))
    my_list.append(inner_dict)

path = outputfile
csv_dict_writer(path,fieldnames,my_list)
#"""