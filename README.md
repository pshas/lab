<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<div id="companies" class="row">
    <?php
    CModule::IncludeModule("iblock");
    $rsCompanies = CIBlockSection::GetList(
        ["SORT"=>"ASC"],
        ["IBLOCK_ID"=>$arParams["IBLOCK_ID"], "SECTION_ID"=>0, "ACTIVE"=>"Y"],
        false,
        ["ID","NAME","DESCRIPTION"]
    );
    while ($comp = $rsCompanies->Fetch()):
        $id   = (int)$comp["ID"];
        $name = htmlspecialcharsbx($comp["NAME"]);
        $desc = nl2br(htmlspecialcharsbx($comp["DESCRIPTION"]));
    ?>
    <a class="item col-md" href="/local/glab/subdivisions.php?company_id=<?= $id ?>">
        <div class="icon" style="background-image:url('<?= $templateFolder ?>/img/company.png');"></div>
        <div class="title"><?= $name ?></div>
        <div class="text"><?= $desc ?></div>
    </a>
    <?php endwhile; ?>
