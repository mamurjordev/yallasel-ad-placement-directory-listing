import app from "firebase/app";
import "firebase/firestore";
import "firebase/database";
import "firebase/storage";

// const config =
//     process.env.NODE_ENV === "development"
//         ? JSON.parse(process.env.VUE_APP_FIREBASE_CONFIG)
//         : JSON.parse(process.env.VUE_APP_FIREBASE_CONFIG_PUBLIC);

var firebaseConfig = {
    apiKey: "AIzaSyClnDOuG1yzPkeDJg50irVejc-Yq6R27kc",
    authDomain: "yallasell-7c490.firebaseapp.com",
    projectId: "yallasell-7c490",
    storageBucket: "yallasell-7c490.appspot.com",
    messagingSenderId: "1053403796116",
    appId: "1:1053403796116:web:c483c12429d80179b09a81",
    measurementId: "G-S0WNG1G8QV"
};

app.initializeApp(firebaseConfig);

export const firebase = app;
export const db = app.firestore();
export const storageRef = app.storage().ref();

export const usersRef = db.collection("users");
export const roomsRef = db.collection("chatRooms");
export const messagesRef = roomId =>
    roomsRef.doc(roomId).collection("messages");

export const filesRef = storageRef.child("files");

export const dbTimestamp = firebase.firestore.FieldValue.serverTimestamp();
export const deleteDbField = firebase.firestore.FieldValue.delete();
