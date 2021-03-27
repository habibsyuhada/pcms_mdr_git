<!-- <script>
  var conn;
  <?php
    $websocket_server = "10.5.252.116";
  ?>
  $(document).ready(function(){
    conn = new WebSocket('wss://<?php echo $websocket_server ?>:8080/');//Websocket
    conn.onopen = function(e) {
      console.log("Connection established!");
      sendMsg({
        event:'connect', 
        id_user: <?php echo (isset($this->user_cookie[0]) ? $this->user_cookie[0] : explode(";",$this->input->cookie('portal_user'))[0] ) ?>,
        name: "<?php echo (isset($this->user_cookie[1]) ? $this->user_cookie[1] : explode(";",$this->input->cookie('portal_user'))[1] ) ?>",
        project: <?php echo (isset($this->user_cookie[10]) ? $this->user_cookie[10]  : explode(";",$this->input->cookie('portal_user'))[10] ) ?>,
        department: <?php echo (isset($this->user_cookie[4]) ? $this->user_cookie[4] : explode(";",$this->input->cookie('portal_user'))[4] ) ?>,
        browser: "<?php echo $this->agent->browser(); ?>",
        ip_address: "<?php echo $_SERVER['REMOTE_ADDR']; ?>",
        module: "E",
      });
      if(typeof init_signal_ws === "function"){
        init_signal_ws();
      }
    };
    conn.onmessage = function(e) {
      var data = JSON.parse(e.data);
      if(data.event == 'getclientperip') {
        if(typeof eventgetclientperip === "function"){
          eventgetclientperip(data);
        }
        else{
          console.log(data);
        }
      }
      else if(data.event == 'forcelogout'){
        if(typeof eventforcelogout === "function"){
          eventforcelogout(data);
        }
      }
    };
  });

  function sendMsg(obj){
    conn.send(JSON.stringify(obj));
    console.log(obj);
  }

  function eventforcelogout(obj) {
    window.location = "http://10.5.252.108/pcms/public_smoe/logout/"+obj.login_status+"?notif="+obj.msg;
  }
</script> -->