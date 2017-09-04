<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <?php echo $headHtml;?>
</head>
<body>
    <?php echo $headerHtml;?>
        <!-- main-content -->
        <main class="main-content">
            <!-- 導盲磚 -->
            <div class="container outer-wrap pos-rel">
                <a href="#" class="tactile" title="中央主要內容區塊" accesskey="C">:::</a>
            </div>
            <!-- end/ 導盲磚 -->
            <div class="container outer-wrap">
                <?php echo $breadcrumbHtml;?>
                
                <ul class="nav nav-tabs">
                	<?php foreach($journalsType as $key => $va){ ?>
                    <li class="<?php if($key == 0){echo "active";}?>">
                        <a href="#tab<?=$key?>" data-toggle="tab" id="typeTab<?=$key?>"><?=$va["journal_type_name"]?></a>
                    </li>
                    <?php }?>
                    
                </ul>
                
                <div class="tab-content">
					
                    <?php foreach($journalsType as $key => $va){ ?>
                    <div class="tab-pane <?php if($key == 0){echo "active";}?>" id="tab<?=$key?>">
                        <div class="page-lead row-w-limit">
                            <p class="lead"><?=$va["journal_type_name"]?></p>
                            <p><?=stripslashes($va["journal_type_content"])?></p>
                        </div>

                        <div class="doc-list-view">
                        	<?php foreach($journalsList[$va["journal_type_id"]] as $k => $val){ ?>
                            <ul class="list">
                                <li class="caption">
                                    <div class="row-w-limit">
                                        <a href="/<?php echo $this->router->fetch_class() ?>/<?php echo $val['journal_id']?>" class="doc-title"><?php echo $val['journal_title']?><small class="date"><?php echo $val['journal_show_date']?></small></a>
                                    </div>
                                </li>
                                
                            </ul>
                            <?php }?>
                        </div>

                        <!-- Ppagination -->
                        <?php echo $pagination[$va["journal_type_id"]]->create_links();?>
                        <!-- end/ Ppagination -->
                    </div>
					<?php }?>
                    
                    
                    <?php /*?><div class="tab-pane active" id="tab0">
                        <div class="page-lead row-w-limit">
                            <p class="lead">本會刊物說明文字標題</p>
                            <p>本會刊物說明內文本會刊物說明內文本會刊物說明內文本會刊物說明內文本會刊物說明內文本會刊物說明內文本會刊物說明內文本會刊物說明內文本會刊物說明內文</p>
                        </div>

                        <div class="doc-list-view">
                            <ul class="list">
                                <li class="caption">
                                    <div class="row-w-limit">
                                        <a href="public-journal-detail.html" class="doc-title">本會刊物標題文字本會刊物標題文字本會刊物標題文字<small class="date">2017/01/23</small></a>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>

                        <!-- Ppagination -->
                        <!--分頁-->
                        <!-- end/ Ppagination -->
                    </div>

                    <div class="tab-pane" id="tab1">
                        <div class="page-lead row-w-limit">
                            <p class="lead">授權文獻說明文字標題</p>
                            <p>授權文獻說明內文授權文獻說明內文授權文獻說明內文授權文獻說明內文授權文獻說明內文授權文獻說明內文授權文獻說明內文授權文獻說明內文授權文獻說明內文</p>
                        </div>

                        <div class="doc-list-view">
                            <ul class="list">
                                <li class="caption">
                                    <div class="row-w-limit">
                                        <a href="public-journal-auth-detail.html" class="doc-title">授權文獻標題文字授權文獻標題文字授權文獻標題文字<small class="date">2017/01/23</small></a>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>

                        <!-- Ppagination -->
                        <!--分頁-->
                        <!-- end/ Ppagination -->
                    </div><?php */?>

                </div>
                
                <?php /*?><div class="page-header">期刊文獻</div>
                <!-- 調查進度 -->
                <div class="row doc-gallery-view">
                    <!--
                        ** Note:
                        ** 1.圖片尺寸最大為 W:320px, H:216px
                        ** 2.每則標題最多26個中文字
                    -->
                    <?php foreach($result as $data){?>
                    <div class="col-sm-4">
                        <div class="thumbnail">
                            <div class="img-box">
                                <a href="/<?php echo $this->router->fetch_class() ?>/<?php echo $data['journal_id']?>"><img src="<?php echo (isset($data['journal_filename']) && $data['journal_filename'] != "")? $imgPath.$data['journal_filename'] : $defultImg?>" alt="<?php echo $data['journal_title']?>"></a>
                            </div>
                            <div class="caption">
                                <div class="info-row">
                                    <span class="label label-primary label-category"><?php echo $data['journal_type_name']?></span>
                                    <span class="date"><?php echo $data['journal_show_date']?></span>
                                </div>
                                <a href="/<?php echo $this->router->fetch_class() ?>/<?php echo $data['journal_id']?>" class="doc-title"><?php echo $data['journal_title']?></a>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <!-- end/ 調查進度 -->
                <?php echo $this->pagination->create_links();?><?php */?>
            </div>
        </main>
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
    <script type="text/javascript">
        $(document).ready(function(){
			<?php foreach($journalsType as $key => $va){ ?>
				<?php /*?><?php if($this->input->get('page'.$va["journal_type_id"], true)){?>
			  	$("#typeTab<?=$key?>").click();
				<?php }?><?php */?>
				<?php if($this->input->get("journalTypeId", true) == $va["journal_type_id"]){?>
				$("#typeTab<?=$key?>").click();
				<?php }?>
			<?php }?>
			
        });
    </script>
</body>
</html>