<?php

namespace App\Model\Entity;

class Links extends AbstractEntity
{
    private string $linksName;
    private string $linksImage;
    private User $linksUser;

    /**
     * @return string
     */
    public function getLinksName(): string
    {
        return $this->linksName;
    }

    /**
     * @param string $linksName
     * @return Links
     */
    public function setLinksName(string $linksName): self
    {
        $this->linksName = $linksName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLinksImage(): string
    {
        return $this->linksImage;
    }

    /**
     * @param string $linksImage
     * @return Links
     */
    public function setLinksImage(string $linksImage): self
    {
        $this->linksImage = $linksImage;
        return $this;
    }

    /**
     * @return User
     */
    public function getLinksUser(): User
    {
        return $this->linksUser;
    }

    /**
     * @param User $linksUser
     * @return Links
     */
    public function setLinksUser(User $linksUser): self
    {
        $this->linksUser = $linksUser;
        return $this;
    }
}
