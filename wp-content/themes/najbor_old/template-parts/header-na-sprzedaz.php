<?php
$language = get_site_language();
$available = ml_for_sale();

echo $available[$language];
?>
