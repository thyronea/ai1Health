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
    height: auto;
    min-height: 10%;
    width: auto;
    min-width: 60%;
    max-width: 70%;
    margin: 10px;
    padding: 2px;
    padding-right: 8px;
    float: left;
    background-color: #eee;
    color: #444;
    box-shadow: 0px 0px 10px #aaa;
    border-radius: 10px;
    position: relative;
  }
  #message_left img{
    width: 55px;
    height: 55px;
    margin: 5px;
    float: left;
    border: solid thin white;
    border-radius: 50%;
  }
  #message_left div{
    width: 15px;
    height: 15px;
    border-radius: 50%;
    position: absolute;
    left: 45px;
    top: 47px;
  }
  #message_left div i{
    position: absolute;
    left: 0.5px;
    top: -1.5px;
  }
  #message_left span{
    font-size: 11px;
    color: #999;
  }
  #message_right{
    height: auto;
    min-height: 10%;
    width: auto;
    min-width: 60%;
    max-width: 70%;
    margin: 10px;
    padding: 2px;
    padding-left: 8px;
    float: right;
    background-color: #eee;
    color: #444;
    box-shadow: 0px 0px 10px #aaa;
    border-radius: 10px;
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
    border-radius: 50%;
    position: absolute;
    right: 45px;
    top: 47px;
  }
  #message_right div i{
    position: absolute;
    right: 0.5px;
    top: -1.5px;
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