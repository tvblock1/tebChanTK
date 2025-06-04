<?php

class Post {
    public int $id;
    public string $image;
    public string $content;
    public int $parent;
    public array $comments = [];

    public function __construct(int $id, string $image, string $content, int $parent) {
        $this->id = $id;
        $this->image = $image;
        $this->content = $content;
        $this->parent = $parent;
    }
    public static function add(string $image, string $content, int $parent): bool {
        $db = new mysqli('localhost', 'root', '', 'tebchan');
        $stmt = $db->prepare('INSERT INTO post (image, content, parent) VALUES (?, ?, ?)');
        $stmt->bind_param('ssi', $image, $content, $parent);
        return $stmt->execute();
    }
    public static function getList(int $parent = 0): array {
        $db = new mysqli('localhost', 'root', '', 'tebchan');
        $stmt = $db->prepare('SELECT * FROM post WHERE parent = ?');
        $stmt->bind_param('i', $parent);
        $stmt->execute();
        $result = $stmt->get_result();
        $posts = [];
        while($row = $result->fetch_assoc()) {
            $post = new Post($row['id'], $row['image'], $row['content'], $row['parent']);
            $posts[] = $post;
        }
        return $posts;
    }
    public static function get(int $id): Post|null {
        $db = new mysqli('localhost', 'root', '', 'tebchan');
        $stmt = $db->prepare('SELECT * FROM post WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($row = $result->fetch_assoc()) {
            $post = new Post($row['id'], $row['image'], $row['content'], $row['parent']);
            $post->comments = self::getList($row['id']);
            return $post;
        }
        return null;
    }
}
?>