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
                <div class="row-share">
                    <ul class="share-icons">
                        <li><a href="mailto:?body=<?php echo $head['metaTitle'].'-'.$head['metaUrl']?>" title="轉寄" class="ico-share-mail"><span>轉寄</span></a></li>
                        <li><a href="https://plus.google.com/share?url=<?php echo $head['metaUrl']?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="ico-share-google"><span>google分享(另開視窗)</span></a></li>
                        <li><a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo $head['metaUrl']?>','sharer','toolbar=0,status=0,width=626,height=436');" title="Facebook分享(另開視窗)" class="ico-share-fb"><span>Facebook分享(另開視窗)</span></a></li>
                        <li><a href="#" onclick="window.open('https://twitter.com/share','sharer','toolbar=0,status=0,width=626,height=436');" data-url="<?php echo $head['metaUrl']?>" title="twitter分享(另開視窗)" class="ico-share-twitter"><span>twitter分享(另開視窗)</span></a></li>
                        <li><a href="http://line.naver.jp/R/msg/text/?<?php echo $title.'-'.$head['metaUrl']?>" title="Line分享(另開視窗)" class="ico-share-line"><span>Line分享(另開視窗)</span></a></li>
                        <li class="hidden-xxs"><a href="javascript:printDoc();location.reload();" title="友善列印" class="ico-share-print"><span>友善列印</span></a></li>
                    </ul>
                    <noscript>
                        <small>當JavaScript無法執行時，可按「Ctrl + P」鍵使用列印功能</small>
                    </noscript>
                </div>
                <!-- 文章列印範圍 -->
                <article>
                <div class="print-wrap">
                    <div class="page-header"><?php echo $result['law_title'];?></div>
                    <div class="act-detail">

                        <div class="act-history">
                            <div class="sub-header"><strong>法規沿革</strong></div>
                            <?php echo nl2br($result['law_content']);?>
                        </div>

                        <!-- 法規內容 -->
                        <div class="article act-article row-w-limit-lg">
                            <div class="sub-header"><strong>法規內容</strong></div>
                            <?php
                            $k = 0;
                            foreach($resultList as $data){
                            ?>
                            <strong class="chp"><?php echo $data['chapter_title']?></strong>
                                <?php
                                foreach($data['list'] as $key => $val){
                                    $k++;
                                ?>
                                <?php if(isset($val) && $val != '' ){ ?>
                                    <div class="rule">
                                        <div  class="num"><span class="pill">第 <?php echo isset($data['numbering'][$key]) ? $data['numbering'][$key] : $k ;?> 條</span></div>
                                        <div class="text">
                                            <?php echo nl2br($val)?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <!-- end/ 法規內容 -->
                        <!-- 相關檔案 -->
                        <div class="article-footer">
                            <?php if(!empty($resultFile)){?>
                                <div class="sub-header"><strong>相關檔案</strong></div>
                                <ul class="attachfiles">
                                <?php foreach($resultFile as $file){?>
                                    <li><a href="<?php echo $filePath.$file['law_file_name']?>">檔案名稱： <?php echo $file['law_file_title']?></a></li>
                                <?php }?>
                                </ul>
                            <?php }?>
                        </div>
                        <!-- end/ 相關檔案 -->
                    </div>
                </div>
                </article>
                <!-- end/ 文章列印範圍 -->
                <hr>
                <div class="text-center">
                    <a href="#" class="btn btn-secondary btn-go-back" onclick="history.go(-1);return false;" onkeypress="history.go(-1);return false;">回上一頁</a>
                    <noscript><p>當JavaScript無法執行時，可按「alt + ←」鍵返回上一頁</p></noscript>
                </div>
            </div>
        </main>
        <!-- end/ main-content -->
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
</body>
</html>
