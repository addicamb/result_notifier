"""Result Notification on Discord Server"""

import pandas as pd
from discord_webhook import DiscordWebhook
import requests
from os import path, remove, getpid
import PyPDF2
import time
import mysql.connector

# extract specific college results
def trim_pdf(college):

    with open('res.pdf', 'rb') as pdfFileObj:

        pdfReader = PyPDF2.PdfFileReader(pdfFileObj)
        pdfWriter = PyPDF2.PdfFileWriter()

        n = pdfReader.numPages    # no. of pages in original pdf file
        #trim_pagenos = []

        for i in range(n):

            #print(i,end=' ')

            pageObj = pdfReader.getPage(i)   # get i'th page
            text=(pageObj.extractText())     # extract text of i'th page
            text=text.partition(",")

            if college in text[0].replace('\n',''):          # 1st page containing college name found

                while college in text[0].replace('\n',''):   # keep extracting till last page containing college name is found

                    #print('('+str(i)+')',end=" ")
                    #trim_pagenos.append(i)

                    pdfWriter.addPage(pageObj)               # temporarily store exracted pages
                    i += 1                                   # go to next page

                    pageObj = pdfReader.getPage(i)
                    text=(pageObj.extractText())
                    text=text.partition(",")

            else:
                continue

            break                                          #all pages for given college extracted so no need to search full pdf

        with open('res_trim.pdf', 'wb') as f:              # create new pdf file
            pdfWriter.write(f)                             # add extracted pages

        with open('res_trim.pdf', 'rb') as f:
            webhook_file.add_file(file=f.read(), filename='{0} {1}.pdf'.format(program_code, college))  # upload file to discord server(8MB Upload limit)
            webhook_file.execute()

    #print('success')

    #time.sleep(20)
    if path.exists('res.pdf'):
        remove("res.pdf")
        remove("res_trim.pdf")

#check if results are out
def check(program_code, semester, college, period):

    tables = pd.read_html("http://mumresults.in")    # read raw html of mu results page

    if period[0] == 'F':
        results = tables[0]                          # extract 1st table (tag) found (even semester results)
    elif period[0] == 'S':
        results = tables[1]                          # extract 2nd table (tag) found (odd semester results)

    results.columns = ['srno','prog_code','exam','date']
    results = results.iloc[::-1]                     # reverse table to display latest results first

    if results.loc[results.prog_code == program_code].empty: # check if specific branch results are out
        #print("keep checkin")
        pass

    else:
        #print("results are out")
        webhook_msg.execute()

        # mydel = mydb.cursor(buffered = True)
        # mydel.execute('delete from query where id = {0}'.format(x[0]))   #remove query from db
        # mydb.commit()

        url = f'http://mumresults.in/{period}/{program_code}.pdf'
        r = requests.get(url, allow_redirects=True)   # get the results pdf file

        with open('res.pdf', 'wb') as f:                    # save results file to local storage
            f.write(r.content)

        if college:
            trim_pdf(college)                     # trim the pdf for specific college results only
        else:
            with open("res.pdf", "rb") as f:
                webhook_file.add_file(file=f.read(), filename='{0}.pdf'.format(program_code))
                webhook_file.execute()
        if path.exists('res.pdf'):
            remove("res.pdf")

print(getpid(), time.asctime( time.localtime(time.time()) ))

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="results"
)

mycursor = mydb.cursor(buffered = True)
mycursor.execute('select * from query')

for x in mycursor:

    program_code = x[1]
    semester = x[2]
    college = x[3]
    webhook_url = x[4]
    period = x[5]

    webhook_msg = DiscordWebhook(url = webhook_url, content = '{0} {1} Results are out. Check mumresults.in'.format(college, program_code))
    webhook_file = DiscordWebhook(url = webhook_url, content = 'I downloaded the results of {0}, here you go'.format(college))

    check(program_code, semester, college, period)

print(getpid(), time.asctime( time.localtime(time.time()) ))
# nightwalkers (test sv)- https://discord.com/api/webhooks/815125218711961611/jAS1FGUtHXGsNkb1ugesicDxM6atXygDnqyi05K339vnLS5UkgHR-eibh-ZI5VYvhNEe
