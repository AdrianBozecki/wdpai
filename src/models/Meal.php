<?php


class Meal
{
    private $title;
    private $preparation;
    private $ingredients;
    private $image;
    private $category;


    public function __construct($title, $preparation, $ingredients, $image, $category)
    {
        $this->title = $title;
        $this->preparation = $preparation;
        $this->ingredients = $ingredients;
        $this->image = $image;
        $this->category = $category;
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
