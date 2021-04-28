<?php

$lockAddress = \IdnoPlugins\Unlock\Main::getLockAddress();
$test = \Idno\Core\Idno::site()->currentPage()->getInput('unlockTest');

if (!$test && $lockAddress && \Idno\Core\Idno::site()->session()->isAdmin()) {

    ?>
    <div
            style="min-height: 50px; background-color: #000; position: fixed; bottom: 0; left: 0; width: 100%; z-index: 20000">
        <div style="color: #fff; font-weight: bold; width: 100%; text-align: center; padding-top: 15px;">
            Unlock is active on this page for site visitors
            (<a href="?unlockTest=true" style="color: #efefef; font-weight: bold" target="_blank">Test</a>)
        </div>
    </div>
    <?php

}

if ($lockAddress && ($test || !\Idno\Core\Idno::site()->session()->isAdmin())) {

?>
    <div id="paywall">
        <div class="ctaHolder">
            <div class="idno-content">
                <h2>You're almost there!</h2>
                <p class="ctaExplanation">
                    This article is locked for members. To purchase a membership, click below:
                </p>
                <div id="ctaButton" class="btn" onClick="window.unlockProtocol && window.unlockProtocol.loadCheckoutModal();">
                    <p>Unlock this article</p>
                </div>
                <div class="ctaAlternative">
                    <p>
                        <a href="<?=\Idno\Core\Idno::site()->config()->getDisplayUrl();?>">Or click here to return to the homepage.</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <style>
        body {
            overflow: hidden;
        }
    </style>
<?php

}
