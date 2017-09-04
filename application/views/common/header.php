    <noscript>
        <div class="alert alert-danger m-a-0 text-center">您的瀏覽器不支援JavaScript，如欲使用完整功能，請開啟JavaScript功能或更換支援 JavaScript 的瀏覽器。</div>
    </noscript>
    <div class="page-wrapper">
        <div class="off-canvas-overlay"></div>
        <!-- Header -->
        <header class="header">
            <!--導盲磚-->
            <div class="container outer-wrap pos-rel">
                <a href="#U" name="U" class="tactile" title="上方功能區塊" accesskey="U">:::</a>
            </div>
            <!--end/導盲磚-->
            <div class="header-top navbar navbar-inverse">
                <div class="container outer-wrap">
                    <ul class="nav navbar-nav">
                        <li><a href="/">回首頁</a></li>
                        <li><a href="/tutorial">網站導覽</a></li>
                        <li><a href="/faq">常見問題</a></li>
                        <li><a href="/downloads">檔案下載</a></li>
                        <li><a href="mailto:cipas@cipas.gov.tw">意見信箱</a></li>
                    </ul>
                </div>
            </div>
            <div class="header-inner">
                <button class="btn navbar-toggler" type="button"><i class="bar"></i></button>
                <div class="container outer-wrap">
                    <a href="/" class="header-logo">
                        <img src="/public/images/cipas_logo.png" alt="不當黨產處理委員會">
                    </a>
                </div>
            </div>
        </header>
        <!-- end/ Header -->
        <!-- header-nav -->
        <nav class="header-nav navbar navbar-inverse">
            <div class="container outer-wrap">
                <!-- site-search -->
                <div class="site-search">
                    <form action="/home/search" class="search-form">
                        <input type="hidden" name="cx" value="006357188511741080123:6rgdkaodtnm" />
                        <input type="hidden" name="cof" value="FORID:10" />
                        <input type="hidden" name="ie" value="UTF-8" />
                        <label class="sr-only" for="keyword">搜尋</label>
                        <div class="input-group">
                            <input type="text" id="keyword" class="input-search form-control" placeholder="請輸入關鍵字" name="q" title="關鍵字搜尋" accesskey="S">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-search"><span class="text-hide">送出搜尋</span></button>
                            </span>
                        </div>
                        <div class="keywords">
                            <!--  ** Note: 熱門搜尋最多4個，每個最多4中文字 ** -->
                            <span class="label-text">熱門搜尋：</span>
                            <?php foreach($hotKeyword as $val){?>
                            <a class="word" href="/home/search?cx=006357188511741080123:6rgdkaodtnm&cof=FORID%3A10&ie=UTF-8&q=<?php echo $val['hot_keyword_title']?>" title="搜尋-關鍵字-<?php echo $val['hot_keyword_title']?>"><?php echo $val['hot_keyword_title']?></a>
                            <?php }?>
                        </div>
                    </form>
                </div>
                <!-- end/ site-search -->
                <!-- site-nav -->
                <ul class="site-nav nav navbar-nav">
                    <!-- ** Note: 為符合無障礙需求，Dropdown 選單在 Noscript時 <a>的 href 需設定為每個單元的第一個子單元 ** -->
                    <li class="dropdown">
                        <a href="/about/org" class="dropdown-toggle" data-toggle="dropdown">關於本會</a>
                        <ul class="dropdown-menu">
                            <li><a href="/about">執掌與組織</a></li>
                            <li><a href="/about/members">本會委員</a></li>
                            <li><a href="/contact">聯絡資訊</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="/news/lists" class="dropdown-toggle" data-toggle="dropdown">新聞與公告</a>
                        <ul class="dropdown-menu">
                            <li><a href="/news">最新消息</a></li>
                            <li><a href="/presses">新聞稿</a></li>
                            <li><a href="/gazettes">公告資訊</a></li>
                            <li><a href="/meetings">會議紀錄</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="affairs-progress.html" class="dropdown-toggle" data-toggle="dropdown">本會業務</a>
                        <ul class="dropdown-menu">
                            <li><a href="/investigations">調查進度</a></li>
                            <li><a href="/hearings">聽證程序</a></li>
                            <li><a href="/administrative_actions">行政處分</a></li>
                            <li><a href="/litigations">相關訴訟</a></li>
                            <li><a href="/declarations">申報事項</a></li>
                            <li><a href="/rewards">獎勵舉發</a></li>
                            <li><a href="/recoveries">回復權利</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="act-org.html" class="dropdown-toggle" data-toggle="dropdown">法令函釋</a>
                        <ul class="dropdown-menu">
                            <li><a href="/organic_rules/1">組織規程</a></li>
                            <li><a href="/regulations">本會主管法規</a></li>
                            <li><a href="/interpretations">本會解釋</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="/information/policy" class="dropdown-toggle" data-toggle="dropdown">公開資訊</a>
                        <ul class="dropdown-menu">
                            <li><a href="/policies">施政計畫</a></li>
                            <!-- <li><a href="/statistics">業務統計</a></li> -->
                            <li><a href="/budgets">預算書及決算書</a></li>
                            <li><a href="/purchases">採購契約</a></li>
                            <li><a href="/videos">影音專區</a></li>
                             <li><a href="/journals">期刊文獻</a></li> 
                            <li><a href="<?php echo $historyLink?>" title="在新視窗打開鏈結" target="_blank">07年歷史資料網站</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="archive-plan.html" class="dropdown-toggle" data-toggle="dropdown">史料徵集</a>
                        <ul class="dropdown-menu">
                            <li><a href="/collect">史料徵集說明</a></li>
                            <li><a href="/stories">史料故事</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="service-faq.html" class="dropdown-toggle" data-toggle="dropdown">便民服務</a>
                        <ul class="dropdown-menu">
                            <li><a href="/faq">常見問題</a></li>
                            <li><a href="/downloads">檔案下載</a></li>
                            <li><a href="/related_links">相關連結</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/end: .container -->
        </nav>