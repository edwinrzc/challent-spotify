<?php

namespace App\Spotify;

use App\Spotify\Interfaces\ArtistInterface;

class Artists implements ArtistInterface
{

    /**
     * var Model
     */
    protected Model $model;


    public function __construct( Model $model )
    {
        $this->model = $model;
    }

    public function getName()
    {
        return $this->model->name ?? null;
    }

    public function getId()
    {
        return $this->model->id ?? null;
    }
}