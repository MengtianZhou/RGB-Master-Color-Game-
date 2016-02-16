<script type="text/javascript">
		    var image1=new Image();
		    image1.src="http://cs-server.usc.edu:12123/CodeIgniter/img/1/0005.jpg";
		    var image2=new Image();
		    image2.src="http://cs-server.usc.edu:12123/CodeIgniter/img/2/0004.jpg";
		    var image3=new Image();
		    image3.src="http://cs-server.usc.edu:12123/CodeIgniter/img/3/0005.jpg";
		    var image4=new Image();
		    image4.src="http://cs-server.usc.edu:12123/CodeIgniter/img/4/0006.jpg";
		    var image5=new Image();
		    image5.src="http://cs-server.usc.edu:12123/CodeIgniter/img/5/0004.jpg";
		    var image6=new Image();
		    image6.src="http://cs-server.usc.edu:12123/CodeIgniter/img/6/0005.jpg";
		    var image7=new Image();
		    image7.src="http://cs-server.usc.edu:12123/CodeIgniter/img/7/0002.jpg";
</script>
<script type="text/javascript">
		    var step=1;
		    var whichimage=1;
		    function slideit(){
			    if (!document.images)
			    return
			    document.images.slide.src=eval("image"+step+".src");
			    whichimage=step;
			    if (step<7)
			    step++;
			    else
			    step=1;
			    setTimeout("slideit()",1000);
		    }

		    slideit();

		    function slidelink(){
			    if (whichimage==1)
			    window.location="http://cs-server.usc.edu:12123/CodeIgniter/index.php/product_detail/show_product_by_id/5";
			    else if (whichimage==2)
			    window.location="http://cs-server.usc.edu:12123/CodeIgniter/index.php/product_detail/show_product_by_id/12";
			    else if (whichimage==3)
			    window.location="http://cs-server.usc.edu:12123/CodeIgniter/index.php/product_detail/show_product_by_id/19";
				else if (whichimage==4)
				window.location="http://cs-server.usc.edu:12123/CodeIgniter/index.php/product_detail/show_product_by_id/27";
				else if (whichimage==5)
				window.location="http://cs-server.usc.edu:12123/CodeIgniter/index.php/product_detail/show_product_by_id/31";
				else if (whichimage==6)
				window.location="http://cs-server.usc.edu:12123/CodeIgniter/index.php/product_detail/show_product_by_id/45";
				else if (whichimage==7)
				window.location="http://cs-server.usc.edu:12123/CodeIgniter/index.php/product_detail/show_product_by_id/48";
		    }
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/home.css">
<div class="home">
	<a href="javascript:slidelink()">
	<img class="slideshow" src="<?php echo base_url();?>img/1/0005.jpg" name="slide"/></a>
</div>