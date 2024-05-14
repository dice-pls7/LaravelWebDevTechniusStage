<?php 
namespace App\Models;

class Reviews {
    public $id;
    public $kandidaatId;
    public $bedrijfsnaam;
    public $review;

    public function __construct($id, $kandidaatId, $bedrijfsnaam, $review) {
        $this->id = $id;
        $this->kandidaatId = $kandidaatId;
        $this->bedrijfsnaam = $bedrijfsnaam;
        $this->review = $review;
    }

}