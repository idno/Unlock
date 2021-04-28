<h2>
    <a href="<?= $vars['object']->getDisplayUrl() ?>"><?= $vars['object']->getTitle() ?></a>
</h2>
<?php

    if ($vars['object']->unlockTeaser) {
?>
    <p>
        <?=$vars['object']->unlockTeaser?>
    </p>
<?php
    }

?>
<p>
    <a href="<?= $vars['object']->getDisplayUrl() ?>">Unlock to read more ...</a>
</p>
