<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Links;

class LinksManager
{
    public const TABLE = 'links';

    /**
     * @param array $data
     * @return Links
     */
    public static function makeLinks(array $data): Links
    {
        return (new Links())
            ->setId($data['id'])
            ->setLinksImage($data['image'])
            ->setLinksName($data['name'])
            ->setLinksUser(UserManager::getUser($data['user_fk']))
            ;
    }

    /**
     * @return array
     */
    public static function getAll(): array
    {
        $links = [];
        $request = DB::getPDO()->query("SELECT * FROM " . self::TABLE . " ORDER BY id DESC");

        if ($request) {
            foreach ($request->fetchAll() as $data) {
                $links[] = self::makeLinks($data);
            }
        }
        return $links;
    }

    /**
     * @param int $id
     * @return Links|null
     */
    public static function getLinks(int $id): ?Links
    {
        $result = DB::getPDO()->query("SELECT * FROM " . self::TABLE . " WHERE id = $id");
        return $result ? self::makeLinks($result->fetch()) : null;
    }

    /**
     * @param Links $links
     * @return bool
     */
    public static function addNewLinks(Links &$links): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO " . self::TABLE . " (image, name, user_fk)
            VALUES (:image, :name, :author)
        ");

        $stmt->bindValue(':image', $links->getLinksImage());
        $stmt->bindValue(':name', $links->getLinksName());
        $stmt->bindValue(':author', $links->getLinksUser()->getId());

        $result = $stmt->execute();
        $links->setId(DB::getPDO()->lastInsertId());
        return $result;
    }
}
