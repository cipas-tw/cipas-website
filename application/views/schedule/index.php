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
                                <a href="/<?php echo $this->router->fetch_class() ?>/<?php echo $data[$abrv.'id']?>"><img src="<?php echo (isset($data[$abrv.'filename'])  && $data[$abrv.'filename'] != "" )? $imgPath.$data[$abrv.'filename'] : $defultImgCipas?>" alt="<?php echo $data[$abrv.'title']?>"></a>
                            </div>
                            <div class="caption vertical-center">
                                <a href="/<?php echo $this->router->fetch_class() ?>/<?php echo $data[$abrv.'id']?>" class="doc-title"><?php echo $data[$abrv.'title']?></a>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <!-- end/ 調查進度 -->
                <?php echo $this->pagination->create_links();?>
            </div>
        </main>
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
</body>
</html>
