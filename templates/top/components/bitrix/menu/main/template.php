<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)){?>
	<div id="topmenu" class="dis-flex">
		<?foreach($arResult as $arItem){
			if(
				$arParams["MAX_LEVEL"] == 1 &&
				$arItem["DEPTH_LEVEL"] > 1
			){ 
				continue;
			}
			?>
			<?if($arItem["SELECTED"]){?>				
				<a href="<?=$arItem["LINK"]?>" class="item activ"><?=$arItem["TEXT"]?></a>				
			<?}else{?>				
				<a class="item" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>				
			<?}?>
		<?}?>
	</div>
<?}?>