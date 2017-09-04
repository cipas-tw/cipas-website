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
                <div class="doc-list-view">
                    <ul class="list">
                        <?php
                        foreach( $result as $val ){
                        ?>
                        <li class="caption">
                            <div class="row-w-limit">
                                <a href="/<?php echo $this->router->fetch_class() ?>/<?php echo $val['policy_id'];?>" class="doc-title"><?php echo $val['policy_title'];?></a>
                                <div class="desc"><?php echo strip_tags(mb_substr($val['policy_content'], 0, 70, 'UTF-8'));?></div>
                            </div>
                        </li>
                        <?php
                        }
                        ?>
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
