<?php
$lang = get_site_language();
$realisation = ml_realisation();
$startYear = 2025;
$currentYear = date('Y');
$dateToShow = $startYear;
if ($startYear != $currentYear) {
    $dateToShow = $startYear.'-'.$currentYear;
}
?>
<span class="copyrights">© Wiktor Najbor <?php echo $dateToShow ?> | <?php echo $realisation[$lang]?>:&nbsp;<a href="https://github.com/DBryja" target="_blank" rel="noreferrer">Dawid Bryja</a></span>
