<?php include 'config/config.php'; ?>
<?php include 'lib/database.php'; ?>
<?php include 'helpers/format.php'; ?>

<?php 
	$db = new database();
	$fm = new format();

?>
<!DOCTYPE html>
<html>
<head>
	<?php 
		if (isset($_GET['pageid'])) {
			$page_titleid = $_GET['pageid'];

	    $sql = "SELECT * FROM tbl_pages WHERE id= $page_titleid";
        $tbl_pages = $db->select($sql);
        if ($tbl_pages) {
            while ($result = $tbl_pages->fetch_assoc()) { ?>

			<title><?php echo $result['name']; ?>-<?php echo TITLE; ?></title>

		<?php } } }elseif (isset($_GET['id'])) {
			$id = $_GET['id'];

	    $sql = "SELECT * FROM tbl_post WHERE id= '$id'";
        $tbl_post = $db->select($sql);
        if ($tbl_post) {
            while ($result = $tbl_post->fetch_assoc()) { ?>

			<title><?php echo $result['title']; ?>-<?php echo TITLE; ?></title>

		<?php } } }

		else{ ?>
	
		<title><?php echo $fm->title(); ?>-<?php echo TITLE; ?></title>

	<?php	} ?>
		
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
		<?php 
		if (isset($_GET['id'])) {
			$keyword = $_GET['id'];
			$keyword_meta = "SELECT * FROM tbl_post WHERE id= '$keyword'";
        	$meta = $db->select($keyword_meta);
        	if ($meta) {
        		while ($result = $meta->fetch_assoc()) { ?>
        			<meta name="keywords" content="<?php echo $result['tags']; ?>">
      <?php  } } }else{ ?>
   			<meta name="keywords" content="<?php echo KEYWORDS; ?>">
     <?php  } ?>
	

	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		   <?php 
        $sql = "SELECT * FROM title_slogan WHERE id=1";
        $title_slogan = $db->select($sql);
        if ($title_slogan) {
            while ($result = $title_slogan->fetch_assoc()) {
                        
        ?>
		<a href="#">
			<div class="logo">
				<img src="admin/<?php echo $result['image'] ?>" alt="logo">
				<h2><?php echo $result['title']; ?></h2>
				<p><?php echo $result['slogan']; ?></p>
			</div>
		</a>
 	 <?php  } } ?>
		<div class="social clear">
			<div class="icon clear">
			    <?php 
		        $sql = "SELECT * FROM tbl_social WHERE id='1'";
		        $tbl_social = $db->select($sql);
		        if ($tbl_social) {
		            while ($result = $tbl_social->fetch_assoc()) {
		                        
		        ?>
				<a href="<?php echo $result['facebook'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['twitter'];?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['linkedin'];?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['google'];?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				<?php  } } ?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<?php 
		$path = $_SERVER['SCRIPT_FILENAME'];
		$current_page = basename($path, '.php');
    ?>
	<ul>
		<li><a <?php if ($current_page == 'index') {echo "id = 'active'"; } ?> href="index.php">Home</a></li>

        <?php 
        $sql = "SELECT * FROM tbl_pages;";
        $tbl_pages = $db->select($sql);
        if ($tbl_pages) {
            while ($result = $tbl_pages->fetch_assoc()) {
                        
        ?>   
    <li><a 
		<?php 
		if (isset($_GET['pageid']) && $_GET['pageid'] == $result['id']) {
			echo "id = 'active'";
		}
		?>
        href="page.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
		
      <?php } }   ?>
      <li><a <?php if ($current_page == 'contact') {echo "id = 'active'"; } ?> href="contact.php">Contact</a></li>
</ul>
</div>
