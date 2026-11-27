<?php

require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/Lobby.php';

class Invitation
{
    public static function send($lobby, $sender, $receiver)
    {
        if (!Lobby::isMember($lobby, $sender)) {
            return;
        }

        $db = Database::connect();

        $q = $db->prepare("INSERT INTO invitations (lobby_id, sender_id, receiver_id) VALUES (?, ?, ?)");
        $q->execute([$lobby, $sender, $receiver]);
    }

    public static function incoming($user)
    {
        $db = Database::connect();

        $q = $db->prepare(
            "SELECT i.*, l.title, u.username AS sender
             FROM invitations i
             JOIN lobbies l ON i.lobby_id = l.id
             JOIN users u ON i.sender_id = u.id
             WHERE i.receiver_id = ?
             ORDER BY i.id DESC"
        );
        $q->execute([$user]);

        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function accept($id, $user)
    {
        $db = Database::connect();

        $q = $db->prepare("SELECT * FROM invitations WHERE id = ? AND receiver_id = ? AND status = 'pending'");
        $q->execute([$id, $user]);
        $i = $q->fetch(PDO::FETCH_ASSOC);

        if ($i) {
            Lobby::join($i['lobby_id'], $user);

            $q = $db->prepare("UPDATE invitations SET status = 'accepted' WHERE id = ?");
            $q->execute([$id]);
        }
    }

    public static function decline($id, $user)
    {
        $db = Database::connect();

        $q = $db->prepare("UPDATE invitations SET status = 'declined' WHERE id = ? AND receiver_id = ?");
        $q->execute([$id, $user]);
    }
}