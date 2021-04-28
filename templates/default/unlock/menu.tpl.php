<li <?php if ($_SERVER['REQUEST_URI'] == '/admin/unlock/') echo 'class="active"'; ?>><a
            href="<?php echo \Idno\Core\Idno::site()->config()->url ?>admin/unlock/"><?php echo \Idno\Core\Idno::site()->language()->_('Unlock'); ?></a>
</li>
