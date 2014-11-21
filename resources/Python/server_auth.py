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

    def getFriends(self, user):
        # query the database
        getCmd = "SELECT UID, BUDDYID FROM BUDDY_LIST where UID = '%s'" %user
        self.cursor= self.query(getCmd)
        getResult = self.cursor.fetchall()

        friends = []

        #if the length is 0, no friends
        if len(getResult) == 0:
            return None
        else:
            for item in getResult:
                #print item[1];
                i = 1
                friends.append(item[i])
                i = i + 2

        return friends



        #return [ ["jbob123", "Jim Bob"], ["fred123", "Freddy Fred"] ]

    def addFriend(self, user, frienduser):
        # add frienduser to user's friends list in database
        addCmd = "INSERT INTO BUDDY_LIST (UID, BUDDYID) VALUES ('%s', '%s')" %(user, frienduser)

        #cmd to find a user and their friend (error checking)
        findCmd = "SELECT UID, BUDDYID FROM BUDDY_LIST where (UID = '%s' AND BUDDYID = '%s')" % (user, frienduser)

        #cmd to make sure that the user passed in is a member
        memberCmd = "SELECT USERNAME FROM Members_Table where USERNAME = '%s'" %user

        #cmd to make sure that the friend passed in is also a member
        buddyCmd = "SELECT USERNAME FROM Members_Table where USERNAME ='%s'" %frienduser

        #find the user in the database
        self.cursor = self.query(memberCmd)
        memberResult = self.cursor.fetchall()

        #find the buddy in the database
        self.cursor = self.query(buddyCmd)
        buddyResult = self.cursor.fetchall()


        #make sure that the buddy exists and is registered
        if len(buddyResult) == 0:
            print "The user '%s' does not have an account." %frienduser
            success = False
            return success

        #check to make sure the user exists and is registered
        if len(memberResult) == 1:

            #query the databse to find both user and frienduser
            self.cursor = self.query(findCmd)
            findResult = self.cursor.fetchall()


            #if the array is longer than 0, the two users are already friends
            if len(findResult) > 0:
                success = False
                return success
            else:
                #add the user and the friend of choice to the table
                self.cursor = self.query(addCmd)
                addResult = self.cursor.fetchall()
                success = True
                return success
        else:
            #the user doesnt exist, therefore cannot add to friendslist
            success = False
            return success

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
