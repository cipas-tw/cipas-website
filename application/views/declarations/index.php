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
                        <a href="#tab1" data-toggle="tab">申報事項說明</a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab" id="touch" >已申報事項</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="article row-w-limit">
                            <h1><?php echo $result['declaration_explain_title']?></h1>
                            <?php echo stripslashes($result['declaration_explain_content'])?>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="doc-list-view">
                            <ul class="list">
                                <?php foreach($explainList as $data){?>
                                <li class="caption">
                                    <div class="row-w-limit">
                                        <a href="/<?php echo $this->router->fetch_class() ?>/<?php echo $data['declaration_id']?>" class="doc-title"><?php echo $data['declaration_title']?><small class="date"><?php echo date('Y/m/d', strtotime($data['declaration_show_date']))?></small></a>
                                    </div>
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                        <?php echo $this->pagination->create_links();?>
                    </div>
                </div>
                
            </div>
        </main>
        <!-- end/ main-content -->
        <?php echo $footerHtml;?>
    </div>
    <?php echo $scriptsHtml;?>
    <script type="text/javascript">
        $(document).ready(function(){
        <?php if($page != "") { ?>
          $("#touch").click();
        <?php }?>
        });
    </script>
</body>
</html>
