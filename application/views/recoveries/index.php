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
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">回復權利說明</a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">已回復權利</a>
                    </li>
                </ul>
                <div class="tab-content">
                	<div class="tab-pane active" id="tab1">
                        <div class="article row-w-limit">
                            <h1><?php echo $resultRepossessList['repo_list_title']?></h1>
                            <?php echo stripslashes($resultRepossessList['repo_list_content'])?>
                        </div>
                    </div>
                    <?php /*?><div class="tab-pane active" id="tab1">
                        <div class="act-detail">
                            <div class="act-history">
                                <div class="sub-header"><strong>法規沿革</strong></div>
                                <ol class="row-w-limit-lg">
                                    <?php echo nl2br($resultRepossessList['repo_list_content']);?>
                                </ol>
                            </div>
                            <!-- 法規內容 -->
                            <div class="article act-article row-w-limit-lg">
                                <div class="sub-header"><strong>法規內容</strong></div>
                                <?php
                                $title = '';
                                foreach( $resultRepossessListChapterAndTermsList as $k => $val ){
                                    $titleTF = $title != $val['repo_list_chapter_title'] ? true : false;
                                    $title = $val['repo_list_chapter_title'];
                                    if( $titleTF ){
                                ?>
                                <strong class="chp"><?php echo $title;?></strong>
                                <?php
                                    }
                                ?>
                                <div class="rule">
                                    <div  class="num"><span class="pill">第 <?php echo $k+1;?> 條</span></div>
                                    <div class="text"><?php echo nl2br($val['repo_list_terms_content']);?></div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            <!-- end/ 法規內容 -->
                        </div>
                    </div><?php */?>
                    <div class="tab-pane" id="tab2">
                        <div class="doc-list-view">
                            <ul class="list">
                                <?php
                                foreach( $result as $val ){
                                ?>
                                <li class="caption">
                                    <div class="row-w-limit">
                                        <a href="/<?php echo $this->router->fetch_class() ?>/<?php echo $val['repo_id'];?>" class="doc-title"><?php echo $val['repo_title'];?><small class="date"><?php echo date('Y/m/d', strtotime($val['repo_show_date']))?></small></a>
                                    </div>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
</body>
</html>
