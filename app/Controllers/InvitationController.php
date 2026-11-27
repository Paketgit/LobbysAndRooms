<?php

require_once __DIR__ . '/../Models/Invitation.php';

class InvitationController
{
    public function index()
    {
        $invitations = Invitation::incoming($_SESSION['user']['id']);
        require __DIR__ . '/../Views/invitations.php';
    }

    public function send()
    {
        Invitation::send(
            $_POST['lobby_id'],
            $_SESSION['user']['id'],
            $_POST['receiver_id']
        );

        header('Location: /?page=lobby&id=' . $_POST['lobby_id']);
        exit;
    }

    public function accept()
    {
        Invitation::accept($_POST['invitation_id'], $_SESSION['user']['id']);

        header('Location: /?page=invitations');
        exit;
    }

    public function decline()
    {
        Invitation::decline($_POST['invitation_id'], $_SESSION['user']['id']);

        header('Location: /?page=invitations');
        exit;
    }
}