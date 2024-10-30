<style>
  #immunization::-webkit-scrollbar{
    width: 0;
    height: 0;
  }
  #admin_card:hover{
    background-color: #8fafff;
    transition: all 1s ease;
  }
  #iz_sidebar:hover{
    background-color: #8fafff;
    transition: all 1s ease;
  }
  #submit_btn:hover{
    background-color: #8fafff;
    transition: all 1s ease;
  }
  #iz-record:hover{
    background-color: #8fafff;
    transition: all 2s ease;
  }
  @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
    #btn_schedule{
        width: 90px;
        height: 31px;
    }
    #btn_overdue{
        width: 90px;
        height: 31px;
        background: linear-gradient(-90deg, #ff3721, #fcd553, #f7c940, #fa8d11);
        color: #fff;
        background-size: 400% 400%;
        animation: gradient 8s ease infinite;
    }
    #btn_complete{
        width: 90px;
        height: 31px;
        background: linear-gradient(45deg, #886aa6, #6e7efa, #23a6d5, #55c9c0, #55c997, #368041, #036311);
        color: #fff;
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
    }
    #btn_progress{
        width: 90px;
        height: 31px;
    }
    .btn:hover{
    background-color: #8fafff;
    color: white;
    transition: all 1s ease;
  }
</style>