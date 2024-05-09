<?php 
namespace App\Models;

class Reviews {
    public $id;
    public $kandidaatId;
    public $review;

    public function __construct($id, $kandidaatId, $review) {
        $this->id = $id;
        $this->kandidaatId = $kandidaatId;
        $this->review = $review;
    }

}