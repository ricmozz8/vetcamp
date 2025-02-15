<?php
$initials = substr($badgeUser->first_name, 0, 1) . substr($badgeUser->last_name, 0, 1);
?>
<div class="profile-badge"><?= $initials ?></div>