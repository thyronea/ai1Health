<script>

  var msg_send = new Audio("../../../audio/msg_send.mp3");
  var msg_received = new Audio("../../../audio/msg_received.mp3");
  var CURRENT_CHAT_USER = "";
  var SEEN_STATUS = false;
  
  // Get Element By ID
  function _(element){
    return document.getElementById(element);
  }

  // Find data type in the database
  function get_data(find, type){
    var xml = new XMLHttpRequest();
    xml.onload = function(){
      if(xml.readyState == 4 || xml.status == 200){
        handle_result(xml.responseText, type);
      }
    }
    var data = {};
    data.find = find;
    data.data_type = type;
    data = JSON.stringify(data);

    xml.open("POST", "process/api.php", true);
    xml.send(data);
  }

  // Show data type search result
  function handle_result(result, type){ 
    //alert(result);
    var inner_right_panel = _("inner_right_panel");
    inner_right_panel.style.overflow = "visible";

    var obj = JSON.parse(result);

    switch(obj.data_type){
      case "contacts":
        var inner_left_panel = _("inner_left_panel");
        inner_left_panel.innerHTML = obj.message;
        inner_right_panel.style.overflow = "hidden";
        break;
      
      case "chat_refresh":
        SEEN_STATUS = false;
        var message_holder = _("message_holder");
        message_holder.innerHTML = obj.messages;
        if(typeof obj.new_message != 'undefined'){
          if(obj.new_message){
            msg_received.play();
          }
        }
        setTimeout(function(){
          message_holder.scrollTo(0, message_holder.scrollHeight);
          var message_text = _("message_text");
          message_text.focus(); 
        }, 100);
        break;

      case "send_message":
        msg_send.play();
      case "chat":
        SEEN_STATUS = false;
        var inner_left_panel = _("inner_left_panel");
        inner_left_panel.innerHTML = obj.user;
        inner_right_panel.innerHTML = obj.messages;

        var message_holder = _("message_holder");
        
        setTimeout(function(){
          message_holder.scrollTo(0, message_holder.scrollHeight);
          var message_text = _("message_text");
          message_text.focus(); 
        }, 100);
        
        if(typeof obj.new_message != 'undefined'){
          if(obj.new_message){
            msg_received.play();
          }
        }
        break;
    }
  }

  get_data({}, "contacts");
  var radio_contacts = _("radio_contacts");
  radio_contacts.checked = true;

  // Retrieves Contacts
  function get_contacts(e){
    get_data({}, "contacts");
  }

  // Retrieves Chat
  function get_chat(e){
    get_data({}, "chat");
  }

  // Start chat
  function start_chat(e){
    var userid = e.target.getAttribute("userid");
    if(e.target.id == ""){
      userid = e.target.parentNode.getAttribute("userid");
    }
    
    CURRENT_CHAT_USER = userid;

    var radio_chat =_("radio_chat");
    radio_chat.checked = true;
    get_data({userid:CURRENT_CHAT_USER}, "chat");
  }

  // Send Message
  function send_message(e){
    var message_text = _("message_text");
    if(message_text.value.trim() == ""){
      alert("Write something you idiot, tf!")
      return;
    }

    //alert(message_text.value);
    get_data({

      message: message_text.value.trim(),
      userid: CURRENT_CHAT_USER

    }, "send_message");
  }  

  // Send message  when enter key is pressed 
  function enter(e){
    if(e.keyCode == 13){
      send_message(e);
    }
    SEEN_STATUS = true;
  }

  // Set seen status to true
  function set_seen(e){
    SEEN_STATUS = true;
  }

  // Delete message
  function delete_message(e){
    if(confirm("Are you sure about deleting this message?")){
      var msgid = e.target.getAttribute("msgid");
      get_data({
        rowid: msgid
      }, "delete_message");
      get_data({
        userid:CURRENT_CHAT_USER,
        seen: SEEN_STATUS
      }, "chat_refresh");
    }
  }

  // Delete thread
  function delete_thread(e){
    if(confirm("Are you sure about deleting this thread?")){
      get_data({
        userid:CURRENT_CHAT_USER
      }, "delete_thread");
      get_data({
        userid:CURRENT_CHAT_USER,
        seen: SEEN_STATUS
      }, "chat_refresh");
    }
  }

 

  // Check server for messages every 5 seconds
  setInterval(function(){
    var radio_chat = _("radio_chat");
    var radio_contacts = _("radio_contacts");

    if(CURRENT_CHAT_USER != "" && radio_chat.checked){
      get_data({
        userid:CURRENT_CHAT_USER,
        seen: SEEN_STATUS
      }, "chat_refresh");
    }
    if(radio_contacts.checked){
      get_data({}, "contacts");
    }  
  }, 2000);

  // Label - Chat; Event Listener 
  var label_chat = _("label_chat");
  label_chat.addEventListener("click", get_chat);

  // Label - Contacts; Event Listener 
  var label_contacts = _("label_contacts");
  label_contacts.addEventListener("click", get_contacts);

</script>