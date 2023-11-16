<?php
    include_once 'user_session.php';
    include_once 'user.php';

    $userSession = new UserSession();
    $user = new User();

    $user->setUser($userSession->getCurrentUser());

    $userId = $user->getuserId();

    if ($userId) {
        $user->statusUserStatus($userId, 'Offline');
    }

    $userSession->closeSession();

    header("location: ../../index.php");

?>