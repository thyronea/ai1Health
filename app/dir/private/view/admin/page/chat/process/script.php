<script>
  $(document).ready(function () {
    $('.chatbtn').on('click', function() {

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#chat_userID').val(data[0]);
      $('#chat_userID2').val(data[0]);
      $('#chat_engineID').val(data[1]);
      $('#chat_groupID').val(data[2]);
      $('#chat_name').val(data[3]);
      $('#chat_email').val(data[4]);
      $('#chat_role').val(data[5]);
      $('#chat_box').val(data[6]);
    });
  });
</script>

<script>

  var CURRENT_CHAT_USER = "";
  
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
        var message_holder = _("message_holder");
        message_holder.innerHTML = obj.messages;
        break;

      case "chat":
        var inner_left_panel = _("inner_left_panel");
        inner_left_panel.innerHTML = obj.user;
        inner_right_panel.innerHTML = obj.messages;

        var message_holder = _("message_holder");
        
        setTimeout(function(){
          message_holder.scrollTo(0, message_holder.scrollHeight);
          var message_text = _("message_text");
          message_text.focus(); 
        }, 100);
        
        break;  

      case "settings":
        var inner_left_panel = _("inner_left_panel");
        inner_left_panel.innerHTML = obj.message;
        inner_right_panel.style.overflow = "hidden";
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
  // Retrieves Settings
  function get_settings(e){
    get_data({}, "settings");
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
  }

  // Check server for messages every 5 seconds
  setInterval(function(){
    if(CURRENT_CHAT_USER != ""){
      get_data({userid:CURRENT_CHAT_USER}, "chat_refresh");
    } 
  },5000);

  // Label - Chat; Event Listener 
  var label_chat = _("label_chat");
  label_chat.addEventListener("click", get_chat);

  // Label - Contacts; Event Listener 
  var label_contacts = _("label_contacts");
  label_contacts.addEventListener("click", get_contacts);

  // Label - Settings; Event Listener 
  var label_settings = _("label_settings");
  label_settings.addEventListener("click", get_settings);

</script>