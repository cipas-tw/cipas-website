    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo HEAD_TITLE.(isset($title)? '-'.$title : '');?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="<?php echo isset($metaDescription)? $metaDescription : $this->config->item('metaDescription');?>">
    <!--share-->
	<meta property="fb:app_id" content="">
	<meta property="og:title" content="<?php echo (isset($title)? $title.'-' : '').HEAD_TITLE;?>">
	<meta property="og:site_name" content="<?php echo HEAD_TITLE;?>">
	<meta property="og:description" content="<?php echo isset($metaDescription)? $metaDescription : $this->config->item('metaDescription');?>">
	<meta property="og:url" content="<?php echo isset($metaUrl)? $metaUrl : $this->config->item('metaUrl');?>">
	<meta property="og:image" content="<?php echo isset($metaImg)? $metaImg : $this->config->item('metaImg');?>">
	
	<?php if($this->uri->segment(2)){ ?>
    	 <meta property="og:type" content="article">
	<?php }else{?>
    	 <meta property="og:type" content="website">
    <?php }?>
   
	
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo (isset($title)? $title.'-' : '').HEAD_TITLE;?>">
	<meta name="twitter:description" content="<?php echo isset($metaDescription)? $metaDescription : $this->config->item('metaDescription');?>">
	<meta name="twitter:image" content="<?php echo isset($metaImg)? $metaImg : $this->config->item('metaImg');?>">
	<meta name="twitter:url" content="<?php echo isset($metaUrl)? $metaUrl : $this->config->item('metaUrl');?>">
	<link rel="canonical" href="<?=$this->config->item('canonical')?>" />
    <link rel="icon" type="image/png" href="/public/images/favicon.png">
    <link rel="stylesheet" media="all" href="/public/styles/main.css">
    <link rel="stylesheet" media="all" href="/public/styles/plugins/fotorama/fotorama.css">
	
    <script>

	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	 

	  ga('create', 'UA-83456051-3', 'auto');

	  ga('send', 'pageview');

	 

	</script>