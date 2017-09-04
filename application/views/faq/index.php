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
                <div class="print-wrap">
                    <div class="page-header">常見問題</div>
                    <div class="doc-list-view faq">
                        <ul class="list">
                            <?php
                            foreach( $result as $val ){
                            ?>
                            <li class="caption">
                                <div class="row-w-limit">
                                    <div class="doc-title quest"><?php echo $val['qa_question'];?></div>
                                    <div class="ans"><?php echo $val['qa_answer'];?></div>
                                    <div class="date">更新日期：<?php echo date('Y/m/d', strtotime($val['qa_edited_date']));?></div>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- end/ 文章列印範圍 -->
                <?php echo $this->pagination->create_links();?>
            </div>
        </main>
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
</body>
</html>
