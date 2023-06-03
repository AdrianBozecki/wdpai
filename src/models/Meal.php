<?php


class Meal
{
    private $title;
    private $preparation;
    private $ingredients;
    private $image;


    public function __construct($title, $preparation, $ingredients, $image)
    {
        $this->title = $title;
        $this->preparation = $preparation;
        $this->ingredients = $ingredients;
        $this->image = $image;
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
