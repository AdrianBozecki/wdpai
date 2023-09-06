<?php


class Meal
{
    private $title;
    private $preparation;
    private $ingredients;
    private $image;
    private $category;
    private $like;
    private $dislike;
    private string $author;

    private $id;


    public function __construct($title, $preparation, $ingredients, $image, $category, $author="dupa", $like=0, $dislike=0, ?int $id = null)
    {
        $this->title = $title;
        $this->preparation = $preparation;
        $this->ingredients = $ingredients;
        $this->image = $image;
        $this->category = $category;
        $this->author = $author;
        $this->like = $like;
        $this->dislike = $dislike;
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }


    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getLike(): int
    {
        return $this->like;
    }


    public function setLike(int $like): void
    {
        $this->like = $like;
    }

    public function getDislike(): int
    {
        return $this->dislike;
    }


    public function setDislike(int $dislike): void
    {
        $this->dislike = $dislike;
    }

    public function getCategory(): string
    {
        return $this->category;
    }


    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getTitle(): string
    {
        return $this->title;
    }


    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    public function getPreparation(): string
    {
        return $this->preparation;
    }


    public function setPreparation(string $preparation): void
    {
        $this->preparation = $preparation;
    }


    public function getIngredients(): string
    {
        return $this->ingredients;
    }


    public function setIngredients(string $ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

}
