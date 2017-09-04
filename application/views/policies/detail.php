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
                        <li class="hidden-xxs"><a href="javascript:printDoc()" title="友善列印" class="ico-share-print"><span>友善列印</span></a></li>
                    </ul>
                    <noscript>
                        <small>當JavaScript無法執行時，可按「Ctrl + P」鍵使用列印功能</small>
                    </noscript>
                </div>
                <!-- 文章列印範圍 -->
                <article>
                <div class="print-wrap">
                    <div class="page-header"><?php echo $result['policy_title']?></div>
                    <div class="doc-detail">
                        <div class="date small text-muted">發布日期：<?php echo date('Y/m/d', strtotime($result['policy_show_date']))?></div>
                        <!-- 文章內容 -->
                        <div class="article row-w-limit">
                            <?php echo stripslashes($result['policy_content'])?>
                        </div>
                        <!-- end/ 文章內容 -->
                        <!-- 相關檔案 -->
                        <div class="article-footer">
                            <?php if(!empty($resultFile)){?>
                                <div class="sub-header"><strong>相關檔案</strong></div>
                                <ul class="attachfiles">
                                <?php foreach($resultFile as $file){?>
                                    <li><a href="<?php echo $filePath.$file['policy_file_name']?>">檔案名稱： <?php echo $file['policy_file_title']?></a></li>
                                <?php }?>
                                </ul>
                            <?php }?>
                        </div>
                        <!-- end/ 相關檔案 -->
                    </div>
                </div>
                </article>
                <!-- end/ 文章列印範圍 -->
                <div class="text-center">
                    <a href="#" class="btn btn-secondary btn-go-back" onclick="history.go(-1);return false;" onkeypress="history.go(-1);return false;">回上一頁</a>
                    <noscript><p>當JavaScript無法執行時，可按「alt + ←」鍵返回上一頁</p></noscript>
                </div>
            </div>
        </main>
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
</body>
</html>