<? /* require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); 
$APPLICATION->SetTitle("Lab"); */
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); 
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "top", // можешь назвать как угодно, но шаблон должен быть создан в /bitrix/templates/твой_шаблон/components/bitrix/menu/top/
    array(
        "ROOT_MENU_TYPE" => "top",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "left",
        "USE_EXT" => "Y",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N"
    )
);?>

<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Page\Asset;
?>
<head>
    <?php
    // Вставляем заголовки сайта
    $APPLICATION->ShowHead();
    ?>
</head>
<header>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<script src="/local/lab/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="/local/lab/form.css">
<div>

	<div id='content'>
		
			<div id='topline' class='dis-flex'>
				<div id='timer'><?=date( 'd.m.Y H:i' )?></div>
				<div id='auth'>	
					<div id='login'>
						<a class='user'><? echo $USER->GetFullName();?></a>
					</div>
				</div>
			</div>
			
			<div id='header' class='dis-flex'>
				<div id='logo'>Laboratory</div>
				<div id='search'></div>
			</div>
			<div id="navigation" class="navig">
    			<div id="menu-container">
        <?php
        $currentPage = $APPLICATION->GetCurPage(false);
        $menuItems = [
            ["link" => "/local/lab/", "class" => "ga-nav main", "text" => "Главная"],
            ["link" => "/local/lab/my_application", "class" => "ga-nav application", "text" => "Мои заявки"],
            ["link" => "/local/lab/tasks", "class" => "ga-nav tasks", "text" => "В работе"],
            ["link" => "/local/lab/", "class" => "ga-nav reports", "text" => "Отчёты"],
            ["link" => "/local/lab/", "class" => "ga-nav archive", "text" => "Архив"],
            ["link" => "/local/lab/contacts/", "class" => "ga-nav contacts", "text" => "Контакты"],
        ];

        foreach ($menuItems as $item) {
            $isActive = (strpos($currentPage, $item["link"]) === 0) ? "active" : "";
            ?>
            <a href="<?= $item["link"] ?>" class="<?= $item["class"] ?> <?= $isActive ?>"><?= $item["text"] ?></a>
            <?php
        }
        ?>
    	
				</div>
			</div>
</header>


<style>
.navig{
	height:70px;
}



.navig .ga-nav{
	width: 181px;	
	color: #fff;
	background-color: #78ccfd;
	background-image: url( ../img/menu-sepa.jpg );
	background-repeat:no-repeat;
	background-position:left;
	text-transform: uppercase;
	text-align:center;
	line-height:70px;
    font-size: 14px;
    font-weight: 400;
	cursor:pointer;
	
}

.active {
    background-color: #007bff;
    color: #fff;
}
.navig .ga-nav:first-child{
	background-image:none;
}

.navig .ga-nav.activ,
.navig .ga-nav:hover{
	background-color: #248fca;
}
body {
	box-sizing: unset;
}

#header{
	background-color: #ffffff;
	height:132px;
	align-items: center;
	justify-content: space-between;
	padding:0 45px;
}
#content{
	padding-top: 82px;
	padding-bottom: 70px;	
	margin:0 auto;
	width:1152px;
}
/**/
#topline{
    background-color: #eee;
    padding: 14px 16px 14px 27px;
	justify-content: space-between;	
}

#topline,
a{
	color: #aaa;    
    text-transform: uppercase;
    font-weight: 400;
    font-size: 11px;
    line-height: 12px;	
}

.dis-flex {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

</style>

<script>
const currentUrl = window.location.pathname;

const navLinks = document.querySelectorAll('#menu-container a');

navLinks.forEach(link => {
    if (link.getAttribute('href') === currentUrl) {
        link.classList.add('active');
    }
});
</script>