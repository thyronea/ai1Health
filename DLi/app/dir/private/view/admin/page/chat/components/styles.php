<!-- Version 1
<style>

  @keyframes appear {
      0%{opacity: 0;transform: translate(50px);}
      100%{opacity: 1;transform: translate(0px);}
  }
  @keyframes spin {
      0%{opacity: 0;transform: translate(50px) rotate(360deg);}
      100%{opacity: 1;transform: translate(0px) rotate(0deg);}
  }

  @keyframes spinning_deelos {
    0% {opacity:0;}
    50% {opacity:1;}
    100% {opacity:0;}
  }

  #wrapper{
    max-width: 1190px;
    min-height: 570px;
    display: flex;
    margin: auto;
    color: white;
    font-size: 13px;
    text-align: center;
  }
  #left_panel {
    min-height: 540px;
    background-color: #4e5457;
    flex: 1;
  }
  #left_panel label {
    width: 100%;
    height: 30px;
    display: block;
    background-color: #4e5457;
    border: solid thin #9a9fa6;
    cursor: pointer;
    padding: 5px;
    transition: all 1s ease;
  }
  #left_panel label:hover{
    background-color: #a6a3a2;
  }
  #left_panel label i{
    float: right;
    width: 25px;
  }
  #right_panel {
    min-height: 540px;
    background-color: #e8f8fa;
    flex: 4;
  }
  #header{
    background-color: #6c706d;
    height: 40px;
    font-family: sans-serif;
    font-size: 20px;
    text-align: center;
    padding: 5px
  }
  .loader_on{
    position: center;
  }
  .loader_off{
    display: none;
  }
  #container{

  }
  #inner_left{
    min-height: 540px;
    background-color: #a6a3a2;
    flex: 1;
    overflow: auto;
  }
  #contact{
    margin: 15px;
    display: inline-block;
    vertical-align: top;
    text-align: justify;
  }
  #contact_card{
    width: 200px;
    height: 57px;
    background-color: #4e5457;
    color: white;
    overflow: auto;
    transition: all 0.5s ease;
  }
  #contact_card:hover{
    transform: scale(1.1);
    border-style: solid;
    border-color: #7af6ff;
  }
  #contact_info{
    margin: -10px;
    padding-left: 5px;
  }
  #contact_info a{
    text-decoration: none;
    color: #ffffff;
  }
  #contact_info a:hover{
    color: #0370ff;
  }
  #contact img{
    height: 90px;
    width: 90px;
    border: solid thin white;
    border-radius: 50%;
    object-fit: cover;
  }
  #inner_right{
    min-height: 540px;
    background-color: #f5f7f7;
    color: black;
    flex: 3;
    transition: all 1s ease;
  }
  #radio_settings:checked ~ #inner_right{
    flex: 1;
  }
  #chat_box::-webkit-scrollbar{
    width: 0;
    height: 0;
  }
  #outgoing_chat1{
    display: inline-block;
    background-color: #5488ff;
    border-radius: 16px;
    text-align: left;
    padding: 10px;
    margin: 5px;
  }
  #incoming_chat1{
    display: inline-block;
    background-color: #5488ff;
    border-radius: 16px;
    text-align: right;
    padding: 10px;
    margin: 5px;
  }
  .w-400 {
    width: 400px;
  }
  .fs-xs {
    font-size: 1rem;
  }

 </style>
-->

<!-- Version 2
<style>
  #chat_header{
    background-color: #6c706d;
    height: 40px;
    font-family: sans-serif;
    font-size: 20px;
    text-align: center;
    padding: 8px
  }
  #user_profile{
    min-height: 600px;
    background-color: #a6a3a2;
    padding: 10px;
    overflow: auto;
    text-align: center;
  }
  #user_profile_image{
    width: 150px;
    height: 150px;
    border: solid thin white;
    border-radius: 50%;
    margin: 5px;
    object-fit: cover;
  }
  #user_list{
    min-height: 600px;
    background-color: #4e5457;
    padding: 10px;
    overflow: auto;
    list-style: none;
    
  }
  #user_list_image{
    width: 40px;
    height: 40px;
    border: solid thin white;
    border-radius: 50%;
    margin: 5px;
    object-fit: cover;
  }
  #chat_box{
    min-height: 650px;
    background-color: #f5f7f7;
    overflow: auto;
  }
  #chat_box_header{
    padding: 10px;
  }
  #chat_box_user_image{
    width: 70px;
    height: 70px;
    border: solid thin white;
    border-radius: 50%;
    margin: 5px;
    object-fit: cover;
  }
  #main_chat{
    height: 450px;
    overflow: auto;
    font-size: 15px;
  }
  #main_chat::-webkit-scrollbar{
    width: 0;
    height: 0;
  }
  #incoming_chat_timestamp{
    padding-left: 70px;
  }
  #incoming_chat_image{
    width: 40px;
    height: 40px;
    border: solid thin white;
    border-radius: 50%;
    margin: 5px;
    object-fit: cover;
  }
  #incoming_chat{
    max-width: 500px;
    display: inline-block;
    background-color: #5488ff;
    border-radius: 16px;
    text-align: left;
    padding: 10px;
    margin: 5px;
  }
  #outgoing{
    float: right;
  }
  #outgoing_chat_timestamp{
    display: inline-block;
    padding-left: 485px;
  }
  #outgoing_chat_image{
    width: 40px;
    height: 40px;
    border: solid thin white;
    border-radius: 50%;
    margin: 5px;
    object-fit: cover;
  }
  #outgoing_chat{
    max-width: 250px;
    display: inline-block;
    background-color: #5488ff;
    border-radius: 16px;
    text-align: left;
    padding: 10px;
    margin: 5px;
  }
  #chat_box_footer{
    padding: 10px;
    text-align: center;
  }

  </style>
--> 

  <!-- Version 3-->
<style>
  #wrapper{
    max-width: 1000px;
    height: 600px;
    display: flex;
    margin: auto;
    color: white;
    font-size: 14px;
    text-align: center;
  }
  #left_panel{
    min-height: 500px;
    background-color: #27344b;
    text-align: center;
    flex: 1;
  }
  #profile_image{
    width: 65%;
    height: 110px;
    border: solid thin white;
    border-radius: 50%;
    margin: 10px;
  }
  #left_panel label{
    height: 30px;
    display: block;
    background-color: #404b56;
    border: solid thin #ffffff55;
    border-radius: 16px;
    cursor: pointer;
    padding: 5px;
    margin: 5px;
    transition: all 1s ease;
  }
  #left_panel label:hover{
    background-color: #778593;
  }
  #left_panel label img{
    
  }
  #right_panel{
    min-height: 400px;
    flex: 4;
  }
  #header{
    background-color: #485b6c;
    height: 60px;
    font-size: 40px;
    text-align: center;
    font-family: jap;
  }
  #inner_left_panel{
    background-color: #383e48;
    flex: 1;
    min-height: 440px;
    height: 540px;
    text-align: center;
    overflow: auto;
  }
  #contacts{
    width: 150px;
    margin: 10px;
    display: inline-block;
    vertical-align: top;
    overflow: hidden;
    cursor: pointer;
    transition: all .5s cubic-bezier(.78,.11,.42,.85);
  }
  #contacts:hover{
    transform: scale(1.1);
  }
  #contacts img{
    width: 50%;
    height: 75px;
    border: solid thin white;
    border-radius: 50%;
  }
  #active_contact{
    width: auto;
    height: 70px;
    margin: 10px;
    border: solid thin #aaa;
    padding: 5px;
  }
  #active_contact img{
    width: 23%;
    height: 50px;
    margin: 5px;
    float: left;
    border: solid thin white;
    border-radius: 50%;
  }
  #inner_right_panel{
    background-color: #f2f7f8;
    flex: 2;
    min-height: 440px;
    height: 540px;
    transition: all 1s ease; 
  }
  #message_holder::-webkit-scrollbar{
    width: 0;
    height: 0;
  }
  #message_left{
    height: 90px;
    width: 70%;
    min-width: 200px;
    margin: 10px;
    padding: 2px;
    padding-right: 8px;
    float: left;
    background-color: #eee;
    color: #444;
    box-shadow: 0px 0px 10px #aaa;
    border-bottom-left-radius: 50%;
    position: relative;
  }
  #message_left img{
    width: 55px;;
    height: 55px;
    margin: 5px;
    float: left;
    border: solid thin white;
    border-radius: 50%;
  }
  #message_left div{
    width: 15px;
    height: 15px;
    background-color: #08c331;
    border-radius: 50%;
    position: absolute;
    left: 45px;
    top: 47px;
  }
  #message_left span{
    font-size: 11px;
    color: #999;
  }
  #message_right{
    height: 90px;
    width: 70%;
    min-width: 200px;
    margin: 10px;
    padding: 2px;
    padding-left: 8px;
    float: right;
    background-color: #eee;
    color: #444;
    box-shadow: 0px 0px 10px #aaa;
    border-bottom-right-radius: 50%;
    position: relative;
  }
  #message_right img{
    width: 55px;;
    height: 55px;
    margin: 5px;
    float: right;
    border: solid thin white;
    border-radius: 50%;
  }
  #message_right div{
    width: 15px;
    height: 15px;
    background-color: #08c331;
    border-radius: 50%;
    position: absolute;
    right: 45px;
    top: 47px;
  }
  #message_right span{
    font-size: 11px;
    color: #999;
  }
  #radio_contacts:checked ~ #inner_right_panel{
    flex: 0;
  }
  #radio_settings:checked ~ #inner_right_panel{
    flex: 0;
  }
</style>