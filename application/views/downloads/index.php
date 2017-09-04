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
                <div class="doc-list-view">
                    <ul class="list">
                        <?php foreach($result as $data){?>
                        <li class="caption">
                            <div class="row-w-limit">
                                <a href="<?php echo $path.$data['files_filename'];?>" class="doc-title"><?php echo $data['files_title']?></a>
                            </div>
                        </li>
                        <?php }?>
                    </ul>
                </div>
                <?php echo $this->pagination->create_links();?>
            </div>
        </main>
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
</body>
</html>