<style>


/*Time to apply widths for panelSlider to work
Width of image = 640px
total images = 5
so width of hovered image = 640px
width of un-hovered image = 40px - you can set this to anything
so total container width = 640 + 40*4 = 800px;
default width = 800/5 = 160px;
*/

.panelSlider {
	width: 100%; height: 380px;
	overflow: hidden;
	}

/*A small hack to prevent flickering on some browsers*/
.panelSlider ul {
	width: 2000px;
	/*This will give ample space to the last item to move
	instead of falling down/flickering during hovers.*/
}

.panelSlider li {
	position: relative;
	display: block;

	float: left;
	
	
	box-shadow: 0 0 25px 10px rgba(0, 0, 0, 0.5);
	-webkit-box-shadow: 0 0 25px 10px rgba(0, 0, 0, 0.5);
	-moz-box-shadow: 0 0 25px 10px rgba(0, 0, 0, 0.5);
	
	/*Transitions to give animation effect*/
	transition: all 0.9s;
	-webkit-transition: all 0.9s;
	-moz-transition: all 0.9s;
	/*If you hover on the images now you should be able to 
	see the basic panelSlider*/
}

/*Reduce with of un-hovered elements*/

/*Lets apply hover effects now*/
/*The LI hover style should override the UL hover style*/



.panelSlider li img {
	display: block;
	max-width:none;
}

/*Image title styles*/
.image_title {
	background: rgba(0, 0, 0, 0.5);
	position: absolute;
	left: 0; bottom: 0;	
width: 2000px;	

}
.image_title a, .image_title{
	display: block;
	color: #fff;
	text-decoration: none;
	font-size: 16px;
	padding:20px;
}
</style>
  <?php if ($rows): ?>
    <div class="view-content">
      <?php print $rows; ?>
    </div>
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>
