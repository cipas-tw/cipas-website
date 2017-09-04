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
                <div class="page-header">網站導覽</div>
                <!-- 網站導覽 -->
                <div class="sitemap article">
                    <div class="row-w-limit-sm m-b-6">
                        <div class="sub-header"><strong>無障礙導覽說明</strong></div>
                        <ul>
                            <li>
                                本網站依無障礙網頁設計原則建置，網站的主要內容分為三大區塊：
                                <ol>
                                    <li>上方功能區塊。</li>
                                    <li>中央主要內容區塊。</li>
                                    <li>下方功能區塊。</li>
                                </ol>
                            </li>
                            <li>本網站的快速鍵（Access Key）設定如下：
                                <ul class="list-unstyled">
                                    <li class="m-b-2">
                                        <kbd>Alt</kbd>+<kbd>Shift</kbd>+<kbd>U</kbd>：上方功能區包括回首頁、主選單、網站搜尋。
                                    </li>
                                    <li class="m-b-2">
                                        <kbd>Alt</kbd>+<kbd>Shift</kbd>+<kbd>C</kbd>：中央主要內容區，為本頁主要內容區。
                                    </li>
                                    <li class="m-b-2">
                                        <kbd>Alt</kbd>+<kbd>Shift</kbd>+<kbd>F</kbd>：下方功能區包括本站各主要連結、聯絡方式、政府網站資料開放宣告連結。

                                    </li>
                                    <li class="m-b-2">
                                        <kbd>Alt</kbd>+<kbd>Shift</kbd>+<kbd>S</kbd>：網站搜尋。
                                    </li>
                                </ul>
                                <p class="small">若您使用的是Mac系統，請將"Shift"鍵改為"Control"鍵。</p>
                            </li>
                        </ul>
                    </div>
                    <ul class="list-nav row">
                        <li class="col equal-h">
                            <div class="link-heading">關於本會</div>
                            <ul class="list-list">
                                <li><a href="/about">執掌與組織</a></li>
                                <li><a href="/about/members">本會委員</a></li>
                                <li><a href="/contact">聯絡資訊</a></li>
                            </ul>
                        </li>
                        <li class="col equal-h">
                            <div class="link-heading">新聞與公告</div>
                            <ul class="list-list">
                                <li><a href="/news">最新消息</a></li>
                                <li><a href="/presses">新聞稿</a></li>
                                <li><a href="/gazettes">公告資訊</a></li>
                                <li><a href="/meetings">會議紀錄</a></li>
                            </ul>
                        </li>
                        <li class="col equal-h">
                            <div class="link-heading">本會業務</div>
                            <ul class="list-list">
                                <li><a href="/investigations">調查進度</a></li>
                                <li><a href="/hearings">聽證程序</a></li>
                                <li><a href="/administrative_actions">行政處分</a></li>
                                <li><a href="/litigations">相關訴訟</a></li>
                                <li><a href="/declarations">申報事項</a></li>
                                <li><a href="/rewards">獎勵舉發</a></li>
                                <li><a href="/recoveries">回復權利</a></li>
                            </ul>
                        </li>
                        <li class="col equal-h">
                            <div class="link-heading">法令函釋</div>
                            <ul class="list-list">
                                <li><a href="/organic_rules/1">組織規程</a></li>
                                <li><a href="/regulations">本會主管法規</a></li>
                                <li><a href="/interpretations">本會解釋</a></li>
                            </ul>
                        </li>
                        <li class="col equal-h">
                            <div class="link-heading">公開資訊</div>
                            <ul class="list-list">
                                <li><a href="/policies">施政計畫</a></li>
                                <!-- <li><a href="/statistics">業務統計</a></li> -->
                                <li><a href="/budgets">預算書及決算書</a></li>
                                <li><a href="/purchases">採購契約</a></li>
                                <li><a href="/videos">影音專區</a></li>
                                <!-- <li><a href="/journals">期刊文獻</a></li> -->
                                <li><a href="<?php echo $historyLink?>" title="在新視窗打開鏈結" target="_blank">07年歷史資料網站</a></li>
                            </ul>
                        </li>
                        <li class="col equal-h">
                            <div class="link-heading">史料徵集</div>
                            <ul class="list-list">
                                <li><a href="/collect">史料徵集說明</a></li>
                                <li><a href="/stories">史料故事</a></li>
                            </ul>
                        </li>
                        <li class="col equal-h">
                            <div class="link-heading">便民服務</div>
                            <ul class="list-list">
                                <li><a href="/faq">常見問題</a></li>
                                <li><a href="/downloads">檔案下載</a></li>
                                <li><a href="/related_links">相關連結</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- end/ 網站導覽 -->
            </div>
        </main>
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
</body>
</html>