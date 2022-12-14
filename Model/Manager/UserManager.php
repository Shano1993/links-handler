<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\User;

class UserManager
{
    public const TABLE = 'user';

    /**
     * @param array $data
     * @return User
     */
    public static function makeUser(array $data): User
    {
        return (new User())
            ->setId($data['id'])
            ->setUsername($data['username'])
            ->setEmail($data['email'])
            ->setPassword($data['password']);
    }

    /**
     * @param int $id
     * @return User|null
     */
    public static function getUser(int $id): ?User
    {
        $request = DB::getPDO()->query("SELECT * FROM " . self::TABLE . " WHERE id = $id");
        return $request ? self::makeUser($request->fetch()) : null;
    }

    /**
     * @param string $email
     * @return bool
     */
    public static function mailUserExist(string $email): bool
    {
        $request = DB::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE email = '".$email."'");
        return $request ? $request->fetch()['cnt'] : 0;
    }

    /**
     * @param string $username
     * @return bool
     */
    public static function usernameUserExist(string $username): bool
    {
        $request = DB::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE username = '".$username."'");
        return $request ? $request->fetch()['cnt'] : 0;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public static function getUserByMail(string $email): ?User
    {
        $stmt = DB::getPDO()->prepare("SELECT * FROM " . self::TABLE . " WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        return $stmt->execute() ? self::makeUser($stmt->fetch()) : null;
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function addUser(User &$user): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO " . self::TABLE . " (username, email, password)
            VALUES (:username, :email, :password)
        ");

        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());

        $result = $stmt->execute();
        $user->setId(DB::getPDO()->lastInsertId());
        return $result;
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function userExist(int $id): bool
    {
        $request = DB::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE id = $id");
        return $request ? $request->fetch()['cnt'] : 0;
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function deleteAccount(User $user): bool
    {
        if (self::userExist($user->getId())) {
            return DB::getPDO()->exec("DELETE FROM " . self::TABLE . " WHERE id = {$user->getId()}");
        }
        return false;
    }
}
