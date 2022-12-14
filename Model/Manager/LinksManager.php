<?php

namespace App\Model\Manager;

use App\Controller\UserController;
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
            ->setTitleLinks($data['title'])
            ->setLinksUser(UserManager::getUser($data['user_fk']))
            ;
    }

    /**
     * @return array
     */
    public static function getAll(): array
    {
        $links = [];
        $request = DB::getPDO()->query("SELECT * FROM " . self::TABLE . " ORDER BY title ASC");

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
            INSERT INTO " . self::TABLE . " (image, name, title, user_fk)
            VALUES (:image, :name, :title, :author)
        ");

        $stmt->bindValue(':image', $links->getLinksImage());
        $stmt->bindValue(':name', $links->getLinksName());
        $stmt->bindValue(':title', $links->getTitleLinks());
        $stmt->bindValue(':author', $links->getLinksUser()->getId());

        $result = $stmt->execute();
        $links->setId(DB::getPDO()->lastInsertId());
        return $result;
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function linksExist(int $id): bool
    {
        $result = DB::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE id = $id");
        return $result ? $result->fetch()['cnt'] : 0;
    }

    /**
     * @param Links $links
     * @return bool
     */
    public static function deleteLinks(Links $links): bool
    {
        if (self::linksExist($links->getId())) {
            return DB::getPDO()->exec("DELETE FROM " . self::TABLE . " WHERE id = {$links->getId()}");
        }
        return false;
    }
}
