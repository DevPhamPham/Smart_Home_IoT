const firebaseConfig = {
    apiKey: "AIzaSyB4LWjQUD3-HP9MCwCeaEwmcJrx2fIudDw",
    authDomain: "jobwokwi.firebaseapp.com",
    databaseURL: "https://jobwokwi-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "jobwokwi",
    storageBucket: "jobwokwi.appspot.com",
    messagingSenderId: "27804988795",
    appId: "1:27804988795:web:0895293bf0266d50c0f9de",
    measurementId: "G-E5Q5LVG6S0"
  };

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();
// Initialize Realtime Database and get a reference to the service
const database = firebase.database();
var value_sensor = document.getElementById('motion').innerText;



//nút bật tắt
document.getElementById('light').onclick = function(e){
    if (this.checked){
        
        database.ref("/").update({
            "batden" : 1
            });
        
    }
    else{
        
        database.ref("/").update({
            "batden" : 0
        });
    }
};
//nút mở cửa
document.getElementById('door').onclick = function(e){
    if (this.checked){
        
        database.ref("/").update({
            "mocua" : 1
            });
        
    }
    else{
        
        database.ref("/").update({
            "mocua" : 0
        });
    }
};
// getData()
// setInterval(function() {
//     getData()
// },5000)

// function getData(){
        //lấy dữ liệu ánh sáng hoặc tối
        database.ref("/day").on("value", function(snapshot){
            var value_light = snapshot.val();
            if(value_light  == 1){
                document.getElementById("body_web").style.background = '#333';
                // $(".card").css("background-color","#333")
                document.getElementById("motion").style.color = '#333';
                document.getElementById("card_sensor_motion").style.background = '#fff';
            }
            else{
                document.getElementById("body_web").style.background = 'white';
            }
        });
        //lấy dữ chuyển động
        database.ref("/pir").on("value", function(snapshot){
            var pir = snapshot.val();
            if(pir == 1){
                document.getElementById('myAudio').play();
                document.getElementById("motion").innerHTML = "Phát hiện có chuyển động";
                document.getElementById("motion").style.color = 'red';
                document.getElementById("body_web").style.background = '#ff5c5c';
            }
            else{
                document.getElementById("motion").innerHTML = "Không phát hiện có chuyển động";
                document.getElementById("motion").style.color = 'green';
                document.getElementById("body_web").style.background = 'white';
                document.getElementById('myAudio').pause();
            }
        });
        //lấy dữ liệu nhiệt độ
        database.ref("/nhietdo").on("value", function(snapshot){
            var temp = snapshot.val();
            document.getElementById("nd").innerHTML = temp;
            document.getElementById("progress_temp").value = temp;
    
        });
        //lấy độ ẩm
        database.ref("/doam").on("value", function(snapshot){
          var humidity = snapshot.val();
          document.getElementById("da").innerHTML = humidity;
          
          document.getElementById("progress_humidity").value = humidity;
       });
       

       //lấy giá trị sáng
       database.ref("/dosang").on("value", function(snapshot){
          var ds = snapshot.val();
          document.getElementById("ds").innerHTML = ds;
          
          document.getElementById("progress_ds").value = ds;
       });
    
// }