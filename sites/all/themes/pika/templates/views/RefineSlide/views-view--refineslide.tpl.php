<style>
.rs-wrap:after,
.rs-slider:after,
.rs-thumb-wrap:after,
.rs-arrows:after,
.rs-caption:after {
    content: ".";
    display: block;
    height: 0;
    clear: both;
    line-height: 0;
    visibility: hidden;
}

/* ===[ Slider ]=== */

.rs-wrap {
    position: relative;
    max-width: 100%;
}
.rs-slider {margin-bottom: 0px; border-bottom: #000 1px solid;}
.rs-slide-bg { *zoom: 1 }

.rs-slider > li > a { display: block }

.rs-slider > li {
    list-style: none;
    filter: alpha(opacity=0);
    opacity: 0;
    width: 100%;
    height: 100%;
    margin: 0 -100% 0 0;
    padding: 0;
    float: left;
    position: relative;
}

    .rs-slider > li > a {
        padding: 0;
        background: none;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
    }

    .rs-slider > li img {
        display: block;
        max-width: 100%;
        max-height: 100%;
					 width: 100%;
			
        -ms-interpolation-mode: bicubic;
    }

/* ===[ Thumbnails ]=== */

.rs-thumb-wrap { *zoom: 1; }

    .rs-thumb-wrap > a {
        display: block;
        float: left;
        position: relative;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-backface-visibility: hidden; /* Hardware accelerate to prevent jumps on transition */
		z-index:100;
    }

        .rs-thumb-wrap > a > img {

            max-width: 100%;
            max-height: 100%;
            display: block;
            -ms-interpolation-mode: bicubic;
        }

.rs-thumb-wrap > a:first-child { margin-left: 0!important }



/* ===[ Captions ]=== */

.rs-caption.rs-bottom {width: 100%!important; bottom: 34.3% !important; 	}

.rscapt{
	-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=0, Direction=135, Color=#757575)" !important;
	text-shadow: 1px 1px 0px #757575 !important;
	filter: progid:DXImageTransform.Microsoft.Shadow(Strength=0, Direction=135, Color=#757575) !important;
}


.rs-caption {
    position: absolute;
    max-height: 100%;
    overflow: auto;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    bottom: 0;
    left: 0;
}

.rs-caption.rs-top-left {
    top: 0;
    bottom: auto;
}

.rs-caption.rs-top-right {
    top: 0;
    right: 0;
    left: auto;
    bottom: auto;
}

.rs-caption.rs-bottom-left {
    bottom: 0;
    left: 0;
}

.rs-caption.rs-bottom-right {
    right: 0;
    left: auto;
    border-bottom: none;
    border-right: none;
}

.rs-caption.rs-top {
    top: 0;
    bottom: auto;
    width: 100%!important;
}

.rs-caption.rs-bottom { width: 100%!important; bottom: 34.3% !important; padding-left:100px; padding-right:100px;	}

.rs-caption.rs-left {
    top: 0;
    height: 100%;
}

.rs-caption.rs-right {
    top: 0;
    left: auto;
    right: 0;
    height: 100%;
}

/* ===[ Grid ]=== */

.rs-grid {
    position: absolute;
    overflow: hidden;
    width: 100%;
    height: 100%;
    display: none;
}

.rs-gridlet {
    position: absolute;
    opacity: 1;
}

/* Optional - remove captions at smaller screen widths
@media screen and (max-width: 480px) {
	.rs-caption { opacity: 0!important; }
}
*/

/* ===[ Captions ]=== */
.rs-caption > h3 a{ color: #fff !important;}
.rs-caption {
    padding: 20px;
    color: #fff;
}

    .rs-caption p {
        color: #fff;
        margin-bottom: 0;
    }

.rs-caption.rs-top-left {
    border-top: none;
    border-left: none;
}

.rs-caption.rs-bottom-right {
    border-bottom: none;
    border-right: none;
}

.rs-caption.rs-top-right {
    border-top: none;
    border-right: none;
}

.rs-caption.rs-bottom-left {

    border-bottom: none;
    border-left: none;
}

.rs-caption.rs-bottom {
    border-bottom: none;
    border-left: none;
    border-right: none;
}

.rs-caption.rs-top {
    border-top: none;
    border-left: none;
    border-right: none;
}

.rs-caption.rs-left {
    border-left: none;
    border-top: none;
    border-bottom: none;
}

.rs-caption.rs-right {
    border-right: none;
    border-top: none;
    border-bottom: none;
}



#images {
    padding-left: 0 !important;
	margin-bottom:-16%;
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
