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
    return str(stringvalue.replace('\n',' ').strip().rstrip().lstrip())
    
def csv_dict_writer(path, fieldnames, data):
    """
    Writes a CSV file using DictWriter
    """
    with open(path, "wb") as out_file:
      writer = csv.DictWriter(out_file, delimiter=',', fieldnames=fieldnames)
      writer.writeheader()
      for row in data:
        writer.writerow(row)
    
fakerecord = []
fakedata = []
cvsfilename=str(sys.argv[1])
clientvendorno=int(sys.argv[2])
recordneeded=int(sys.argv[3])
#print scvfilename
fakerecord = 'ClientVendorNumber','VendorName','InvoiceAddressLine1','InvoiceAddressLine2','InvoiceAddressLine3','InvoiceCity','InvoiceState','InvoiceZipCode','Contact','InvoiceContactTelNo','TaxIDChar','VendorTypePricing','Facility','Country'
dictState = {'Alabama':'AL','Alaska':'AK','Arizona':'AZ','Arkansas':'AR','California':'CA','Colorado':'CO','Connecticut':'CT','Delaware':'DE','Florida':'FL','Georgia':'GA','Hawaii':'HI','Idaho':'ID','Illinois':'IL','Indiana':'IN','Iowa':'IA','Kansas':'KS','Kentucky':'KY','Louisiana':'LA','Maine':'ME','Maryland':'MD','Massachusetts':'MA','Michigan':'MI','Minnesota':'MN','Mississippi':'MS','Missouri':'MO','Montana':'MT','Nebraska':'NE','Nevada':'NV','NewHampshire':'NH','NewJersey':'NJ','NewMexico':'NM','NewYork':'NY','NorthCarolina':'NC','NorthDakota':'ND','Ohio':'OH','Oklahoma':'OK','Oregon':'OR','Pennsylvania':'PA','RhodeIsland':'RI','SouthCarolina':'SC','SouthDakota':'SD','Tennessee':'TN','Texas':'TX','Utah':'UT','Vermont':'VT','Virginia':'VA','Washington':'WA','WestVirginia':'WV','Wisconsin':'WI','Wyoming':'WY'}
fake = Factory.create('en_US')
#fake=Faker()
#outputfile= "/var/www/html/pscript/%s"%str(cvsfilename) #vendorload.csv"   #output file
outputfile=str(cvsfilename) 
#outputfile= "C:\\temp\\%s"%str(cvsfilename) #vendorload.csv"   #output file
#print outputfile
fakedata.append(fakerecord)
fieldnames=fakerecord

##print gettimestamp();
##print str(gettimestamp()).split('.',1)[0]

#print splitwords('bbbb # mmmm','#',0)
#phone_number=splitwords(fake.phone_number(),'x',0)
#print phone_number;
#"""
for i in range(0,recordneeded):

    ssn=str(fake.ssn().replace('-','').replace(' ',''))
    postcode=str(splitwords(fake.postcode(),'-',0))
    phone_number=str(getphonenumber(splitwords(fake.phone_number(),'x',0)))
    pricing=randint(0,6)
    if pricing == 0 or pricing == 6:
        pricing=' '
    #fake.street_address() 
    fakerecord= int(i+clientvendorno),stripnewline(fake.company()),stripnewline(fake.street_address()),'','',str(fake.city()),str(dictState[fake.state()]),postcode,str(fake.name()),phone_number,ssn,pricing,str(fake.city()),'USA'
    fakedata.append(fakerecord)
    #print fakerecord
    
#"""
my_list = []
fieldnames = fakedata[0]
for values in fakedata[1:]: 
    inner_dict = dict(zip(fieldnames,values))
    my_list.append(inner_dict)

path = outputfile
csv_dict_writer(path,fieldnames,my_list)  
#"""