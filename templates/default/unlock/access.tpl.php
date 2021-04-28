<?php

$unlockLock = $vars['object']->unlockLock ? $vars['object']->unlockLock : '';
$unlockTeaser = $vars['object']->unlockTeaser ? $vars['object']->unlockTeaser : '';
$locks = \Idno\Core\Idno::site()->config()->unlockLocks;
$options = ['' => \Idno\Core\Idno::site()->language()->_('Public')];
if (!empty($locks)) {
    foreach($locks as $lock => $name) {
        $options[$lock] = $name;
    }
}

if (!$vars['object'] instanceof \IdnoPlugins\Status\Status) {
    ?>
    <p style="float:right"><a href="https://unlock-protocol.com/">Manage locks</a></p>
    <label for="unlockLock">Unlock lock</label>
    <?php echo $this->__([
        'name' => 'unlockLock',
        'id' => 'unlockLock',
        'placeholder' => \Idno\Core\Idno::site()->language()->_('Are you going?'),
        'value' => $unlockLock,
        'class' => 'form-control',
        'options' => $options,
        'required' => true
    ])->draw('forms/input/select'); ?>
    <br clear="all">
    <label for="unlockTeaser">Teaser text for free readers</label>
    <input type="text" id="unlockTeaser" placeholder="Why should they read your post?"
           class="input col-md-4 form-control" name="unlockTeaser"
           value="<?php echo htmlspecialchars($unlockTeaser) ?>" style="margin-bottom: 25px">
    <?php
}
