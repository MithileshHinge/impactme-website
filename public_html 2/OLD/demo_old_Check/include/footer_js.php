    <script type="text/javascript" src="<?=BASEPATH?>/js/raphael-min.js"></script>
    <script type="text/javascript" src="<?=BASEPATH?>/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?=BASEPATH?>/js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="<?=BASEPATH?>/js/jquery.touchwipe.min.js"></script>
	<script type="text/javascript" src="<?=BASEPATH?>/js/md_slider.min.js"></script>
	<script type="text/javascript" src="<?=BASEPATH?>/js/jquery.sidr.min.js"></script>
    <!-- <script type="text/javascript" src="js/jquery.tweet.min.js"></script> -->
    <script type="text/javascript" src="<?=BASEPATH?>/js/pie.js"></script>
    <script type="text/javascript" src="<?=BASEPATH?>/js/script.js"></script>
    
    <script>
	function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
cntfield.value = maxlimit - field.value.length;
}
	</script>