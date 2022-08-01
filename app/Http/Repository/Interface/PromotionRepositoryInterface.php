<?php

namespace App\Http\Repository\Interface;

interface PromotionRepositoryInterface {

    public function  storePromotion($request);

    public function  getPromotion();

    public function  destroy($id);

}
