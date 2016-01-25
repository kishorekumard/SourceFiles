# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.

__author__ = "JohnNokes"
__date__ = "$Mar 27, 2015 12:34:24 PM$"

def csv_dict_writer(path, fieldnames, data):
    """
    Writes a CSV file using DictWriter
    """
    with open(path, "wb") as out_file:
      writer = csv.DictWriter(out_file, delimiter=',', fieldnames=fieldnames)
      writer.writeheader()
      for row in data:
        writer.writerow(row)

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

def randomDescription():
    tempDescription =  fake.text(20)
    return tempDescription

def csv_dict_reader(file_obj):
    """
    Read a CSV file using csv.DictReader
    """
    reader = csv.DictReader(file_obj, delimiter=',')
    #for line in reader:
    #    print(line["MCC_Code"]),
    #    print(line["Merchant_Name"])
    return reader


def randomMerchent(mcc_file):
    #s = [('0000', 'NO MERCHANT NAME'), ('0000', 'PAYMENT ADJUSTMENT'), ('0742', ''), ('blue', 4), ('red', 1)]
    d = defaultdict(list)
    for k, v in mcc_file:
        d[k].append(v)
    print d    

def randomtransactiondate(statementdate, format):
    #print "Print from def:",  statementdate
    stime = time.mktime(time.strptime(statementdate, format)) 
    statementtime = datetime.datetime.strptime(statementdate,format) + datetime.timedelta(-30)
    #print statementtime 
    #return time.strftime(format, time.localtime(stime))  
    return statementtime.strftime(format)
  
    
def strTimeProp(start, end, format, prop):
    """Get a time at a proportion of a range of two formatted times.

    start and end should be strings specifying times formated in the
    given format (strftime-style), giving an interval [start, end].
    prop specifies how a proportion of the interval to be taken after
    start.  The returned time will be in the specified format.
    """

    stime = time.mktime(time.strptime(start, format))
    etime = time.mktime(time.strptime(end, format))

    ptime = stime + prop * (etime - stime)

    return time.strftime(format, time.localtime(ptime))


def randomDate(start, end, prop):
    #print "start Date: ", start, "  End Date: ", end
    return strTimeProp(start, end, '%m/%d/%Y', prop)

if __name__ == "__main__":
    #print "Hello World"
    print "####  Start  ####"
    
    from faker import Factory
    from random import randint
    from collections import defaultdict
    import csv, decimal, time, random, datetime

##############################################################################################################################################
##
##                This is hte area that is updated to get differant fiel types    
##    
##############################################################################################################################################
    
    number_of_records = 20   # numebr of Transaction you want to create
    statementdate = '02/28/2015'   #Statement Date.  Teh Tran date is randmly created  from this day - 30 days
    transactionID = "TXN10323866"   # Starting Transactin number
    loweramount = 100   # lower dollaare amount 100 = 1.00 1000 = 10.00
    upperammount = 2000000 # upper dollar amount of tranasations
    bln_splittransation = False   # True if you want Split transactions (10% of the file)
    bln_duplicatetransaction = False    # True if you want Duplicate transactions (10% of the file)
    bln_eventtransaction = False  # True if you want Even transactions (10% of the file)
    bln_merchantkeywords = False  # True if you want Merchant Keyward transactions (10% of the file)  Need the merchantkeywordfile to seed the file
    eventransaction_factor = 5  # used with bln_eventtransaction 1 = rounded to the even dollar, 5 = Rounded to the nearest 5 Dollars, 10 = round to the nearest 10 dollars
    outputfile= "C:\\temp\\testdata.csv"   #output file
    merchentnamefile = "Y:\\GlobalEDGE\\Encompas\\Testing\\Test-Data\\Nokes\\MerchantNamesv1.csv"  # Load merschant names wiht mcc
    mccfile = "Y:\\GlobalEDGE\\Encompas\\Testing\\Test-Data\\Nokes\\mcc.csv"  #  Mcc's that will be created
    EmployeeIdfile = "Y:\\GlobalEDGE\\Encompas\\Testing\\Test-Data\\Nokes\\employeeid.csv"  #  EmployeeId's that will be user
    cardnumberIdfile = "Y:\\GlobalEDGE\\Encompas\\Testing\\Test-Data\\Nokes\\cardid.csv"  #  EmployeeId's that will be user
    merchantkeywordfile = "Y:\\GlobalEDGE\\Encompas\\Testing\\Test-Data\\Nokes\\merchantkeyword.csv"  # MCC and merchant name seed file for the merchant keyword test 
    #dictEmployeeId = {0:'000100200',1:'000100309',2:'000109699',3:'000110418',4:'000110789',5:'000110847',6:'000111238',7:'000111768',8:'000112019',9:'000112237',10:'000112264',11:'000112487'}
    #dictcardnumber = {0:'2423',1:'8632',2:'7840',3:'6691',4:'6345',5:'9696',6:'9045',7:'3277',8:'5454',9:'2191',10:'1063',11:'2887'}


##############################################################################################################################################

    employeeID = ""
    cardnumber = ""
    transactiondescription = ""
    transactionamount = ""
    taxamount = ""
    transactiondate = ""
    transactiontime = ""
    transactionstatus = ""
    splitindicator = ""
    postingdate = ""
    authorizationcode = ""
    shippingpostalcode = ""
    freightamount  = ""
    naicscode = ""
    mcc = ""
    merchantname = ""
    merchantaddress1 = ""
    merchantaddress2 = ""
    merchantcity = ""
    merchantstate = ""
    merchantzip = ""
    merchanttaxID = ""
    merchanturl = ""
    glddefault1 = ""
    glddefault2 = ""
    glddefault3 = ""
    glddefault4 = ""
    level3data = ""

    
    fake = Factory.create()

##   Load the dictionary for MCC and Company names
    dicts_from_file = []
    with open(merchentnamefile,'r') as inf:
        for line in inf:
            dicts_from_file.append(eval(line)) 
    
    dictMCC = defaultdict(list)
    for k, v in dicts_from_file:
        dictMCC[k].append(v)
    
    mcccodes = []
    with open(mccfile,'r') as inf:
        for line in inf:
            mcccodes.append(eval(line))
    mcccount = len(mcccodes)-1

##   Load the dictionary for MCC and Company names for Merchant Keywords
    dicts_from_file = []
    with open(merchantkeywordfile,'r') as inf:
        for line in inf:
            dicts_from_file.append(eval(line)) 
    
    dictMerchantKeyword = defaultdict(list)
    for k, v in dicts_from_file:
        dictMerchantKeyword[k].append(v)
    
##

##   Load the dictionary for Employee Id
    dicts_from_file = []
    with open(EmployeeIdfile,'r') as inf:
        for line in inf:
            dicts_from_file.append(eval(line)) 
    
    dictEmployeeId = defaultdict(list)
    for k, v in dicts_from_file:
        dictEmployeeId[k].append(v)
    ##
    
    ##   Load the dictionary for Card Id
    dicts_from_file = []
    with open(cardnumberIdfile,'r') as inf:
        for line in inf:
            dicts_from_file.append(eval(line)) 
    
    dictcardnumber = defaultdict(list)
    for k, v in dicts_from_file:
        dictcardnumber[k].append(v)
    
    ##

    fakedata = []
    fakerecord = []
    fakerecord2 = []
    fakerecord = ['employeeID',    'cardnumber','transactionID','transactiondescription','transactionamount','taxamount','transactiondate','transactiontime','transactionstatus','splitindicator','postingdate','authorizationcode','shippingpostalcode','freightamount','naicscode','mcc','merchantname',    'merchantaddress1','merchantaddress2','merchantcity','merchantstate','merchantzip','merchanttaxID','merchanturl','glddefault1','glddefault2','glddefault3','glddefault4','level3data','statementdate']
    dictState = {'Alabama':'AL','Alaska':'AK','Arizona':'AZ','Arkansas':'AR','California':'CA','Colorado':'CO','Connecticut':'CT','Delaware':'DE','Florida':'FL','Georgia':'GA','Hawaii':'HI','Idaho':'ID','Illinois':'IL','Indiana':'IN','Iowa':'IA','Kansas':'KS','Kentucky':'KY','Louisiana':'LA','Maine':'ME','Maryland':'MD','Massachusetts':'MA','Michigan':'MI','Minnesota':'MN','Mississippi':'MS','Missouri':'MO','Montana':'MT','Nebraska':'NE','Nevada':'NV','NewHampshire':'NH','NewJersey':'NJ','NewMexico':'NM','NewYork':'NY','NorthCarolina':'NC','NorthDakota':'ND','Ohio':'OH','Oklahoma':'OK','Oregon':'OR','Pennsylvania':'PA','RhodeIsland':'RI','SouthCarolina':'SC','SouthDakota':'SD','Tennessee':'TN','Texas':'TX','Utah':'UT','Vermont':'VT','Virginia':'VA','Washington':'WA','WestVirginia':'WV','Wisconsin':'WI','Wyoming':'WY'}

    fakedata.append(fakerecord)
    
    for i in range(0,number_of_records):
        randemployee = randint(0,len(dictEmployeeId)-1)
        randcardid = randint(0,len(dictcardnumber[dictEmployeeId[randemployee][0]])-1)
        randmcc = randint(0,mcccount)
        temp_mcc = mcccodes[randmcc]
        temp_company_name = fake.company()
        if dictMCC.has_key(temp_mcc):
            temp_mcc_company_names = dictMCC.get(temp_mcc)
            mcc_len = len(temp_mcc_company_names)-1
            randmcc = randint(0,mcc_len)
            temp_company_name = temp_mcc_company_names[randmcc]

        temptransactoinid =  transactionID+str(i*2)
        fakerecord= [dictEmployeeId[randemployee][0],dictcardnumber[dictEmployeeId[randemployee][0]][randcardid],temptransactoinid,randomDescription(),"%0.2f" % randomtranamount(loweramount,upperammount, 0),'0.00',randomDate(randomtransactiondate(statementdate,'%m/%d/%Y'), statementdate, random.random()),'','',splitindicator,randomDate(randomtransactiondate(statementdate,'%m/%d/%Y'), statementdate, random.random()),'','','','',temp_mcc,temp_company_name,fake.street_address(),'',fake.city(),dictState[fake.state()],fake.postcode(),'','','','','','','',statementdate]
       
       ## 
        if not bln_duplicatetransaction and not bln_splittransation and not bln_eventtransaction and not bln_merchantkeywords:
            fakedata.append(fakerecord)
       
        ## Add duplicate records
        if bln_duplicatetransaction:
            if randint(0,10)==1:
                for k in range(0,2):
                    if k ==1:
                        fakerecord = [fakedata[-1][0], fakedata[-1][1],transactionID+str(i*2+1),fakedata[-1][3],fakedata[-1][4],fakedata[-1][5],fakedata[-1][6],fakedata[-1][7],fakedata[-1][8],fakedata[-1][9],fakedata[-1][10],fakedata[-1][11],fakedata[-1][12],fakedata[-1][13],fakedata[-1][14],fakedata[-1][15],fakedata[-1][16],fakedata[-1][17],fakedata[-1][18],fakedata[-1][19],fakedata[-1][20],fakedata[-1][21],fakedata[-1][22],fakedata[-1][23],fakedata[-1][24],fakedata[-1][25],fakedata[-1][26],fakedata[-1][27],fakedata[-1][28],fakedata[-1][29]]
                        fakedata.append(fakerecord)
                    else:
                        fakedata.append(fakerecord)
            else:
                fakedata.append(fakerecord)
       
       ## Add Split Tranasaction records
        if bln_splittransation:
            if randint(0,10)==1:
                splitindicator = "Y"
                fakerecord= [dictEmployeeId[randemployee][0],dictcardnumber[dictEmployeeId[randemployee][0]][randcardid],temptransactoinid,randomDescription(),"%0.2f" % randomtranamount(loweramount,upperammount,0),'0.00',randomDate(randomtransactiondate(statementdate,'%m/%d/%Y'), statementdate, random.random()),'','',splitindicator,randomDate(randomtransactiondate(statementdate,'%m/%d/%Y'), statementdate, random.random()),'','','','',temp_mcc,temp_company_name,fake.street_address(),'',fake.city(),dictState[fake.state()],fake.postcode(),'','','','','','','',statementdate]
                
                for k in range(0,2):
                    if k == 1:
                        #fakerecord[fakerecord.index(temptransactoinid)] = transactionID+str(i*2+1)
                        fakerecord = [fakedata[-1][0], fakedata[-1][1],transactionID+str(i*2+1),fakedata[-1][3],fakedata[-1][4],fakedata[-1][5],fakedata[-1][6],fakedata[-1][7],fakedata[-1][8],fakedata[-1][9],fakedata[-1][10],fakedata[-1][11],fakedata[-1][12],fakedata[-1][13],fakedata[-1][14],fakedata[-1][15],fakedata[-1][16],fakedata[-1][17],fakedata[-1][18],fakedata[-1][19],fakedata[-1][20],fakedata[-1][21],fakedata[-1][22],fakedata[-1][23],fakedata[-1][24],fakedata[-1][25],fakedata[-1][26],fakedata[-1][27],fakedata[-1][28],fakedata[-1][29]]
                        fakedata.append(fakerecord)
                    else:
                        fakedata.append(fakerecord)
            else:
                splitindicator = ""
                fakerecord= [dictEmployeeId[randemployee][0],dictcardnumber[dictEmployeeId[randemployee][0]][randcardid],temptransactoinid,randomDescription(),"%0.2f" % randomtranamount(loweramount,upperammount,0),'0.00',randomDate(randomtransactiondate(statementdate,'%m/%d/%Y'), statementdate, random.random()),'','',splitindicator,randomDate(randomtransactiondate(statementdate,'%m/%d/%Y'), statementdate, random.random()),'','','','',temp_mcc,temp_company_name,fake.street_address(),'',fake.city(),dictState[fake.state()],fake.postcode(),'','','','','','','',statementdate]
                fakedata.append(fakerecord)
        
        ## Add Even Transactions
        if bln_eventtransaction:
            if randint(0,10)==1:
                fakerecord= [dictEmployeeId[randemployee][0],dictcardnumber[dictEmployeeId[randemployee][0]][randcardid],temptransactoinid,randomDescription(),"%0.2f" % randomtranamount(loweramount,upperammount,eventransaction_factor),'0.00',randomDate(randomtransactiondate(statementdate,'%m/%d/%Y'), statementdate, random.random()),'','',splitindicator,randomDate(randomtransactiondate(statementdate,'%m/%d/%Y'), statementdate, random.random()),'','','','',temp_mcc,temp_company_name,fake.street_address(),'',fake.city(),dictState[fake.state()],fake.postcode(),'','','','','','','',statementdate]
                fakedata.append(fakerecord)
            else:
                fakedata.append(fakerecord)

        ## Add Merchant Keywords
        if bln_merchantkeywords:
            if randint(0,10)==1:
                temp_mcc = random.choice(dictMerchantKeyword.keys())
                if dictMerchantKeyword.has_key(temp_mcc):
                    temp_mcc_company_names = dictMerchantKeyword.get(temp_mcc)
                    mcc_len = len(temp_mcc_company_names)-1
                    randmcc = randint(0,mcc_len)
                    temp_company_name = temp_mcc_company_names[randmcc]
                fakerecord= [dictEmployeeId[randemployee][0],dictcardnumber[dictEmployeeId[randemployee][0]][randcardid],temptransactoinid,randomDescription(),"%0.2f" % randomtranamount(loweramount,upperammount,0),'0.00',randomDate(randomtransactiondate(statementdate,'%m/%d/%Y'), statementdate, random.random()),'','',splitindicator,randomDate(randomtransactiondate(statementdate,'%m/%d/%Y'), statementdate, random.random()),'','','','',temp_mcc,temp_company_name,fake.street_address(),'',fake.city(),dictState[fake.state()],fake.postcode(),'','','','','','','',statementdate]
                fakedata.append(fakerecord)
            else:
                fakedata.append(fakerecord)
    
    
    #print fake.name()
    #print fakedata
    my_list = []
    fieldnames = fakedata[0]
    for values in fakedata[1:]: 
        inner_dict = dict(zip(fieldnames,values))
        my_list.append(inner_dict)

    path = outputfile
    csv_dict_writer(path,fieldnames,my_list)
    
    
    print "####  Finished ####"
