<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?IncludeTemplateLangFile(__FILE__);?>
<!DOCTYPE html>
<html>
	<head>
		<title><?$APPLICATION->ShowTitle();?></title>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<?$APPLICATION->ShowHead();?>

		<script type='text/javascript' src='<?=SITE_TEMPLATE_PATH?>/js/jquery.js'></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		
		<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/modal.css">
		<script src="<?=SITE_TEMPLATE_PATH?>/js/script.js"></script>

		<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/styles.css">    	
	</head>

	<body>
		<?$APPLICATION->ShowPanel();?>
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
			
			<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"main", 
	array(
		"ROOT_MENU_TYPE" => "main",
		"MAX_LEVEL" => "1",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "main",
		"CHILD_MENU_TYPE" => "left"
	),
	false
);?>