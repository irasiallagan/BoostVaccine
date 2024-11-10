<?php

require_once '../core/Database.php';

class User
{
    public $UserID;
    public $Name;
    public $Email;
    public $Password;
    public $PhoneNumber;
    public $IsAdmin;

    public function __construct()
    {
        // Koneksi database dapat diinisialisasi di sini
    }

    // public static function all()
    // {
    //     $db = Database::getInstance();
    //     $stmt = $db->query("SELECT * FROM User");
    //     return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    // }

    public static function all_users()
    {
        // Asumsi koneksi database sudah diatur
        $db = Database::getInstance(); // Koneksi database
        $query = $db->query("SELECT * FROM User"); // Sesuaikan nama tabel jika berbeda
        return $query->fetchAll(PDO::FETCH_ASSOC); // Mengambil semua hasil sebagai array asosiatif
    }
    // public static function all_users()
    // {
    //     $db = Database::getConnection();
    //     $query = $db->query("SELECT id, Name, Email, PhoneNumber, IsAdmin FROM users");
    //     return $query->fetchAll(PDO::FETCH_ASSOC);
    // }

    public static function get_user_by_id($user_id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update_user($user_id, $data)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE users SET Name = ?, Email = ?, PhoneNumber = ?, IsAdmin = ? WHERE id = ?");
        return $stmt->execute([$data['Name'], $data['Email'], $data['PhoneNumber'], $data['IsAdmin'], $user_id]);
    }

    public static function delete_user($user_id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$user_id]);
    }

    public function save()
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO User (Name, Email, Password, PhoneNumber) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$this->Name, $this->Email, $this->Password, $this->PhoneNumber]);
    }




    public static function findByEmail($email)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM User WHERE Email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchObject('User');
    }
}
