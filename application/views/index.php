<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <?php echo $headHtml;?>
</head>
<body>
    <?php echo $headerHtml;?>
        <!-- end/ header-nav -->
        <!-- main-content -->
        <main class="main-content">
            <!-- 導盲磚 -->
            <div class="container outer-wrap pos-rel">
                <a href="#" class="tactile" title="中央主要內容區塊" accesskey="C">:::</a>
            </div>
            <!-- end/ 導盲磚 -->
            <!-- 影片區塊 -->
            <div class="container p-a-0">
                <div class="top-videos">
                    <div class="is-table-row">
                        <div class="panel-tabs">
                            <div class="responsive-height">
                                <ul class="tab-list">
                                    <?php foreach($sliderBanner as $k => $banner){?>
                                    <li <?php echo $k ==0 ? 'class="active"': ''?>>
                                        <a href="#" class="tab" data-img-url="<?php echo isset($banner['slider_banner_filename']) && $banner['slider_banner_filename'] !='' ? $sliderBannerPath.$banner['slider_banner_filename'] : ''?>" data-url="<?php echo $banner['slider_banner_url']?>" title="<?php echo $banner['slider_banner_title']?>">
                                            <span class="t-wrap"><?php echo $banner['slider_banner_title']?></span>
                                        </a>
                                    </li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-viedos">
                            <div class="panel-cont" id="topBanner"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end/ 影片區塊 -->
            <!-- 最新消息 -->
            <div class="container outer-wrap">
                <div class="last-news">
                    <div class="page-header">最新消息</div>
                    <div class="row doc-gallery-view">
                        <!--
                            ** Note:
                            ** 1.圖片尺寸最大為 W:320px, H:216px
                            ** 2.每則標題最多26個中文字
                        -->
                        <?php foreach($newsList as $data){?>
                        <div class="col-sm-4">
                            <div class="thumbnail">
                                <div class="img-box">
                                    <a href="/news/<?php echo $data['news_id']?>"><img src="<?php echo (isset($data['news_filename']) && $data['news_filename'] != "") ? $newsPath.$data['news_filename'] : $defultImgCipas?>" alt=""></a>
                                </div>
                                <div class="caption">
                                    <div class="info-row">
                                        <span class="label label-primary label-category"><?php echo $data['news_type_name']?></span>
                                        <span class="date"><?php echo $data['news_show_date']?></span>
                                    </div>
                                    <a href="/news/<?php echo $data['news_id']?>" class="doc-title"><?php echo $data['news_title']?></a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <!-- end/ 最新消息 -->
        </main>
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
</body>
</html>
