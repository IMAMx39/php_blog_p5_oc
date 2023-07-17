<?php

namespace App\Model;

class Post
{

    private int $id;
    private string $title;
    private string $head;
    private string $content;
    private mixed $createdAt;
    private mixed $updatedAt;
    private string $author;

    private array $comments = [];

    /**
     * @return mixed
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;

    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;

    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @param string $head
     * @return Post
     */
    public function setHead(string $head): self
    {
        $this->head = $head;
        return $this;

    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Post
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;

    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getCreatedAt() : \DateTime
    {
        return new \DateTime($this->createdAt);
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;

    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;

    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function getComments(): array
    {
        return $this->comments;
    }

    public function setComments(array $comments) :self
    {
        $this->comments = $comments;

        return $this;
    }
}
