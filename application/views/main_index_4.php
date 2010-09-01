<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="<?=$this->lang->line('content')?>">
	<meta name="author" content="Nexus">
	<meta name="Description" content="<?=$this->lang->line('head_description')?>">

        <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/jquery.tools.min.js"></script>
        <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/jquery.fancybox-1.3.1.pack.js"></script>
        <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/jquery.cookie.js"></script>
        <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/RSA.js"></script>
        <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/jquery.mousewheel-3.0.2.pack.js"></script>
        <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/jquery.validationEngine.modified.js"></script>
        <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/functions.js"></script>
        <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/BigInt.js"></script>
        <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/Barrett.js"></script>
        <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/flowplayer-3.2.2.min.js"></script>
        <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/jquery.jparallax.js"></script>

        <link rel="stylesheet" type="text/css" href="<?=$this->config->item('base_url')?>design/style.css" />

        <!--[if lte IE 6]>
        <link rel="stylesheet" type="text/css" href="<?=$this->config->item('base_url')?>design/ie6.css" />
        <![endif]-->

        <title><?=$this->lang->line('head_title')?></title>

        <style>
            /* dont't remove!!!!!!!! (chrome fix) Parallax = Sky */
            #sky{height: 265px; background: url(<?=$this->config->item('base_url')?>design/bg_sky.jpg) repeat-x; position: absolute; top: 0; z-index: 2; overflow: hidden; width: 100%;}
            #sky #baloon{background: url(<?=$this->config->item('base_url')?>design/bg_balloon.png) no-repeat 95% 0; height: 100%; width:120%; position: absolute;top: 0; z-index:7;}
			#sky #clouds-1{background: url('<?=$this->config->item('base_url')?>design/pt_clouds.png') repeat-x 0 0; width: 110%;height: 100%;position: absolute;top: 0;z-index:5;}
			#sky #clouds-2{background: url('<?=$this->config->item('base_url')?>design/pt_clouds.png') repeat-x 0 -265px; width: 120%;height: 100%;position: absolute;top: 0;z-index:4;}
			#sky #clouds-3{background: url('<?=$this->config->item('base_url')?>design/pt_clouds.png') repeat-x 0 -530px; width: 130%;height: 100%;position: absolute;top: 0;z-index:3;}
            #sky #birds{background: url(<?=$this->config->item('base_url')?>design/pt-birds.png) repeat-x; width: 120%;height: 100%;position: absolute;top: 0;z-index:6;}
        </style>

    </head>

<body>
    <div class="products">
        <!-- #MMO:NETBAR# -->
        <script type="text/javascript">
        var mmostyle = document.createElement('style');
        if (navigator.appName == "Microsoft Internet Explorer") {
                mmostyle.setAttribute("type", "text/css");
                mmostyle.styleSheet.cssText = ' body {margin:0; padding:0;} #mmonetbar { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.bg.png) repeat-x; font:normal 11px Tahoma, Arial, Helvetica, sans-serif; height:32px; left:0; padding:0; position:absolute; text-align:center; top:0; width:100%; z-index:3000; } #mmonetbar #mmoContent { height:32px; margin:0 auto; width:1024px; position: relative; } #mmonetbar .mmosmallbar {width:585px !important;} #mmonetbar .mmosmallbar div.mmoBoxMiddle { width: 290px; } #mmonetbar .mmonewsout {width:800px !important;} #mmonetbar .mmouseronlineout {width:768px !important;} #mmonetbar .mmolangout {width:380px !important;} #mmonetbar .mmolangout .mmoGame { width: 265px; } #mmonetbar a { color:#666; font:normal 11px Tahoma, Arial, Helvetica, sans-serif; outline: none; text-decoration:none; white-space:nowrap; } #mmonetbar select { background-color:#bed7e3 !important; border:1px solid #1d707b !important; color:#602b0c !important; font:normal 11px Verdana, Arial, Helvetica, sans-serif; height:18px; margin-top:3px; width:100px; } #mmonetbar .mmoGames select {width:80px;} #mmonetbar option { background-color:#bed7e3 !important; color:#602b0c !important; } #mmonetbar option:hover { background-color:#9ec8dd !important; } #mmonetbar select#mmoCountry {width:120px;} #mmonetbar .mmoSelectbox { background-color:#bed7e3; float:left; margin:3px 0 0 3px; position:relative; } * html #mmonetbar .mmoSelectbox {position:static;} *+html #mmonetbar .mmoSelectbox {position:static;} #mmonetbar #mmoOneGame {cursor:default; height:14px; margin-top:3px; padding-left:5px; width:80px;} #mmonetbar .label {float:left; font-weight:bold; margin-right:4px; overflow:hidden !important;} #mmonetbar #mmoUsers .label {font-size:10px;} #mmonetbar .mmoBoxLeft, #mmonetbar .mmoBoxRight { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -109px -4px; float:left; width:5px; height:24px; } #mmonetbar .mmoBoxRight {background-position:-126px -4px;} #mmonetbar .mmoBoxMiddle { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.bg.png) repeat-x 0 -36px; color:#602b0c !important; float:left; height:24px; line-height:22px; text-align:left; white-space:nowrap; } #mmonetbar #mmoGames, #mmonetbar #mmoLangs {margin:0px 4px 0 0;} #mmonetbar #mmoNews, #mmonetbar #mmoUsers, #mmonetbar #mmoGame, #mmonetbar .nojsGame {margin:4px 4px 0 0;} #mmonetbar #mmoLogo { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat top left; float:left; display:block; height:32px; width:108px; } #mmonetbar #mmoNews {float:left; width:252px;} #mmonetbar #mmoNews #mmoNewsContent {text-align:left; width:200px;} #mmonetbar #mmoNews #mmoNewsticker {overflow:hidden; width:240px;} #mmonetbar #mmoNews #mmoNewsticker ul { list-style-type: none; margin: 0; padding: 0px; } #mmonetbar #mmoNews #mmoNewsticker ul li { font:normal 11px/22px Tahoma, Arial, Helvetica, sans-serif !important; color:#602b0c !important; padding: 0px; margin: 0; } #mmonetbar #mmoNews #mmoNewsticker ul li a {color:#602b0c !important;} #mmonetbar #mmoNews #mmoNewsticker ul li a:hover {text-decoration:underline;} #mmonetbar #mmoUsers {float:left; width:178px;} #mmonetbar #mmoUsers .mmoBoxLeft {width:17px;} #mmonetbar #mmoUsers .mmoBoxMiddle {padding-left:3px; width:150px;} #mmonetbar .mmoGame {display:none; float:left; width:432px;} #mmonetbar .mmoGame #mmoGames {float:left; width:206px;} #mmonetbar .mmoGame #mmoLangs {float:left; margin:0; width:252px;} #mmonetbar .mmoGame label { color:#602b0c !important; float:left; font-weight:400 !important; line-height:22px; margin:0px; text-align:right !important; width:110px; font-size: 11px !important; } #mmonetbar .nojsGame {display:block; width:470px;} #mmonetbar .nojsGame .mmoBoxMiddle {width:450px;} #mmonetbar .nojsGame .mmoSelectbox {margin:0px 0 0 3px;} *+html #mmonetbar .nojsGame .mmoSelectbox {margin:2px 0 0 3px;} * html #mmonetbar .nojsGame .mmoSelectbox {margin:2px 0 0 3px;} #mmonetbar .nojsGame .mmoGameBtn { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -162px -7px; border:none; cursor:pointer; float:left; height:18px; margin:3px 0 0 7px; padding:0; width:18px; } #mmonetbar .mmoSelectArea { border:1px solid #1d707b; color:#602b0c !important; display:block !important; float:none; font-weight:400 !important; font-size:11px; height:16px; line-height:13px; overflow:hidden !important; width:90px; } #mmonetbar #mmoLangSelect .mmoSelectArea {width:129px;} #mmonetbar #mmoLangSelect { z-index: 10000; position: relative; } #mmonetbar #mmoLangSelect .mmoOptionsDivVisible {min-width:129px;} #mmonetbar .mmoSelectArea .mmoSelectButton { background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -141px -8px; float:right; width:17px; height:16px; } #mmonetbar .mmoSelectText {cursor:pointer; float:left; overflow:hidden; padding:1px 2px; width:68px;} #mmonetbar #mmoLangSelect .mmoSelectText {width:107px;} #mmonetbar #mmoOneLang {cursor:default; height:14px;} #mmonetbar div.mmoOneLang { background: none; } #mmonetbar div.mmoOneLang #mmoOneLang { border: none; padding: 2px 3px; } #mmonetbar .mmoOptionsDivInvisible, #mmonetbar .mmoOptionsDivVisible { background-color: #bed7e3 !important; border: 1px solid #1d707b; position: absolute; min-width:90px; z-index: 3100; } * html #mmonetbar .mmoOptionsDivVisible .highlight {background-color:#9ec8dd !important} #mmonetbar .mmoOptionsDivInvisible {display: none;} #mmonetbar .mmoOptionsDivVisible ul { border:0; font:normal 11px Tahoma, Arial, Helvetica, sans-serif; list-style: none; margin:0; padding:2px; overflow:auto; overflow-x:hidden; } #mmonetbar #mmoLangs .mmoOptionsDivVisible ul {min-width:125px;} #mmonetbar .mmoOptionsDivVisible ul li { background-color: #bed7e3; height:14px; padding:2px 0; } #mmonetbar .mmoOptionsDivVisible a { color: #602b0c !important; display: block; font-weight:400 !important; height:16px !important; min-width:80px; text-decoration: none; white-space:nowrap; width:100%; } #mmonetbar #mmoContent .mmoLangList a {min-width:102px;} #mmonetbar .mmoOptionsDivVisible li:hover {background-color: #9ec8dd;} #mmonetbar .mmoOptionsDivVisible li a:hover {color: #602b0c !important;} #mmonetbar .mmoOptionsDivVisible li.mmoActive {background-color: #9ec8dd !important;} #mmonetbar .mmoOptionsDivVisible li.mmoActive a {color: #602b0c !important;} #mmonetbar .mmoOptionsDivVisible ul.mmoListHeight {height:240px} #mmonetbar .mmoOptionsDivVisible ul.mmoLangList.mmoListHeight li {padding-right:15px !important; width:100%;} #mmonetbar #mmoGameSelect ul.mmoListHeight a {min-width:85px;} #mmonetbar #mmoLangSelect ul.mmoListHeight a {min-width:105px;} #mmonetbar #mmoFocus {position:absolute;left:-2000px;top:-2000px;} #mmonetbar #mmoLangs .mmoSelectText span, #mmonetbar #mmoLangs .mmoflag { background: transparent url(<?=$this->config->item('base_url')?>design/netbar/mmoflags.png) no-repeat; height:14px !important; padding-left:23px; } .mmo_AE {background-position:left 0px !important} .mmo_AR {background-position:left -14px !important} .mmo_BE {background-position:left -28px !important} .mmo_BG {background-position:left -42px !important} .mmo_BR {background-position:left -56px !important} .mmo_BY {background-position:left -70px !important} .mmo_CA {background-position:left -84px !important} .mmo_CH {background-position:left -98px !important} .mmo_CL {background-position:left -112px !important} .mmo_CN {background-position:left -126px !important} .mmo_CO {background-position:left -140px !important} .mmo_CZ {background-position:left -154px !important} .mmo_DE {background-position:left -168px !important} .mmo_DK {background-position:left -182px !important} .mmo_EE {background-position:left -196px !important} .mmo_EG {background-position:left -210px !important} .mmo_EN {background-position:left -224px !important} .mmo_ES {background-position:left -238px !important} .mmo_EU {background-position:left -252px !important} .mmo_FI {background-position:left -266px !important} .mmo_FR {background-position:left -280px !important} .mmo_GR {background-position:left -294px !important} .mmo_HK {background-position:left -308px !important} .mmo_HR {background-position:left -322px !important} .mmo_HU {background-position:left -336px !important} .mmo_ID {background-position:left -350px !important} .mmo_IL {background-position:left -364px !important} .mmo_IN {background-position:left -378px !important} .mmo_INTL {background-position:left -392px !important} .mmo_IR {background-position:left -406px !important} .mmo_IT {background-position:left -420px !important} .mmo_JP {background-position:left -434px !important} .mmo_KE {background-position:left -448px !important} .mmo_KR {background-position:left -462px !important} .mmo_LT {background-position:left -476px !important} .mmo_LV {background-position:left -490px !important} .mmo_ME {background-position:left -504px !important} .mmo_MK {background-position:left -518px !important} .mmo_MX {background-position:left -532px !important} .mmo_NL {background-position:left -546px !important} .mmo_NO {background-position:left -560px !important} .mmo_PE {background-position:left -574px !important} .mmo_PH {background-position:left -588px !important} .mmo_PK {background-position:left -602px !important} .mmo_PL {background-position:left -616px !important} .mmo_PT {background-position:left -630px !important} .mmo_RO {background-position:left -644px !important} .mmo_RS {background-position:left -658px !important} .mmo_RU {background-position:left -672px !important} .mmo_SE {background-position:left -686px !important} .mmo_SI {background-position:left -700px !important} .mmo_SK {background-position:left -714px !important} .mmo_TH {background-position:left -728px !important} .mmo_TR {background-position:left -742px !important} .mmo_TW {background-position:left -756px !important} .mmo_UA {background-position:left -770px !important} .mmo_UK {background-position:left -784px !important} .mmo_US {background-position:left -798px !important} .mmo_VE {background-position:left -812px !important} .mmo_VN {background-position:left -826px !important} .mmo_YU {background-position:left -840px !important} .mmo_ZA {background-position:left -854px !important} div#mmonetbar a:active { top: 0; } div#mmoGamesOverviewPanel { width: 286px; position: absolute; top: 0; right: 0; font: 12px Arial, sans-serif; } div#mmoGamesOverviewPanel h4, div#mmoGamesOverviewPanel h5 { margin: 0; font-size: 12px; font-weight: bold; text-align: left; } div#mmoGamesOverviewPanel a { text-decoration: none; } div#mmoGamesOverviewPanel a img { border: none; } div#mmoGamesOverviewToggle { width: 168px; padding: 4px 0 4px 118px; } div#mmoGamesOverviewToggle h4 { height: 18px; position: relative; background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.bg.png) repeat-x 0 -36px; top: 0px; padding: 3px 20px; } div#mmoGamesOverviewToggle h4 a { display: block; width: 116px; height: 16px; line-height: 14px; text-align: left; font-weight: normal; outline: none; color: #602b0c; font-size: 11px !important; position: relative; border: 1px solid #1d707b; padding: 0 0 0 10px; } div#mmoGamesOverviewToggle h4 a.gameCountZero { cursor: default; text-align: center; padding: 0; width: 126px; } div#mmoGamesOverviewToggle h4 a span.mmoNbPseudoSelect_icon { display: block; position: absolute; top: 0; right: 0; width: 17px; height: 16px; background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -141px -8px; } span.iconTriangle { display: block; position: absolute; top: 5px; right: 10px; width: 0px; border: 5px solid transparent; border-bottom-color: #602b0c; } div#mmoGamesOverviewToggle h4 a.toggleHidden { } div#mmoGamesOverviewToggle h4 a.toggleHidden span.iconTriangle { top: 10px; border: 5px solid transparent; border-top-color: #602b0c; } div#mmoGamesOverviewToggle h4 span.mmoNbBoxEdge { display: block; width: 5px; height: 24px; background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -109px -4px; position: absolute; top: 0; } div#mmoGamesOverviewToggle h4 span.mmoNbBoxEdge_left { left: 0; } div#mmoGamesOverviewToggle h4 span.mmoNbBoxEdge_right { right: 0; background-position: -126px -4px; } div#mmoGamesOverviewLists { clear: both; background: #bed7e3; width: 284px; border: 1px solid #1d707b; float: left; position: relative; top: 0px; } div#mmoGamesOverviewLists h5 { clear: both; padding: 0 18px; height: 27px; line-height: 27px; color: #602b0c; border-bottom: 1px solid #1d707b; background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.bg.png) repeat-x 0 -3px; font-family: inherit; width: 248px; } div#mmoGamesOverviewLists ul { margin: 0; padding: 13px 0; list-style: none; width: 284px; float: left; text-align: left; } div#mmoGamesOverviewLists ul li { margin: 0; padding: 0; list-style: none; width: 138px; padding: 0 2px 1px 2px; float: left; } div#mmoGamesOverviewLists ul li a { display: block; width: 90px; padding: 0 0 0 48px; height: 24px; line-height: 24px; color: #602b0c; text-align: left; position: relative; font-size: 11px !important; } div#mmoGamesOverviewLists ul li a:focus, div#mmoGamesOverviewLists ul li a:hover { background-color: #9ec8dd; } div#mmoGamesOverviewLists ul li a img { display: block; position: absolute; top: 1px; left: 18px; } div#mmoGamesOverviewLists div#mmoGamesOverviewCountry { width: 20px; height: 14px; position: absolute; top: 6px; right: 12px; background-image: url(<?=$this->config->item('base_url')?>design/netbar/mmoflags.png); background-repeat: no-repeat; } #mmonetbar div.nojsGame { width: 432px !important; } #mmonetbar div.nojsGame div.mmoBoxMiddle { width: 422px; } #mmonetbar div.nojsGame label { width: 105px; } ';
        } else {
                var mmostyleTxt = document.createTextNode(' body {margin:0; padding:0;} #mmonetbar { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.bg.png) repeat-x; font:normal 11px Tahoma, Arial, Helvetica, sans-serif; height:32px; left:0; padding:0; position:absolute; text-align:center; top:0; width:100%; z-index:3000; } #mmonetbar #mmoContent { height:32px; margin:0 auto; width:1024px; position: relative; } #mmonetbar .mmosmallbar {width:585px !important;} #mmonetbar .mmosmallbar div.mmoBoxMiddle { width: 290px; } #mmonetbar .mmonewsout {width:800px !important;} #mmonetbar .mmouseronlineout {width:768px !important;} #mmonetbar .mmolangout {width:380px !important;} #mmonetbar .mmolangout .mmoGame { width: 265px; } #mmonetbar a { color:#666; font:normal 11px Tahoma, Arial, Helvetica, sans-serif; outline: none; text-decoration:none; white-space:nowrap; } #mmonetbar select { background-color:#bed7e3 !important; border:1px solid #1d707b !important; color:#602b0c !important; font:normal 11px Verdana, Arial, Helvetica, sans-serif; height:18px; margin-top:3px; width:100px; } #mmonetbar .mmoGames select {width:80px;} #mmonetbar option { background-color:#bed7e3 !important; color:#602b0c !important; } #mmonetbar option:hover { background-color:#9ec8dd !important; } #mmonetbar select#mmoCountry {width:120px;} #mmonetbar .mmoSelectbox { background-color:#bed7e3; float:left; margin:3px 0 0 3px; position:relative; } * html #mmonetbar .mmoSelectbox {position:static;} *+html #mmonetbar .mmoSelectbox {position:static;} #mmonetbar #mmoOneGame {cursor:default; height:14px; margin-top:3px; padding-left:5px; width:80px;} #mmonetbar .label {float:left; font-weight:bold; margin-right:4px; overflow:hidden !important;} #mmonetbar #mmoUsers .label {font-size:10px;} #mmonetbar .mmoBoxLeft, #mmonetbar .mmoBoxRight { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -109px -4px; float:left; width:5px; height:24px; } #mmonetbar .mmoBoxRight {background-position:-126px -4px;} #mmonetbar .mmoBoxMiddle { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.bg.png) repeat-x 0 -36px; color:#602b0c !important; float:left; height:24px; line-height:22px; text-align:left; white-space:nowrap; } #mmonetbar #mmoGames, #mmonetbar #mmoLangs {margin:0px 4px 0 0;} #mmonetbar #mmoNews, #mmonetbar #mmoUsers, #mmonetbar #mmoGame, #mmonetbar .nojsGame {margin:4px 4px 0 0;} #mmonetbar #mmoLogo { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat top left; float:left; display:block; height:32px; width:108px; } #mmonetbar #mmoNews {float:left; width:252px;} #mmonetbar #mmoNews #mmoNewsContent {text-align:left; width:200px;} #mmonetbar #mmoNews #mmoNewsticker {overflow:hidden; width:240px;} #mmonetbar #mmoNews #mmoNewsticker ul { list-style-type: none; margin: 0; padding: 0px; } #mmonetbar #mmoNews #mmoNewsticker ul li { font:normal 11px/22px Tahoma, Arial, Helvetica, sans-serif !important; color:#602b0c !important; padding: 0px; margin: 0; } #mmonetbar #mmoNews #mmoNewsticker ul li a {color:#602b0c !important;} #mmonetbar #mmoNews #mmoNewsticker ul li a:hover {text-decoration:underline;} #mmonetbar #mmoUsers {float:left; width:178px;} #mmonetbar #mmoUsers .mmoBoxLeft {width:17px;} #mmonetbar #mmoUsers .mmoBoxMiddle {padding-left:3px; width:150px;} #mmonetbar .mmoGame {display:none; float:left; width:432px;} #mmonetbar .mmoGame #mmoGames {float:left; width:206px;} #mmonetbar .mmoGame #mmoLangs {float:left; margin:0; width:252px;} #mmonetbar .mmoGame label { color:#602b0c !important; float:left; font-weight:400 !important; line-height:22px; margin:0px; text-align:right !important; width:110px; font-size: 11px !important; } #mmonetbar .nojsGame {display:block; width:470px;} #mmonetbar .nojsGame .mmoBoxMiddle {width:450px;} #mmonetbar .nojsGame .mmoSelectbox {margin:0px 0 0 3px;} *+html #mmonetbar .nojsGame .mmoSelectbox {margin:2px 0 0 3px;} * html #mmonetbar .nojsGame .mmoSelectbox {margin:2px 0 0 3px;} #mmonetbar .nojsGame .mmoGameBtn { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -162px -7px; border:none; cursor:pointer; float:left; height:18px; margin:3px 0 0 7px; padding:0; width:18px; } #mmonetbar .mmoSelectArea { border:1px solid #1d707b; color:#602b0c !important; display:block !important; float:none; font-weight:400 !important; font-size:11px; height:16px; line-height:13px; overflow:hidden !important; width:90px; } #mmonetbar #mmoLangSelect .mmoSelectArea {width:129px;} #mmonetbar #mmoLangSelect { z-index: 10000; position: relative; } #mmonetbar #mmoLangSelect .mmoOptionsDivVisible {min-width:129px;} #mmonetbar .mmoSelectArea .mmoSelectButton { background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -141px -8px; float:right; width:17px; height:16px; } #mmonetbar .mmoSelectText {cursor:pointer; float:left; overflow:hidden; padding:1px 2px; width:68px;} #mmonetbar #mmoLangSelect .mmoSelectText {width:107px;} #mmonetbar #mmoOneLang {cursor:default; height:14px;} #mmonetbar div.mmoOneLang { background: none; } #mmonetbar div.mmoOneLang #mmoOneLang { border: none; padding: 2px 3px; } #mmonetbar .mmoOptionsDivInvisible, #mmonetbar .mmoOptionsDivVisible { background-color: #bed7e3 !important; border: 1px solid #1d707b; position: absolute; min-width:90px; z-index: 3100; } * html #mmonetbar .mmoOptionsDivVisible .highlight {background-color:#9ec8dd !important} #mmonetbar .mmoOptionsDivInvisible {display: none;} #mmonetbar .mmoOptionsDivVisible ul { border:0; font:normal 11px Tahoma, Arial, Helvetica, sans-serif; list-style: none; margin:0; padding:2px; overflow:auto; overflow-x:hidden; } #mmonetbar #mmoLangs .mmoOptionsDivVisible ul {min-width:125px;} #mmonetbar .mmoOptionsDivVisible ul li { background-color: #bed7e3; height:14px; padding:2px 0; } #mmonetbar .mmoOptionsDivVisible a { color: #602b0c !important; display: block; font-weight:400 !important; height:16px !important; min-width:80px; text-decoration: none; white-space:nowrap; width:100%; } #mmonetbar #mmoContent .mmoLangList a {min-width:102px;} #mmonetbar .mmoOptionsDivVisible li:hover {background-color: #9ec8dd;} #mmonetbar .mmoOptionsDivVisible li a:hover {color: #602b0c !important;} #mmonetbar .mmoOptionsDivVisible li.mmoActive {background-color: #9ec8dd !important;} #mmonetbar .mmoOptionsDivVisible li.mmoActive a {color: #602b0c !important;} #mmonetbar .mmoOptionsDivVisible ul.mmoListHeight {height:240px} #mmonetbar .mmoOptionsDivVisible ul.mmoLangList.mmoListHeight li {padding-right:15px !important; width:100%;} #mmonetbar #mmoGameSelect ul.mmoListHeight a {min-width:85px;} #mmonetbar #mmoLangSelect ul.mmoListHeight a {min-width:105px;} #mmonetbar #mmoFocus {position:absolute;left:-2000px;top:-2000px;} #mmonetbar #mmoLangs .mmoSelectText span, #mmonetbar #mmoLangs .mmoflag { background: transparent url(<?=$this->config->item('base_url')?>design/netbar/mmoflags.png) no-repeat; height:14px !important; padding-left:23px; } .mmo_AE {background-position:left 0px !important} .mmo_AR {background-position:left -14px !important} .mmo_BE {background-position:left -28px !important} .mmo_BG {background-position:left -42px !important} .mmo_BR {background-position:left -56px !important} .mmo_BY {background-position:left -70px !important} .mmo_CA {background-position:left -84px !important} .mmo_CH {background-position:left -98px !important} .mmo_CL {background-position:left -112px !important} .mmo_CN {background-position:left -126px !important} .mmo_CO {background-position:left -140px !important} .mmo_CZ {background-position:left -154px !important} .mmo_DE {background-position:left -168px !important} .mmo_DK {background-position:left -182px !important} .mmo_EE {background-position:left -196px !important} .mmo_EG {background-position:left -210px !important} .mmo_EN {background-position:left -224px !important} .mmo_ES {background-position:left -238px !important} .mmo_EU {background-position:left -252px !important} .mmo_FI {background-position:left -266px !important} .mmo_FR {background-position:left -280px !important} .mmo_GR {background-position:left -294px !important} .mmo_HK {background-position:left -308px !important} .mmo_HR {background-position:left -322px !important} .mmo_HU {background-position:left -336px !important} .mmo_ID {background-position:left -350px !important} .mmo_IL {background-position:left -364px !important} .mmo_IN {background-position:left -378px !important} .mmo_INTL {background-position:left -392px !important} .mmo_IR {background-position:left -406px !important} .mmo_IT {background-position:left -420px !important} .mmo_JP {background-position:left -434px !important} .mmo_KE {background-position:left -448px !important} .mmo_KR {background-position:left -462px !important} .mmo_LT {background-position:left -476px !important} .mmo_LV {background-position:left -490px !important} .mmo_ME {background-position:left -504px !important} .mmo_MK {background-position:left -518px !important} .mmo_MX {background-position:left -532px !important} .mmo_NL {background-position:left -546px !important} .mmo_NO {background-position:left -560px !important} .mmo_PE {background-position:left -574px !important} .mmo_PH {background-position:left -588px !important} .mmo_PK {background-position:left -602px !important} .mmo_PL {background-position:left -616px !important} .mmo_PT {background-position:left -630px !important} .mmo_RO {background-position:left -644px !important} .mmo_RS {background-position:left -658px !important} .mmo_RU {background-position:left -672px !important} .mmo_SE {background-position:left -686px !important} .mmo_SI {background-position:left -700px !important} .mmo_SK {background-position:left -714px !important} .mmo_TH {background-position:left -728px !important} .mmo_TR {background-position:left -742px !important} .mmo_TW {background-position:left -756px !important} .mmo_UA {background-position:left -770px !important} .mmo_UK {background-position:left -784px !important} .mmo_US {background-position:left -798px !important} .mmo_VE {background-position:left -812px !important} .mmo_VN {background-position:left -826px !important} .mmo_YU {background-position:left -840px !important} .mmo_ZA {background-position:left -854px !important} div#mmonetbar a:active { top: 0; } div#mmoGamesOverviewPanel { width: 286px; position: absolute; top: 0; right: 0; font: 12px Arial, sans-serif; } div#mmoGamesOverviewPanel h4, div#mmoGamesOverviewPanel h5 { margin: 0; font-size: 12px; font-weight: bold; text-align: left; } div#mmoGamesOverviewPanel a { text-decoration: none; } div#mmoGamesOverviewPanel a img { border: none; } div#mmoGamesOverviewToggle { width: 168px; padding: 4px 0 4px 118px; } div#mmoGamesOverviewToggle h4 { height: 18px; position: relative; background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.bg.png) repeat-x 0 -36px; top: 0px; padding: 3px 20px; } div#mmoGamesOverviewToggle h4 a { display: block; width: 116px; height: 16px; line-height: 14px; text-align: left; font-weight: normal; outline: none; color: #602b0c; font-size: 11px !important; position: relative; border: 1px solid #1d707b; padding: 0 0 0 10px; } div#mmoGamesOverviewToggle h4 a.gameCountZero { cursor: default; text-align: center; padding: 0; width: 126px; } div#mmoGamesOverviewToggle h4 a span.mmoNbPseudoSelect_icon { display: block; position: absolute; top: 0; right: 0; width: 17px; height: 16px; background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -141px -8px; } span.iconTriangle { display: block; position: absolute; top: 5px; right: 10px; width: 0px; border: 5px solid transparent; border-bottom-color: #602b0c; } div#mmoGamesOverviewToggle h4 a.toggleHidden { } div#mmoGamesOverviewToggle h4 a.toggleHidden span.iconTriangle { top: 10px; border: 5px solid transparent; border-top-color: #602b0c; } div#mmoGamesOverviewToggle h4 span.mmoNbBoxEdge { display: block; width: 5px; height: 24px; background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -109px -4px; position: absolute; top: 0; } div#mmoGamesOverviewToggle h4 span.mmoNbBoxEdge_left { left: 0; } div#mmoGamesOverviewToggle h4 span.mmoNbBoxEdge_right { right: 0; background-position: -126px -4px; } div#mmoGamesOverviewLists { clear: both; background: #bed7e3; width: 284px; border: 1px solid #1d707b; float: left; position: relative; top: 0px; } div#mmoGamesOverviewLists h5 { clear: both; padding: 0 18px; height: 27px; line-height: 27px; color: #602b0c; border-bottom: 1px solid #1d707b; background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.bg.png) repeat-x 0 -3px; font-family: inherit; width: 248px; } div#mmoGamesOverviewLists ul { margin: 0; padding: 13px 0; list-style: none; width: 284px; float: left; text-align: left; } div#mmoGamesOverviewLists ul li { margin: 0; padding: 0; list-style: none; width: 138px; padding: 0 2px 1px 2px; float: left; } div#mmoGamesOverviewLists ul li a { display: block; width: 90px; padding: 0 0 0 48px; height: 24px; line-height: 24px; color: #602b0c; text-align: left; position: relative; font-size: 11px !important; } div#mmoGamesOverviewLists ul li a:focus, div#mmoGamesOverviewLists ul li a:hover { background-color: #9ec8dd; } div#mmoGamesOverviewLists ul li a img { display: block; position: absolute; top: 1px; left: 18px; } div#mmoGamesOverviewLists div#mmoGamesOverviewCountry { width: 20px; height: 14px; position: absolute; top: 6px; right: 12px; background-image: url(<?=$this->config->item('base_url')?>design/netbar/mmoflags.png); background-repeat: no-repeat; } #mmonetbar div.nojsGame { width: 432px !important; } #mmonetbar div.nojsGame div.mmoBoxMiddle { width: 422px; } #mmonetbar div.nojsGame label { width: 105px; } ');
                mmostyle.type = 'text/css';
                mmostyle.appendChild(mmostyleTxt);
        }
        document.getElementsByTagName('head')[0].appendChild(mmostyle);
        </script>

        <noscript>
            <style type="text/css">
                body {margin:0; padding:0;} #mmonetbar { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.bg.png) repeat-x; font:normal 11px Tahoma, Arial, Helvetica, sans-serif; height:32px; left:0; padding:0; position:absolute; text-align:center; top:0; width:100%; z-index:3000; } #mmonetbar #mmoContent { height:32px; margin:0 auto; width:1024px; position: relative; } #mmonetbar .mmosmallbar {width:585px !important;} #mmonetbar .mmosmallbar div.mmoBoxMiddle { width: 290px; } #mmonetbar .mmonewsout {width:800px !important;} #mmonetbar .mmouseronlineout {width:768px !important;} #mmonetbar .mmolangout {width:380px !important;} #mmonetbar .mmolangout .mmoGame { width: 265px; } #mmonetbar a { color:#666; font:normal 11px Tahoma, Arial, Helvetica, sans-serif; outline: none; text-decoration:none; white-space:nowrap; } #mmonetbar select { background-color:#bed7e3 !important; border:1px solid #1d707b !important; color:#602b0c !important; font:normal 11px Verdana, Arial, Helvetica, sans-serif; height:18px; margin-top:3px; width:100px; } #mmonetbar .mmoGames select {width:80px;} #mmonetbar option { background-color:#bed7e3 !important; color:#602b0c !important; } #mmonetbar option:hover { background-color:#9ec8dd !important; } #mmonetbar select#mmoCountry {width:120px;} #mmonetbar .mmoSelectbox { background-color:#bed7e3; float:left; margin:3px 0 0 3px; position:relative; } * html #mmonetbar .mmoSelectbox {position:static;} *+html #mmonetbar .mmoSelectbox {position:static;} #mmonetbar #mmoOneGame {cursor:default; height:14px; margin-top:3px; padding-left:5px; width:80px;} #mmonetbar .label {float:left; font-weight:bold; margin-right:4px; overflow:hidden !important;} #mmonetbar #mmoUsers .label {font-size:10px;} #mmonetbar .mmoBoxLeft, #mmonetbar .mmoBoxRight { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -109px -4px; float:left; width:5px; height:24px; } #mmonetbar .mmoBoxRight {background-position:-126px -4px;} #mmonetbar .mmoBoxMiddle { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.bg.png) repeat-x 0 -36px; color:#602b0c !important; float:left; height:24px; line-height:22px; text-align:left; white-space:nowrap; } #mmonetbar #mmoGames, #mmonetbar #mmoLangs {margin:0px 4px 0 0;} #mmonetbar #mmoNews, #mmonetbar #mmoUsers, #mmonetbar #mmoGame, #mmonetbar .nojsGame {margin:4px 4px 0 0;} #mmonetbar #mmoLogo { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat top left; float:left; display:block; height:32px; width:108px; } #mmonetbar #mmoNews {float:left; width:252px;} #mmonetbar #mmoNews #mmoNewsContent {text-align:left; width:200px;} #mmonetbar #mmoNews #mmoNewsticker {overflow:hidden; width:240px;} #mmonetbar #mmoNews #mmoNewsticker ul { list-style-type: none; margin: 0; padding: 0px; } #mmonetbar #mmoNews #mmoNewsticker ul li { font:normal 11px/22px Tahoma, Arial, Helvetica, sans-serif !important; color:#602b0c !important; padding: 0px; margin: 0; } #mmonetbar #mmoNews #mmoNewsticker ul li a {color:#602b0c !important;} #mmonetbar #mmoNews #mmoNewsticker ul li a:hover {text-decoration:underline;} #mmonetbar #mmoUsers {float:left; width:178px;} #mmonetbar #mmoUsers .mmoBoxLeft {width:17px;} #mmonetbar #mmoUsers .mmoBoxMiddle {padding-left:3px; width:150px;} #mmonetbar .mmoGame {display:none; float:left; width:432px;} #mmonetbar .mmoGame #mmoGames {float:left; width:206px;} #mmonetbar .mmoGame #mmoLangs {float:left; margin:0; width:252px;} #mmonetbar .mmoGame label { color:#602b0c !important; float:left; font-weight:400 !important; line-height:22px; margin:0px; text-align:right !important; width:110px; font-size: 11px !important; } #mmonetbar .nojsGame {display:block; width:470px;} #mmonetbar .nojsGame .mmoBoxMiddle {width:450px;} #mmonetbar .nojsGame .mmoSelectbox {margin:0px 0 0 3px;} *+html #mmonetbar .nojsGame .mmoSelectbox {margin:2px 0 0 3px;} * html #mmonetbar .nojsGame .mmoSelectbox {margin:2px 0 0 3px;} #mmonetbar .nojsGame .mmoGameBtn { background:transparent url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -162px -7px; border:none; cursor:pointer; float:left; height:18px; margin:3px 0 0 7px; padding:0; width:18px; } #mmonetbar .mmoSelectArea { border:1px solid #1d707b; color:#602b0c !important; display:block !important; float:none; font-weight:400 !important; font-size:11px; height:16px; line-height:13px; overflow:hidden !important; width:90px; } #mmonetbar #mmoLangSelect .mmoSelectArea {width:129px;} #mmonetbar #mmoLangSelect { z-index: 10000; position: relative; } #mmonetbar #mmoLangSelect .mmoOptionsDivVisible {min-width:129px;} #mmonetbar .mmoSelectArea .mmoSelectButton { background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -141px -8px; float:right; width:17px; height:16px; } #mmonetbar .mmoSelectText {cursor:pointer; float:left; overflow:hidden; padding:1px 2px; width:68px;} #mmonetbar #mmoLangSelect .mmoSelectText {width:107px;} #mmonetbar #mmoOneLang {cursor:default; height:14px;} #mmonetbar div.mmoOneLang { background: none; } #mmonetbar div.mmoOneLang #mmoOneLang { border: none; padding: 2px 3px; } #mmonetbar .mmoOptionsDivInvisible, #mmonetbar .mmoOptionsDivVisible { background-color: #bed7e3 !important; border: 1px solid #1d707b; position: absolute; min-width:90px; z-index: 3100; } * html #mmonetbar .mmoOptionsDivVisible .highlight {background-color:#9ec8dd !important} #mmonetbar .mmoOptionsDivInvisible {display: none;} #mmonetbar .mmoOptionsDivVisible ul { border:0; font:normal 11px Tahoma, Arial, Helvetica, sans-serif; list-style: none; margin:0; padding:2px; overflow:auto; overflow-x:hidden; } #mmonetbar #mmoLangs .mmoOptionsDivVisible ul {min-width:125px;} #mmonetbar .mmoOptionsDivVisible ul li { background-color: #bed7e3; height:14px; padding:2px 0; } #mmonetbar .mmoOptionsDivVisible a { color: #602b0c !important; display: block; font-weight:400 !important; height:16px !important; min-width:80px; text-decoration: none; white-space:nowrap; width:100%; } #mmonetbar #mmoContent .mmoLangList a {min-width:102px;} #mmonetbar .mmoOptionsDivVisible li:hover {background-color: #9ec8dd;} #mmonetbar .mmoOptionsDivVisible li a:hover {color: #602b0c !important;} #mmonetbar .mmoOptionsDivVisible li.mmoActive {background-color: #9ec8dd !important;} #mmonetbar .mmoOptionsDivVisible li.mmoActive a {color: #602b0c !important;} #mmonetbar .mmoOptionsDivVisible ul.mmoListHeight {height:240px} #mmonetbar .mmoOptionsDivVisible ul.mmoLangList.mmoListHeight li {padding-right:15px !important; width:100%;} #mmonetbar #mmoGameSelect ul.mmoListHeight a {min-width:85px;} #mmonetbar #mmoLangSelect ul.mmoListHeight a {min-width:105px;} #mmonetbar #mmoFocus {position:absolute;left:-2000px;top:-2000px;} #mmonetbar #mmoLangs .mmoSelectText span, #mmonetbar #mmoLangs .mmoflag { background: transparent url(<?=$this->config->item('base_url')?>design/netbar/mmoflags.png) no-repeat; height:14px !important; padding-left:23px; } .mmo_AE {background-position:left 0px !important} .mmo_AR {background-position:left -14px !important} .mmo_BE {background-position:left -28px !important} .mmo_BG {background-position:left -42px !important} .mmo_BR {background-position:left -56px !important} .mmo_BY {background-position:left -70px !important} .mmo_CA {background-position:left -84px !important} .mmo_CH {background-position:left -98px !important} .mmo_CL {background-position:left -112px !important} .mmo_CN {background-position:left -126px !important} .mmo_CO {background-position:left -140px !important} .mmo_CZ {background-position:left -154px !important} .mmo_DE {background-position:left -168px !important} .mmo_DK {background-position:left -182px !important} .mmo_EE {background-position:left -196px !important} .mmo_EG {background-position:left -210px !important} .mmo_EN {background-position:left -224px !important} .mmo_ES {background-position:left -238px !important} .mmo_EU {background-position:left -252px !important} .mmo_FI {background-position:left -266px !important} .mmo_FR {background-position:left -280px !important} .mmo_GR {background-position:left -294px !important} .mmo_HK {background-position:left -308px !important} .mmo_HR {background-position:left -322px !important} .mmo_HU {background-position:left -336px !important} .mmo_ID {background-position:left -350px !important} .mmo_IL {background-position:left -364px !important} .mmo_IN {background-position:left -378px !important} .mmo_INTL {background-position:left -392px !important} .mmo_IR {background-position:left -406px !important} .mmo_IT {background-position:left -420px !important} .mmo_JP {background-position:left -434px !important} .mmo_KE {background-position:left -448px !important} .mmo_KR {background-position:left -462px !important} .mmo_LT {background-position:left -476px !important} .mmo_LV {background-position:left -490px !important} .mmo_ME {background-position:left -504px !important} .mmo_MK {background-position:left -518px !important} .mmo_MX {background-position:left -532px !important} .mmo_NL {background-position:left -546px !important} .mmo_NO {background-position:left -560px !important} .mmo_PE {background-position:left -574px !important} .mmo_PH {background-position:left -588px !important} .mmo_PK {background-position:left -602px !important} .mmo_PL {background-position:left -616px !important} .mmo_PT {background-position:left -630px !important} .mmo_RO {background-position:left -644px !important} .mmo_RS {background-position:left -658px !important} .mmo_RU {background-position:left -672px !important} .mmo_SE {background-position:left -686px !important} .mmo_SI {background-position:left -700px !important} .mmo_SK {background-position:left -714px !important} .mmo_TH {background-position:left -728px !important} .mmo_TR {background-position:left -742px !important} .mmo_TW {background-position:left -756px !important} .mmo_UA {background-position:left -770px !important} .mmo_UK {background-position:left -784px !important} .mmo_US {background-position:left -798px !important} .mmo_VE {background-position:left -812px !important} .mmo_VN {background-position:left -826px !important} .mmo_YU {background-position:left -840px !important} .mmo_ZA {background-position:left -854px !important} div#mmonetbar a:active { top: 0; } div#mmoGamesOverviewPanel { width: 286px; position: absolute; top: 0; right: 0; font: 12px Arial, sans-serif; } div#mmoGamesOverviewPanel h4, div#mmoGamesOverviewPanel h5 { margin: 0; font-size: 12px; font-weight: bold; text-align: left; } div#mmoGamesOverviewPanel a { text-decoration: none; } div#mmoGamesOverviewPanel a img { border: none; } div#mmoGamesOverviewToggle { width: 168px; padding: 4px 0 4px 118px; } div#mmoGamesOverviewToggle h4 { height: 18px; position: relative; background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.bg.png) repeat-x 0 -36px; top: 0px; padding: 3px 20px; } div#mmoGamesOverviewToggle h4 a { display: block; width: 116px; height: 16px; line-height: 14px; text-align: left; font-weight: normal; outline: none; color: #602b0c; font-size: 11px !important; position: relative; border: 1px solid #1d707b; padding: 0 0 0 10px; } div#mmoGamesOverviewToggle h4 a.gameCountZero { cursor: default; text-align: center; padding: 0; width: 126px; } div#mmoGamesOverviewToggle h4 a span.mmoNbPseudoSelect_icon { display: block; position: absolute; top: 0; right: 0; width: 17px; height: 16px; background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -141px -8px; } span.iconTriangle { display: block; position: absolute; top: 5px; right: 10px; width: 0px; border: 5px solid transparent; border-bottom-color: #602b0c; } div#mmoGamesOverviewToggle h4 a.toggleHidden { } div#mmoGamesOverviewToggle h4 a.toggleHidden span.iconTriangle { top: 10px; border: 5px solid transparent; border-top-color: #602b0c; } div#mmoGamesOverviewToggle h4 span.mmoNbBoxEdge { display: block; width: 5px; height: 24px; background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.sprites.png) no-repeat -109px -4px; position: absolute; top: 0; } div#mmoGamesOverviewToggle h4 span.mmoNbBoxEdge_left { left: 0; } div#mmoGamesOverviewToggle h4 span.mmoNbBoxEdge_right { right: 0; background-position: -126px -4px; } div#mmoGamesOverviewLists { clear: both; background: #bed7e3; width: 284px; border: 1px solid #1d707b; float: left; position: relative; top: 0px; } div#mmoGamesOverviewLists h5 { clear: both; padding: 0 18px; height: 27px; line-height: 27px; color: #602b0c; border-bottom: 1px solid #1d707b; background: url(<?=$this->config->item('base_url')?>design/netbar/netbar.bg.png) repeat-x 0 -3px; font-family: inherit; width: 248px; } div#mmoGamesOverviewLists ul { margin: 0; padding: 13px 0; list-style: none; width: 284px; float: left; text-align: left; } div#mmoGamesOverviewLists ul li { margin: 0; padding: 0; list-style: none; width: 138px; padding: 0 2px 1px 2px; float: left; } div#mmoGamesOverviewLists ul li a { display: block; width: 90px; padding: 0 0 0 48px; height: 24px; line-height: 24px; color: #602b0c; text-align: left; position: relative; font-size: 11px !important; } div#mmoGamesOverviewLists ul li a:focus, div#mmoGamesOverviewLists ul li a:hover { background-color: #9ec8dd; } div#mmoGamesOverviewLists ul li a img { display: block; position: absolute; top: 1px; left: 18px; } div#mmoGamesOverviewLists div#mmoGamesOverviewCountry { width: 20px; height: 14px; position: absolute; top: 6px; right: 12px; background-image: url(<?=$this->config->item('base_url')?>design/netbar/mmoflags.png); background-repeat: no-repeat; } #mmonetbar div.nojsGame { width: 432px !important; } #mmonetbar div.nojsGame div.mmoBoxMiddle { width: 422px; } #mmonetbar div.nojsGame label { width: 105px; }
            </style>
        </noscript>
<div id="mmonetbar" class="mmoikariam">
<script type="text/javascript">
var mmoActive_select=null;function mmoInitSelect(){if(!document.getElementById)return false;document.getElementById('mmonetbar').style.display='block';document.getElementById('mmoGame').style.display='block';document.getElementById('mmoFocus').onkeyup=function(e){mmo_selid=mmoActive_select.id.replace('mmoOptionsDiv','');var e=e||window.event;if(e.keyCode)var thecode=e.keyCode;else if(e.which)var thecode=e.which;mmoSelectMe(mmo_selid,thecode);}}
function mmoSelectMe(selid,thecode){var mmolist=document.getElementById('mmoList'+selid);var mmoitems=mmolist.getElementsByTagName('li');switch(thecode){case 13:mmoShowOptions(selid);window.location=mmoActive_select.url;break;case 38:mmoActive_select.activeit.className='';var minus=((mmoActive_select.activeid-1)<=0)?'0':(mmoActive_select.activeid-1);mmoActive_select=mmoSetActive(selid,minus);break;case 40:mmoActive_select.activeit.className='';var plus=((mmoActive_select.activeid+1)>=mmoitems.length)?(mmoitems.length-1):(mmoActive_select.activeid+1);mmoActive_select=mmoSetActive(selid,plus);break;default:thecode=String.fromCharCode(thecode);var found=false;for(var i=0;i<mmoitems.length;i++){var _a=mmoitems[i].getElementsByTagName('a');if(navigator.appName.indexOf("Explorer")>-1){}
else{txtContent=_a[0].textContent;}
if(!found&&(thecode.toLowerCase()==txtContent.charAt(0).toLowerCase())){mmoActive_select.activeit.className='';mmoActive_select=mmoSetActive(selid,i);found=true;}}
break;}}
function mmoSetActive(selid,itemid){mmoActive_select=null;var mmolist=document.getElementById('mmoList'+selid);var mmoitems=mmolist.getElementsByTagName('li');mmoActive_select=document.getElementById('mmoOptionsDiv'+selid);;mmoActive_select.selid=selid;if(itemid!=undefined){var _a=mmoitems[itemid].getElementsByTagName('a');var textVar=document.getElementById("mmoMySelectText"+selid);textVar.innerHTML=_a[0].innerHTML;if(selid==1)textVar.className=_a[0].className;mmoitems[itemid].className='mmoActive';}
for(var i=0;i<mmoitems.length;i++){if(mmoitems[i].className=='mmoActive'){mmoActive_select.activeit=mmoitems[i];mmoActive_select.activeid=i;mmoActive_select.url=(mmoitems[i].getElementsByTagName('a'))?mmoitems[i].getElementsByTagName('a')[0].href:null;}}
return mmoActive_select;}
function mmoShowOptions(g){var _elem=document.getElementById("mmoOptionsDiv"+g);if((mmoActive_select)&&(mmoActive_select!=_elem)){mmoActive_select.className="mmoOptionsDivInvisible";document.getElementById('mmonetbar').focus();}
if(_elem.className=="mmoOptionsDivInvisible"){document.getElementById('mmoFocus').focus();mmoActive_select=mmoSetActive(g);if(document.documentElement){document.documentElement.onclick=mmoHideOptions;}else{window.onclick=mmoHideOptions;}
_elem.className="mmoOptionsDivVisible";}else if(_elem.className=="mmoOptionsDivVisible"){_elem.className="mmoOptionsDivInvisible";document.getElementById('mmonetbar').focus();}}
function mmoHideOptions(e){if(mmoActive_select){if(!e)e=window.event;var _target=(e.target||e.srcElement);if((_target.id.indexOf('mmoOptionsDiv')!=-1))return false;if(mmoisElementBefore(_target,'mmoSelectArea')==0&&(mmoisElementBefore(_target,'mmoOptionsDiv')==0)){mmoActive_select.className="mmoOptionsDivInvisible";mmoActive_select=null;}}else{if(document.documentElement)document.documentElement.onclick=function(){};else window.onclick=null;}}
function mmoisElementBefore(_el,_class){var _parent=_el;do _parent=_parent.parentNode;while(_parent&&(_parent.className!=null)&&(_parent.className.indexOf(_class)==-1))
return(_parent.className&&(_parent.className.indexOf(_class)!=-1))?1:0;}
var ua=navigator.userAgent.toLowerCase();var ie6browser=((ua.indexOf("msie 6")>-1)&&(ua.indexOf("opera")<0))?true:false;function highlight(el,mod){if(ie6browser){if(mod==1&&!el.className.match(/highlight/))el.className=el.className+' highlight';else if(mod==0)el.className=el.className.replace(/highlight/g,'');}}
var mmoToggleDisplay={init:function(wrapper){var wrapper=document.getElementById(wrapper);if(!wrapper)return;var headline=wrapper.getElementsByTagName("h4")[0],link=headline.getElementsByTagName("a")[0];if(link.className.indexOf("gameCountZero")!=-1)return false;var panel=document.getElementById(link.hash.substr(1));mmoToggleDisplay.hidePanel(panel,link);link.onclick=function(e){mmoToggleDisplay.toggle(this,panel);return false;};mmoToggleDisplay.outerClick(wrapper,link,panel);var timeoutID=null,delay=8000;wrapper.onmouseout=function(e){if(!e){var e=window.event;}
var reltg=(e.relatedTarget)?e.relatedTarget:e.toElement;if(reltg==wrapper||mmoToggleDisplay.isChildOf(reltg,wrapper)){return;}
timeoutID=setTimeout(function(){mmoToggleDisplay.hidePanel(panel,link);},delay);};wrapper.onmouseover=function(e){if(timeoutID){clearTimeout(timeoutID);}};},isChildOf:function(child,parent){while(child&&child!=parent){child=child.parentNode;}
if(child==parent){return true;}else{return false;}},hidePanel:function(panel,link){panel.style.display="none";link.className="toggleHidden";},toggle:function(link,panel){panel.style.display=panel.style.display=="none"?"block":"none";link.className=link.className=="toggleHidden"?"":"toggleHidden";},outerClick:function(wrapper,link,panel){document.body.onclick=function(e){if(!e){e=window.event};if(!(mmoToggleDisplay.isChildOf((e.target||e.srcElement),wrapper))&&panel.style.display!="none"){mmoToggleDisplay.toggle(link,panel);}}}}
</script>

    <div id="mmoContent" class="mmonewsout">
        <!-- logo -->
        <!--<a id="mmoLogo" href="http://us.mmogame.com?kid=1-29845-03845-1003-1011218a"></a>-->

        <div id="mmoNews">
			<div class="mmoBoxLeft"></div>
			<div class="mmoBoxMiddle" onmouseover="mmoTickHalt=true;" onmouseout="mmoTickHalt=false;">
				<div class="mmoNewsContent">
					<div id="mmoNewsticker">
						<ul>
							<li><center><?=$this->config->item('head_news')?></center></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="mmoBoxRight"></div>
		</div>
        <div id="mmoGame" class="mmoGame">
            <div class="mmoBoxLeft"></div>
            <div class="mmoBoxMiddle">
                <!--<div id="mmoGames"></div>-->
                <div id="mmoLangs">
                    <label><?=$this->lang->line('select_lang')?></label>
                    <div id="mmoLangSelect" class="mmoSelectbox">
                        <div id="mmoSarea1" onclick="mmoShowOptions(1)" class="mmoSelectArea">
                            <div class="mmoSelectText" id="mmoMySelectContent1">
                                <div id="mmoMySelectText1" class="mmoflag mmo_US"><?if($this->session->userdata('language')!=''){?><?=ucfirst($this->session->userdata('language'))?><?}else{?><?=ucfirst($this->config->item('language'))?><?}?></div>
                            </div>
                            <div class="mmoSelectButton"></div>
                        </div>
                        <div class="mmoOptionsDivInvisible" id="mmoOptionsDiv1">
                            <ul class="mmoLangList mmoListHeight" id="mmoList1">
                                <li <?if($this->session->userdata('language') == 'english' or $this->session->userdata('language') == ''){?>class="mmoActive"<?}?>><a href="<?=$this->config->item('base_url')?>main/language/english/" target="_top" class="mmoflag mmo_US">English</a></li>
                                <li <?if($this->session->userdata('language') == 'russian'){?>class="mmoActive"<?}?>><a href="<?=$this->config->item('base_url')?>main/language/russian/" target="_top" class="mmoflag mmo_RU">Russian</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mmoBoxRight"></div>
            <div id="mmoGamesOverviewPanel">
            </div>
        </div>
	<input id="mmoFocus" type="text" size="5" />
    </div>
</div>

<script type="text/javascript">mmoInitSelect();</script>
<!-- #/MMO:NETBAR# -->
    </div>

    <div id="wrapper">
        <div id="page" >
            <div id="header">
                <a id="btn-login" class="btn-login" href="javascript:void(0)" title="<?=$this->lang->line('login')?>"><?=$this->lang->line('login')?></a>
                    <div id="loginWrapper">
                        <div class="boxTop"></div>
                        <div class="boxMiddle" id="login">
                            <form id="loginForm" name="loginForm" method="post" action="<?=$this->config->item('base_url')?>">
                                <input name="action" type="hidden" value="login">
                                <div class="input-wrap">
                                    <label for="logServer"><?=$this->lang->line('world')?></label>
                                    <select name="universe" id="logServer" class="validate[required]">
                                        <option class="" value="alpha" fbUrl="" cookieName="" cookiePW="">Alpha</option>
                                    </select>
                                </div>

                                <div class="input-wrap">
                                    <label for="loginName"><?=$this->lang->line('name')?></label>
                                    <input id="loginName" name="name" type="text" value="" class="validate[required]">
                                </div>
                                <div class="input-wrap">
                                    <label for="loginPassword"><?=$this->lang->line('password')?></label>
                                    <input id="loginPassword" name="password" type="password" value="" class="validate[required]" />
                                </div>
                                <button type="submit" id="loginBtn" class="btn-login btn-big"><?=$this->lang->line('login')?></button>
<?if ($this->config->item('game_email')){?>
                                <a id="pwLost" class="login-lnk" href="javascript:void(0)" title="<?=$this->lang->line('link_lost_title')?>"><?=$this->lang->line('link_lost_text')?></a>
<?}else{?><br><br><br><?}?>
                            </form>
                        </div>
                        <div class="boxBottom"></div>
                    </div>
                <h2 id="logo"><a id="logoimg" href="<?=$this->config->item('base_url')?>"><?=$this->lang->line('ikariam')?></a></h2>
                </div>
                <div id="container">
                    <div id="sidebarWrapper">
                        <div id="sidebarTop"></div>
                        <div id="sidebar" class="clearfix">
                            <img src="<?=$this->config->item('base_url')?>design/blank.gif"  id="major" width="233" height="228" alt="major">                            <div id="registerWrapper" class="clearfix">
                                <div id="registerTop"></div>
                                <div id="register">
                                    <h1><?=$this->lang->line('register_free')?></h1>
                                    <form id="registerForm" name="registerForm" action="<?=$this->config->item('base_url')?>" method="post">
                                    <input name="action" type="hidden" value="register">
                                    <div class="input-wrap">
                                        <label for="registerName"><?=$this->lang->line('name')?></label>
                                        <input id="registerName" name="name" type="text" value="" class="validate[required,custom[noSpecialCaracters],length[3,30]]" />
                                    </div>
                                    <div class="input-wrap">
                                        <label for="password"><?=$this->lang->line('password')?></label>
                                        <input id="password" name="password" type="password" value="" class="validate[required,pwLength[8,30]]" />
                                    </div>
                                    <div id="securePwd"><div class="valid-icon invalid"></div><p><?=$this->lang->line('password_safety')?></p><div class="securePwdBarBox"><div id="securePwdBar"></div></div><br class="clearfloat" /></div>
                                    <div class="input-wrap">
                                        <label for="email"><?=$this->lang->line('email')?></label>
                                        <input id="email" name="email" type="text" value="" class="validate[required,custom[email]]" />
                                    </div>
                                    <div class="input-wrap">
                                        <label for="registerServer"><?=$this->lang->line('world')?></label>
                                        <select name="universe" id="registerServer" class="validate[required]">
                                            <option  class="" value="alpha" fbUrl="" cookieName="" cookiePW="">Alpha</option>
                                        </select>
                                    </div>
                                    <div class="input-wrap">
                                        <input id="agb" name="agb" type="checkbox" class="agb validate[required]" value="on">
                                        <input id="agb" name="agb" type="hidden" value="on">

                                            <span for="agb" class="agb"><?=$this->lang->line('register_accept')?></span>

                                            <input type="submit" id="regBtn" class="reg-btn" value="<?=$this->lang->line('register_button')?>"/>
                                                                                        
                                    </div>
                                    </form>
                                </div>
                                <div id="registerBottom"></div>
                            </div>
                        </div>
                        <div id="sidebarBottom"></div>
                    </div>
                    <div id="content">
                        <div id="contentTop">
                            <div id="menuBox">
                                <div class="lnkmenu">
                                </div>
                                <ul id="menu" class="clearfix">
                                    <li><a id="tab1" class="current" href="<?=$this->config->item('base_url')?>/main/page/index_4"><?=$this->lang->line('link_home_text')?></a>/li>
                                    <li><a id="tab2" href="<?=$this->config->item('base_url')?>/main/page/gametour_extended"><?=$this->lang->line('link_tour_text')?></a></li>
                                    <li><a id="tab3" href="<?=$this->config->item('base_url')?>/main/page/media"><?=$this->lang->line('link_media_text')?></a></li>
                                    <li><a id="tab4" href="<?=$this->config->item('base_url')?>/main/page/rules"><?=$this->lang->line('rules')?></a></li>

                                </ul>
                            </div>
                        </div>

                        <div id="contentMiddle" class="clearfix">
                            <div id="pageContentWrapper">
                                <div id="pageContentTop"></div>
                                <div id="pageContent" class="page-content clearfix">
<?require_once('main/index_4.php')?>
                                </div>

                                <div id="extraContent" class="page-content">
                                    <!-- AJAX INHALTE WERDEN GELADEN -->
                                </div>
                                <div id="pageContentBottom"></div>
                            </div>
                        </div>
                        <div id="contentBottom"></div>
                    </div>
                </div>
                <br class="clearfloat" />
        </div>
        <!-- Backgrounds -->
        <div id="sunWrapper"><div id="sun"></div></div>
            <div id="sky">
                        
                <div id="clouds-1"></div>
                <div id="clouds-2"></div>
                <div id="clouds-3"></div>
                <div id="birds"></div>
                <div id="baloon"></div>
            </div>
            <div id="water"></div>
            <div id="ship-1" class="ship"></div>
            <div id="ship-2" class="ship"></div>
            <div id="submarine" class="ship"></div>
            <div id="island-left" class="islands"></div>
            <div id="island-right" class="islands"></div>
            <div class="push"></div>

        </div>

    <div id="footer-wrapper">
        <div id="footer">
            <div id="footer-inner">
                        <div id="footer-menu" class="clearfix">
                            <ul	class="clearfix">
                            </ul>
                            <p class="copyright">© 2010 by Nexus.</p>
                        </div>
                    </div>
                </div>
            </div>

        <script type="text/javascript">
            /* validation.engine: localisation */
            (function($) {
                $.fn.validationEngineLanguage = function() {};
                $.validationEngineLanguage = {
                    newLang: function() {
                        $.validationEngineLanguage.allRules = 	{
                            "required":{ 
                                "regex":"none",
                                "alertText":"* <?=$this->lang->line('field_required')?>",
                                "alertTextCheckboxMultiple":"* <?=$this->lang->line('error_order')?>",
                                "alertTextCheckboxe":"* <?=$this->lang->line('error_order')?>"},
                            "length":{ 
                                "regex":"none",
                                "alertText":"* <?=$this->lang->line('error_name_length')?>"},
                            "pwLength":{ // Password-Length
                                "regex":"none",
                                "alertText":"* <?=$this->lang->line('error_password_length')?>"},
                            "email":{
                                "regex":"/^[a-zA-Z0-9_\\.\\-]+\\@([a-zA-Z0-9\\-]+\\.)+[a-zA-Z0-9]{2,4}$/", // modified
                                "alertText":"* <?=$this->lang->line('error_email2')?>"},
                            "noSpecialCaracters":{
                                "regex":"/[^ \\\\\\+\\.\\\"\\'%\\$\\(\\)\\[\\]\\{\\}<>&;,\\?\\^\\*\\|\\/]+$/",
                                "alertText":"* <?=$this->lang->line('no_special')?>"}
                        }
                    }
                }
            })(jQuery);
            $(document).ready(function() {
            });

    $('#pwLost').click(function(){
        showPasswordLost('http://us.ikariam.com/ajax/main/passwordlost') ;
        $('#btn-login').removeClass('open').text(window.txt_login);
    });

            window.language = '<?=$this->lang->line('content')?>' ;
            window.txt_login = '<?=$this->lang->line('login')?>' ;
            window.txt_close = '<?=$this->lang->line('close')?>' ;
            window.use_login_cookies = '' ;
            window.ieSpecial = false;

        </script>


    <script type="text/javascript">
    function fbConnect() {
            FB.init("", "xd_receiver.htm",{"reloadIfSessionStateChanged":true});
    }

    function agbCheck() {

        if(document.getElementById('agb').checked != true) {
            alert("<?=$this->lang->line('error_order')?>");
        } else {
            redirectToCreateAvatar();
        }
    }

    function extendedEmailPermission() {
        //alert(FB);
        FB.Connect.showPermissionDialog("email", extendedEmailPermissionCallback);
    }

    function extendedEmailPermissionCallback(perms) {
        //alert("great! "+perms);
        //agbCheck();
        //window.location.href = 'http://' + document.getElementById('universe').value + '/index.php?action=newPlayer&function=createFBAvatar';
        redirectToCreateAvatar()    }

    function redirectToCreateAvatar() {
        window.location.href = 'http://' + document.getElementById('fbRegisterServer').value + '/index.php?action=newPlayer&function=createFBAvatar';
    }

    function fbLoginAndEmailPermission() {

        FB.Connect.requireSession( function() {
            // callback session success
            extendedEmailPermission() ;
        }, function() {
            // callback session fail
            //alert( 'false' ) ;
        } ) ;
    }

</script>


<!-- BEGIN: Tracking --><img src="http://analytics.gameforge.de/cp.php?game=ikariam&lang=us&gr=1&action=visit&kid=" style="display:none" /><img src="http://adsm.gameforge.de/init.gif?kid=" style="display:none" /><img src="http://adsm2.gameforge.de/init.gif?kid=" style="display:none" /><!-- END: Tracking -->    </body>
</html> 