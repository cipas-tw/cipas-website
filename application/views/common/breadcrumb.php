				<ol class="breadcrumb">
                    <li><a href="/">首頁</a></li>
                    <?php if(isset($prevPage)){?>
                    	<li><a href="<?php echo $prevPage['url']?>"><?php echo $prevPage['name']?></a></li>
                    <?php }?>
                    <li class="active"><?php echo $nowPage?></li>
                </ol>