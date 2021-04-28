<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <?php echo $this->draw('admin/menu') ?>

        <h1>
            <img src="https://unlock-protocol.com/static/images/unlock-word-mark.png" alt="Unlock"
                 style="max-height: 35px"/>
        </h1>

        <p class="explanation" style="margin-top: 35px">
            Unlock is a protocol for membership on the web. You can protect individual posts, or your whole site, with
            a <em>lock</em>; readers purchase <em>keys</em> to gain access.
        </p>

        <form action="<?php echo \Idno\Core\Idno::site()->config()->getDisplayURL() ?>admin/unlock/" method="post"
              enctype="multipart/form-data">
            <h3>
                Manage locks
            </h3>
            <p>
                Getting started with Unlock just takes a few moments.
                <a href="https://unlock-protocol.com/">Click here to create or manage your locks.</a>
            </p>

            <h3>
                Add a lock to one or more posts
            </h3>
            <p>
                Save lock addresses below and they will be made available to select when editing and saving posts.
            </p>

            <div id="unlockList">
                <div class="row">
                <?php

                $unlockLocks = \Idno\Core\Idno::site()->config()->unlockLocks;
                if (!empty($unlockLocks) && is_array($unlockLocks)) {
                    foreach ($unlockLocks as $addr => $name) {

                        ?>
                        <div class="form-group">
                            <div class="col-md-5"><input type="text" name="unlockLockNames[]"
                                                         value="<?php echo htmlspecialchars($name) ?>"
                                                         placeholder="<?php echo htmlentities(\Idno\Core\Idno::site()->language()->_('Lock name')); ?>"
                                                         class="form-control"/></div>
                            <div class="col-md-5"><input type="text" name="unlockLockAddrs[]"
                                                         value="<?php echo htmlspecialchars($addr) ?>"
                                                         placeholder="0x.." class="form-control"/>
                            </div>
                            <div class="col-md-2" style="margin-top: 0.75em">
                                <small><a href="#"
                                          onclick="$(this).parent().parent().parent().remove(); return false;"><?php echo \Idno\Core\Idno::site()->language()->_('Remove'); ?></a>
                                </small>
                            </div>
                        </div>
                        <?php

                    }
                }

                ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-5"><input type="text" name="unlockLockNames[]"
                                                 value=""
                                                 placeholder="<?php echo htmlentities(\Idno\Core\Idno::site()->language()->_('Lock name')); ?>"
                                                 class="form-control"/>
                    </div>
                    <div class="col-md-5"><input type="text" name="unlockLockAddrs[]"
                                                 value=""
                                                 placeholder="0x.." class="form-control"/>
                    </div>
                    <div class="col-md-2" style="margin-top: 0.75em">
                        <small>
                            <a href="#"
                               onclick="$(this).parent().parent().parent().remove(); return false;"><?php echo \Idno\Core\Idno::site()->language()->_('Remove'); ?></a>
                        </small>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-2" style="margin-top: 0.75em">
                    <p>
                        <small><a href="#"
                                  onclick="$('#unlockList').append($('#form-unlock-template').html()); return false;">+
                                <?php echo \Idno\Core\Idno::site()->language()->_('Add more'); ?></a></small>
                    </p>
                </div>
            </div>

            <h3>
                Add a site-wide lock
            </h3>
            <p>
                To add a site-wide lock, paste its address below. All pages will be locked with an Unlock paywall.
            </p>
            <div class="row">
                <div class="col-md-2">
                    <p><label class="control-label"
                              for="name"><strong><?php echo \Idno\Core\Idno::site()->language()->_('Site lock'); ?></strong></label>
                    </p>
                </div>
                <div class="col-md-4">
                    <input type="text" id="name"
                           placeholder="0x.."
                           class="input col-md-4 form-control" name="unlockLock"
                           value="<?php echo htmlspecialchars(\Idno\Core\Idno::site()->config()->unlockLock) ?>">
                </div>
                <div class="col-md-6">
                    <p class="config-desc"><?php echo \Idno\Core\Idno::site()->language()->_('Paste the lock address from your Unlock dashboard'); ?></p>
                </div>
            </div>
            <div class="controls-save">
                <button type="submit"
                        class="btn btn-primary"><?php echo \Idno\Core\Idno::site()->language()->_('Save updates'); ?></button>
            </div>
            <?php echo \Idno\Core\Idno::site()->actions()->signForm('/admin/unlock/') ?>
    </div>
    </form>

    <div id="form-unlock-template" style="display:none">
        <div class="row">
            <div class="form-group">
                <div class="col-md-5"><input type="text" name="unlockLockNames[]"
                                             value=""
                                             placeholder="<?php echo htmlentities(\Idno\Core\Idno::site()->language()->_('Lock name')); ?>"
                                             class="form-control"/></div>
                <div class="col-md-5"><input type="text" name="unlockLockAddrs[]"
                                             value=""
                                             placeholder="0x.." class="form-control"/>
                </div>
                <div class="col-md-2" style="margin-top: 0.75em">
                    <small>
                        <a href="#"
                           onclick="$(this).parent().parent().parent().remove(); return false;"><?php echo \Idno\Core\Idno::site()->language()->_('Remove'); ?></a>
                    </small>
                </div>
            </div>
        </div>
    </div>

</div>
