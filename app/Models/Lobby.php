<?php

require_once __DIR__ . '/../Database.php';

class Lobby
{
    public static function all()
    {
        $db = Database::connect();

        return $db->query(
            "SELECT l.*, u.username,
                (SELECT COUNT(*) FROM members m WHERE m.lobby_id = l.id) AS player_count
             FROM lobbies l
             JOIN users u ON l.owner_id = u.id"
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($title, $game, $owner, $max)
    {
        $db = Database::connect();

        $q = $db->prepare("INSERT INTO lobbies (title, game, owner_id, max_players) VALUES (?, ?, ?, ?)");
        $q->execute([$title, $game, $owner, $max]);

        $id = $db->lastInsertId();

        $q = $db->prepare("INSERT INTO members (lobby_id, user_id) VALUES (?, ?)");
        $q->execute([$id, $owner]);
    }

    public static function join($lobby, $user)
    {
        $db = Database::connect();

        $q = $db->prepare("SELECT max_players FROM lobbies WHERE id = ?");
        $q->execute([$lobby]);
        $room = $q->fetch(PDO::FETCH_ASSOC);

        if (!$room) {
            return false;
        }

        $q = $db->prepare("SELECT COUNT(*) FROM members WHERE lobby_id = ?");
        $q->execute([$lobby]);

        if ($q->fetchColumn() >= $room['max_players']) {
            return false;
        }

        $q = $db->prepare("INSERT IGNORE INTO members (lobby_id, user_id) VALUES (?, ?)");
        $q->execute([$lobby, $user]);

        return true;
    }

    public static function members($id)
    {
        $db = Database::connect();

        $q = $db->prepare(
            "SELECT users.id, users.username
             FROM members
             JOIN users ON members.user_id = users.id
             WHERE members.lobby_id = ?"
        );
        $q->execute([$id]);

        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function isMember($lobby, $user)
    {
        $db = Database::connect();

        $q = $db->prepare("SELECT id FROM members WHERE lobby_id = ? AND user_id = ?");
        $q->execute([$lobby, $user]);

        return $q->fetch() !== false;
    }
}