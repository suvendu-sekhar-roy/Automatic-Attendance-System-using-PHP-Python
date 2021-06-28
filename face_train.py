
import cv2
import face_recognition as fr
import os
import pickle
#Create a list, which can get the images from our folder aumatically

path= "../Automatic-Attendance-System-using-PHP-Python/uploads"  #set my path
images=[]
face_names=[]
myList=os.listdir(path) #Crab the list of images in this folder

print(myList)

for i in myList:
    curImg=cv2.imread(f"{path}\\{i}") #Collecting all the images from given path one by one
    images.append(curImg)
    face_names.append(os.path.splitext(i)[0])    #Seperating the extensions of the image files and only get the names 

print(face_names)

#We have to encode all the known person images
# Define a function which will compute all the encodings

def findEncodings(images): 
    encodeList=[]  #List which will contain all the images
    
    #Create database of all known face encodings
    for img in images:
        img=cv2.cvtColor(img,cv2.COLOR_BGR2RGB) #Image converted to RGB from BGR
        encode=fr.face_encodings(img)[0] #Encode the image
        encodeList.append(encode)  
    return encodeList

known_face_encoding = findEncodings(images)
print(f"Successfully encoded {len(known_face_encoding)} images")
filename="trained_data"
pickle.dump (known_face_encoding,open(filename,'wb'))
