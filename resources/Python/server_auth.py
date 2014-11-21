#!/usr/bin/env python
"""
Data Module
"""
import time
import MySQLdb

#myDB = MySQLdb.connect(host="im.lambdacore.org", port=3306, user="imserver", passwd="imserver3513")
#cursorHandler = myDB.cursor()

#display available dbs
#cursorHandler.execute("SHOW DATABASES")
#results = cursorHandler.fetchall()
#print "Databases\n=============="
#for item in results:
#    print item[0]

#select the correct database
#cursorHandler.execute("SELECT DATABASE()")
#results = cursorHandler.fetchall()
#print"\nCurrent Database\n=============="
#for item in results:
#    print item[0]

#selects the db from the list printed
#cursorHandler.execute("USE imserver")

#display current db
#cursorHandler.execute("SELECT DATABASE()")
#results = cursorHandler.fetchall()
#print"\nThe working database is:\n"
#for item in results:
#    print item[0];

#constructor for the database connection
class Data:
    "Database Access Class"
    def __init__(self, db_address, db_port, db_user, db_password, myDB):
      print "Data class constructor"
      self.DB = MySQLdb.connect(host=db_address, port=db_port, user=db_user, passwd=db_password, db=myDB)
      self.cursor = self.DB.cursor()
      #print "db"

    def connect(self):
        self.DB = MySQLdb.connect()

    def query(self, sql):
        try:
            cursor = self.DB.cursor()
            cursor.execute(sql)
        except (AttributeError, MySQLdb.OperationalError):
            self.connect()
            cursor = self.DB.cursor()
            cursor.execute(sql)
        return cursor

    ##authentication for the user
    def authenticateUser(self, user, password):
        # Get user's password from the database and compare it to the argument
        userCmd = "SELECT  USERNAME FROM Members_Table where USERNAME = '%s'" %user
        pwdCmd = "SELECT PASSWORD FROM Members_Table where PASSWORD = '%s'" %password

        #make an array of all the names that match
        self.cursor.execute(userCmd)
        userResult = self.cursor.fetchall()



        #view the results of user array
        if userResult[0] != 'user':
            for item in userResult:
                print "Username match! The username found was: "
                print item[0]
                accept = True
        else:
            print "Sorry, that username was not found."
            accept = False


        #pwd array
        self.cursor.execute(pwdCmd)
        pwdResult = self.cursor.fetchall()

        #pwdresults
        if pwdResult == 'password':
           print "Password match!"
           accepted = True
        else:
            print "Password was incorrect.\n"
            accepted = False


        #make sure that both username and password is correct
        if accept == True and accepted == True:
            success = True
        else:
            success = False

        #print success
        return success

'''
Test out the class:
'''
if __name__ == "__main__":
    data = Data("im.lambdacore.org", 3306, "imserver", "imserver3513", "imserver")
    #the above line can be modified whenever we get the server for database running


    #print data.getFriends("cameron")
    #print data.getFriends("kyle")
