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
                <!-- 聯絡資訊 -->
                <div class="about-contact article">
                    <ul class="contact-info list-unstyled">
                        <li>意見信箱：<a href="mailto:<?php echo $result['contact_mail']; ?>" title="意見信箱"><?php echo $result['contact_mail']; ?></a></li>
                        <li>聯絡電話：<?php echo $result['contact_telephone']; ?></li>
                        <li>傳真號碼：<?php echo $result['contact_fax']; ?></li>
                        <li>聯絡地址：<?php echo $result['contact_address_zh_TW']; ?></li>
                        <li>聯絡地址-英：<span lang="en"><?php echo $result['contact_address_en_US']; ?></span></li>
                    </ul>
                    <div class="map-wrap embed-responsive embed-responsive-16by9">
                        <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14458.094171541487!2d121.5343321!3d25.0502385!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe4954843fe203424!2z6KGM5pS_6Zmi5LiN55W26buo55Si6JmV55CG5aeU5ZOh5pyD!5e0!3m2!1szh-TW!2stw!4v1491664023646"
                        title="不當黨產處理委員會聯絡地址 google map"
                        class="embed-responsive-item"
                        allowfullscreen></iframe>
                    </div>
                </div>
                <!-- end/ 聯絡資訊 -->
            </div>
        </main>
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
</body>
</html>
