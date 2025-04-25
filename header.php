<? /* require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); 
$APPLICATION->SetTitle("Lab"); */
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); 
?>

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
			<a href="/local/lab/" class="ga-nav main active">Главная</a>
			<a href="/local/lab/my_application" class="ga-nav application">Мои заявки</a>
			<a href="/local/lab/tasks" class="ga-nav tasks">В работе</a>
			<a href="/local/lab/" class="ga-nav reports">Отчёты</a>
			<a href="/local/lab/" class="ga-nav archive">Архив</a>
			<a href="/local/lab/contacts/" class="ga-nav contacts">Контакты</a>
		</div>
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