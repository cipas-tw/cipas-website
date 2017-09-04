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
                <!-- 執掌與組織 -->
                <div class="about-org">
                    <div class="row">
                        <div class="col-xxs-12 col-xs-9 col-sm-6 m-b-6">
                            <div class="sub-header">執掌</div>
                            <div class="article"><?php echo $result['about_responsibility_descriptionl'] ?></div>
                        </div>
                        <div class="col-xxs-12 col-sm-6">
                            <div class="sub-header">組織</div>
                            <div class="article">
                                <p><?php echo $result['about_organization_descriptionl'] ?></p>
                                <p class="img-cipas-org"><img src="<?php echo $filePath.$result['about_name']?>" class="img-responsive" alt="不當黨產處理委員會組織架構"></p>
                                <?php foreach($resultFile as $file){?>
                                    <p><a href="<?php echo $filePath.$file['about_file_name']?>">不當黨產處理委員會編組表</a></p>
                                <?php }?>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end/ 執掌與組織 -->
            </div>
        </main>
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
</body>
</html>
