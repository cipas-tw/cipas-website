$(document).ready(function() {

    // 分辨是否支援 JS 以套用不同css屬性 (配合無障礙需求)
    // =====================================================================
    $('body').addClass('js-enable');

    // * Columns Equal Height ( Plugin:matchHeight-min.js)
    // =====================================================================
    $('.equal-h').matchHeight();

    // * 網站選單 dropdown slidedown
    // =====================================================================
    $sideMenuToggle = $('.header-nav .dropdown');

    // Add slideDown animation to dropdown
    $sideMenuToggle.on('show.bs.dropdown', function(e) {
        $(this).find('.dropdown-menu').first().stop(true, true).slideToggle(200);
    });
    // Add slideUp animation to dropdown
    $sideMenuToggle.on('hide.bs.dropdown', function(e) {
        $(this).find('.dropdown-menu').first().stop(true, true).slideToggle(150);
    });

    // 手機尺寸時, 網站選單 dwopdown 可同時有多個開啟狀態
    $sideMenuToggle.find('.dropdown-toggle').on('click', function(e) {
        if ($('body').hasClass('push-nav-expand')) {
            // 取消 Bootstrap dropdown 預設行為
            e.stopPropagation();
            e.preventDefault();
            // dropdown 開關
            $(this).siblings('.dropdown-menu').slideToggle(200, function() {
                $(this).parent().toggleClass('open');
            });
        };
    });

    // * Push menu expand
    // =====================================================================
    $('.navbar-toggler').click(function(e) {
        e.preventDefault();
        $('body').addClass('push-nav-expand');
        $('.header-nav').addClass('push-nav');
    });

    // == Push menu close
    $('.off-canvas-overlay').click(function(e) {
        e.preventDefault();
        $('body').removeClass('push-nav-expand');
        $('.header-nav').removeClass('push-nav');
    });

    // * window 寬度大於手機模式寬度斷點時
    // =====================================================================
    $(window).resize(function() {
        if ($(window).width() > 512) { // 512為 css 設定的樣式 breakpoint
            // 關閉首頁選單已經開啟的 dropdown
            $sideMenuToggle.each(function() {
                if ($(this).hasClass('open')) {
                    $(this).find('.dropdown-toggle').dropdown('toggle');
                };
            });
            // 選單恢復為追面板模式
            $('body').removeClass('push-nav-expand');
            $('.header-nav').removeClass('push-nav');
        }
    });


    // * 首頁 Videos 區塊 Tab 控制
    // =====================================================================
    $('.top-videos .tab-list > li').click(function(e) {
        e.preventDefault();

        var $tabList = $(this).parent();

        // 手機模式寬度時，下拉選單開啟切換
        if ($(window).width() < 768) { // 768為 css 設定的影片選單樣式 breakpoint
            $tabList.toggleClass('open');
        }

        if ($(this).hasClass('active'))
            return false

        // 切換 Aactive 樣式
        $(this).addClass('active').siblings('li').removeClass('active');

        // Change iframe src
        loadHomeVideos();
    });

    function loadHomeVideos() {

        var $tabActived = $('.top-videos li.active .tab');
        var _src = $tabActived.attr('data-url');
        var _title = $tabActived.attr('title');
        if($tabActived.attr('data-img-url') != ''){
	        _src = $tabActived.attr('data-img-url');
	        
	        $('#topBanner').html('<a href="'+$tabActived.attr('data-url')+'"><img src="'+_src+'" alt="圖片說明文字"></a>');
        } else {
	        $('#topBanner').html('<iframe title="影片頁框" src="'+_src+'" src="'+_title+'" class="embed-responsive-item" id="topVideoFrame" allowfullscreen></iframe>');
	         
        }
    };
    // Executive
    loadHomeVideos();

});

// * 列印文章內容
// =====================================================================
function printDoc(){
    var $printContents = $('.print-wrap').html();
    var $originalContents = $('body').html();
    $('body').html($printContents)
    window.print();
    $('body').html($originalContents);
};
