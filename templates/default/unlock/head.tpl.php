<?php

$lockAddress = null;
$currentPage = \Idno\Core\Idno::site()->currentPage();

$test = $currentPage->getInput('unlockTest', false);
$lockAddress = \IdnoPlugins\Unlock\Main::getLockAddress();

if (!$currentPage->isPermalink()) return;

$entity = $currentPage->getEntity();

// If this is a page permalink and we have a lock address, display the paywall code
if (!$entity instanceof \IdnoPlugins\Status\Status)
    if ($test || $lockAddress) {
        if ($test || !\Idno\Core\Idno::site()->session()->isAdmin()) {
            ?>
            <script> (function (d, s) {
                var js = d.createElement(s),
                sc = d.getElementsByTagName(s)[0];
                js.src = "https://paywall.unlock-protocol.com/static/unlock.latest.min.js";
                sc.parentNode.insertBefore(js, sc);
              }(document, "script"));

              var unlockProtocolConfig = {
                locks: {
                  '<?=$lockAddress?>': {
                    name: '<?=\Idno\Core\Idno::site()->config()->getTitle()?>',
                  },
                },
                icon: 'https://unlock-protocol.com/static/images/svg/unlock-word-mark.svg',
                callToAction: {
                  default:
                  'Members can read all premium content.',
                },
                unlockUserAccounts: true,
              }

              window.addEventListener('unlockProtocol', function(e) {
                console.log('UNLOCK: ' + e.detail)
                if (e.detail === 'unlocked') {
                  $('#paywall').remove();
                  $('.unlock').remove();
                  $('body').css('overflow', 'scroll');
                }
              })
            </script>
            <style>
                #paywall {
                    position: fixed;
                    overflow-y: scroll;
                    top: 0; right: 0; bottom: 0; left: 0;
                    background-image: linear-gradient(rgba(200,200,200, .6), rgba(255,255,255,1));
                    z-index: 10000;

                    text-align: center;
                }

                #paywall .ctaHolder {
                    margin-top: 25vh;
                    background-color: #fff;
                    padding: 25px;
                    padding-top: 10vh;
                    width: auto;
                    height: 75vh;
                }

                #paywall .idno-content {
                    background: none;
                    width: auto;
                }

                #paywall .idno-content .ctaExplanation {
                    margin-top: 25px;
                }

                #paywall #ctaButton p {
                    font-size: 130%;
                    background-color: #ff6771;
                    color: #fff;
                    padding: 15px;
                    border-radius: 5px;
                    cursor: pointer;
                }
            </style>
            <?php
        }
    }

?>
