<h1>Welcome Home!</h1>
<h6><?php echo md5('qwerty')?><h6> 
<h5><?php echo '<pre>';
    print_r($this->session->all_userdata());
    exit; ?></h5>