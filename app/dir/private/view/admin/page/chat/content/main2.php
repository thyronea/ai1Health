<div class="row"> <!-- style="animation: appear 4s ease" -->
    <div id="chat_header">
        <h5>DLi Chat</h5>
    </div>
    <!--User Profile-->
    <div class="col-md-2" id="user_profile">
        <?php include('process/user-profile.php');?>
    </div>
    <!--User List-->
    <div class="col-md-3" id='user_list'>
        <?php include('process/user-list.php');?>
        <?php include('process/user-data.php');?>
    </div>
    <!-- Chat Box-->
    <div class="col" id="chat_box">
        <?php include('content/chat-box.php');?>
    </div>
</div>
