<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public static function getAll(string $category = '', int $price = 0) {
        $products = json_decode('[
            {
              "sku": "000001",
              "name": "Full coverage insurance",
              "category": "insurance",
              "price": 89000
            },
            {
              "sku": "000002",
              "name": "Compact Car X3",
              "category": "vehicle",
              "price": 99000
            },
            {
              "sku": "000003",
              "name": "SUV Vehicle, high end",
              "category": "vehicle",
              "price": 150000
            },
            {
              "sku": "000004",
              "name": "Basic coverage",
              "category": "insurance",
              "price": 20000
            },
            {
              "sku": "000005",
              "name": "Convertible X2, Electric",
              "category": "vehicle",
              "price": 250000
            }
          ]');

          $finalProducts = [];
          foreach ($products as $product) {
                $originalPrice = $product->price;
                $finalPrice = $product->price;
                $discount = 0;
                if ($product->category === "insurance") {
                    $discount = 30;
                }
                if ($product->sku === "000003") {
                    $discount = 15;
                }
                if ($category) {
                    if ($product->category !== $category) {
                        continue;
                    }
                }
                if ($price) {
                    if ($originalPrice !== $price) {
                        continue;
                    }
                }
                $finalPrice = $originalPrice - ($originalPrice * ($discount / 100));
                $product->price = [
                    "original" => $originalPrice,
                    "final" => $finalPrice,
                    "discount_percentage" => $discount ? $discount ."%" : null,
                    "currency" => "EUR"
                ];
                $finalProducts []= $product;
          }
          return $finalProducts;
    }
}
