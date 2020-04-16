
var firebaseConfig = {
    apiKey: "AIzaSyBxCC_HYQHUx0Gbh9_kkE2ZJCwogMdytno",
    authDomain: "rnfcmmm.firebaseapp.com",
    databaseURL: "https://rnfcmmm.firebaseio.com",
    projectId: "rnfcmmm",
    storageBucket: "rnfcmmm.appspot.com",
    messagingSenderId: "730247824408",
    appId: "1:730247824408:web:27de4bb67edff96acfef6d",
    measurementId: "G-QGNEMEDZMH"
  };
  // Initialize Firebase
  
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
  const messaging = firebase.messaging();
  
  messaging.requestPermission()
  .then(function() {
      console.log('Have premission');
      return messaging.getToken();
  })
  .then(function(token) {
  console.log(token)
  })
  .catch(function(err) {
      console.log(err);
  })

  messaging.onMessage(function(payload) {
  console.log('onMessage: ', payload);
  });

  //e6BH01aDnd9RF-A_ZssQ3F:APA91bH5dR4CxGNPpJVtQpa7oK_Jcf-E3-6ptmPVrpyU7eUL3IMXJmHM-xDIEG__cn-yDsiHDySUo67QiypuEpzhB-nLpCCJbcfUmPGttRhpdfiRjNA_LD5n3M-31po08P-22PTTpJXH