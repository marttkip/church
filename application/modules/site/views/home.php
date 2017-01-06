<?php
	echo $this->load->view("home/slider", '', TRUE);
	echo $this->load->view("home/about", '', TRUE);
?>
	<!-- Start Body Content -->
  	<div class="main" role="main">
    	<div id="content" class="content full">
        	<div class="container">
			<?php
                echo $this->load->view("home/events", '', TRUE);
                //echo $this->load->view("home/blog", '', TRUE);
                //echo $this->load->view("home/testimonials", '', TRUE);
                //echo $this->load->view("home/specialists", '', TRUE);
                //echo $this->load->view("home/partners", '', TRUE);
            ?>
            </div>
        </div>
    </div>
