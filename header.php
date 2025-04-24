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
	<script src="/local/lab/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="/local/lab/form.css">
<div>
	<div id="top-bar" class="classic">
		<div id="page-top" class="lab-bar">
			<a id="lab-logo" href="http://172.18.2.81/local/lab/" class="lab-bar-item" title="Домашняя" style="width: 75px;" aria-label="Home link"> <i class="lab" style="position: relative; z-index: 1; color: #04aa6d; font-size: 40px" aria-hidden="true">
			LOGO </i> </a>
		</div>
	</div>

	<div id='content'>
		
			<div id='topline' class='dis-flex'>
				<div id='timer'><?=date( 'd.m.Y H:i' )?></div>
				<div id='auth'>	
					<div id='login'>
						<a data-toggle="modal" data-target="#loginModal" href=''>Вход</a>
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

.navig .item{
	width:192px;	
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
.navig .item:first-child{
	background-image:none;
}

.navig .item.activ,
.navig .item:hover{
	background-color: #248fca;
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