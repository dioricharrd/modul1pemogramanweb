<?php
namespace Controller;

class ProductController {
    public function getAllProduct() {
        return [
            "code" => 200,
            "message" => "Success",
            "data" => [
                "controller_attribute" => [
                    "ControllerName" => "Get All Products",
                    "Method" => "GET"
                ],
                "product" => [
                    "Air Mineral",
                    "Kebab",
                    "Bakso",
                    "Jus Jambu"
                ]
            ]
        ];
    }
}