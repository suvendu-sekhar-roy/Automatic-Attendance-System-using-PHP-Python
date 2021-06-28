import cv2
import face_recognition as fr
import os
from datetime import *
import mysql.connector
from mysql.connector import Error
import pickle

file_name= 'trained_data'
known_face_encoding=pickle.load(open(file_name,'rb'))

#pred_result= loaded_model.predict([[]])
#Create a list, which can get the images from our folder aumatically

path= "../Automatic-Attendance-System-using-PHP-Python/uploads"  #set my path
#images=[]
face_names=[]
myList=os.listdir(path) #Crab the list of images in this folder

print(myList)

for i in myList:
    #curImg=cv2.imread(f"{path}\\{i}") #Collecting all the images from given path one by one
    #images.append(curImg)
    face_names.append(os.path.splitext(i)[0])    #Seperating the extensions of the image files and only get the names 

print(face_names)


def markAttendance(name):
    now=datetime.now()
    a=now.strftime("%d-%m-%Y %H:%M:%S")
    x=a.split()
    date=x[0]
    time=x[1]
    print(type(date))
    print(type(time))
    try:
        connection = mysql.connector.connect(host='localhost',
                                             database='attendance',
                                             user='root',
                                             password='')
        print("Connection successful")
        
        cursor = connection.cursor()
        cursor.execute("INSERT INTO record (Roll, Date, Time) VALUES (%s, %s, %s)",(name, date, time))
        connection.commit()
        print(cursor.rowcount, "Record inserted successfully into table")
        cursor.close()
    except Error as e:
        print("Error occured",e)
    finally:
        if (connection.is_connected()):
            connection.close()
            print("MySQL connection is closed")


    

#known_face_encoding = findEncodings(images)
#print(f"Successfully encoded {len(known_face_encoding)} images")


#Image collected from webcam 

cap=cv2.VideoCapture(0) #Initialize a webcam

while True:
    success, img=cap.read() #Read the image frame by frame from the video
    
    if success is True:     
        imgTest=cv2.cvtColor(img,cv2.COLOR_BGR2RGB)
    else:
        continue
        
    face_location=fr.face_locations(imgTest)
    face_encode=fr.face_encodings(imgTest,face_location)


    for (top, right, bottom, left), face_encoding in zip(face_location,face_encode):
        matches=fr.compare_faces(known_face_encoding, face_encoding,tolerance=0.6)
        print(matches)
        name="Unknown"

        if True in matches:
            first_match_index =  matches.index(True)
            name=face_names[first_match_index]
            cv2.rectangle(img,(left,top),(right,bottom),(0,255,0),2)
            cv2.putText(img,name,(left+6, bottom+10),cv2.FONT_HERSHEY_COMPLEX,0.5,(255,255,255),2)

            name=int(name)
            markAttendance(name)
        else:
            cv2.rectangle(img,(left,top),(right,bottom),(0,0,255),2)
            cv2.putText(img,name,(left+6, bottom+10),cv2.FONT_HERSHEY_COMPLEX,0.5,(255,255,255),2)

    cv2.imshow("Webcam",img)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break
cap.release()
cv2.destroyAllWindows()
