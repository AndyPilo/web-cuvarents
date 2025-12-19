<?php
// src/models/User.php
class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM Accounts 
            WHERE account_email = :email 
            LIMIT 1
        ");
        $stmt->execute(['email' => $email]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function register(array $data): bool
    {
        $query = "
            INSERT INTO Accounts 
                (account_username, account_email, account_password, account_prefix_phone, account_number_phone, account_rango)
            VALUES 
                (:username, :email, :password, :prefix, :number, 1)
        ";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'prefix'   => $data['prefix'],
            'number'   => $data['number'],
        ]);
    }

    public function login(string $email, string $password): false|array
    {
        $user = $this->findByEmail($email);

        if ($user && password_verify($password, $user['account_password'])) {
            return $user;
        }

        return false;
    }
}
