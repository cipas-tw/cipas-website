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
                <div class="page-header"><?php echo $title?></div>
                <!-- 最新消息 -->
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
                                <p><iframe frameborder="0" height="198" src="<?php echo $data['video_url'] ;?>" width="293" allowfullscreen></iframe></p>
                            </div>
                            <div class="caption">
                                <a href="/<?php echo $this->router->fetch_class() ?>/<?php echo $data['video_id']?>" class="doc-title"><?php echo $data['video_title']?></a>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <!-- end/ 最新消息 -->
                <?php echo $this->pagination->create_links();?>
            </div>
        </main>
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
</body>
</html>
