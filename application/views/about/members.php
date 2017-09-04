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
                <!-- 本會委員 -->
                <div class="about-member">
                    <!-- 主任委員 -->
                    <div class="mb-hairman">
                        <div class="sub-header">主任委員</div>
                        <div class="media">
                            <div class="media-left">
                                <div class="pos-rel">
                                    <div class="mb-name"><?php echo $resultLeader['commissioner_name'];?></div>
                                </div>
                                <img src="<?php echo $commissionerPath.$resultLeader['commissioner_filename'];?>" class="mb-pic" alt="<?php echo $resultLeader['commissioner_name'];?>">
                            </div>
                            <div class="media-body">
                                <div class="row">
                                    <div class="col-left">
                                        <div class="mb-label">學歷</div>
                                        <ul class="mb-exp">
                                        <?php
                                        $commissionerEducation = json_decode($resultLeader['commissioner_education'], true);
                                        foreach( $commissionerEducation as $val ){
                                        ?>
                                            <li><?php echo $val;?></li>
                                        <?php
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                    <div class="col-right">
                                        <div class="mb-label">經歷</div>
                                        <ul class="mb-exp">
                                            <?php
                                            $commissionerExperience = json_decode($resultLeader['commissioner_experience'], true);
                                            foreach( $commissionerExperience as $val ){
                                            ?>
                                                <li><?php echo $val;?></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 主任委員 -->
                    <!-- 委員名單 -->
                    <div class="mb-list">
                        <div class="sub-header">委員名單</div>
                        <?php
                        foreach( $result as $k => $val ){
                        ?>
                        <div class="media">
                            <div class="media-left">
                                <div class="mb-title"></div>
                                <div class="mb-name"><?php echo $val['commissioner_name'];?></div>
                            </div>
                            <div class="media-body">
                                <div class="mb-label">經歷</div>
                                <ul class="mb-exp">
                                    <?php
                                    $commissionerExperience = json_decode($val['commissioner_experience'], true);
                                    foreach( $commissionerExperience as $va ){
                                    ?>
                                        <li><?php echo $va;?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- end/ 委員名單 -->
                </div>
                <!-- end/ 本會委員 -->
            </div>
        </main>
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
</body>
</html>
