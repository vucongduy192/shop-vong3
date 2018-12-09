<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $datas = [
      [
        "id" => "3",
        "category_id" => "1",
        "description" => "Chất lượng tốt",
        "name" => "Áo thun Nam 10001L",
        "quantity" => "30",
        "price" => "300000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ],
      [
        "id" => "4",
        "category_id" => "2",
        "description" => "chất lượng rất tốt",
        "name" => "Áo sơ mi Nam 24007L",
        "quantity" => "20",
        "price" => "350000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ],
      [
        "id" => "5",
        "category_id" => "5",
        "description" => "chất lượng tốt",
        "name" => "Đầm nữ 23000XL",
        "quantity" => "30",
        "price" => "510000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ],
      [
        "id" => "6",
        "category_id" => "3",
        "description" => "quần short đời mới",
        "name" => "Quần short nữ 10034XL",
        "quantity" => "12",
        "price" => "50000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ],
      [
        "id" => "7",
        "category_id" => "5",
        "description" => "đầm Trung Quốc",
        "name" => "Đầm nữ 46000L",
        "quantity" => "20",
        "price" => "250000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ],
      [
        "id" => "8",
        "category_id" => "1",
        "description" => "chất liệu và thiết kết tốt",
        "name" => "Áo thun nữ 2000XS",
        "quantity" => "5",
        "price" => "450000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ],
      [
        "id" => "9",
        "category_id" => "2",
        "description" => "Chất liệu tốt",
        "name" => "Áo sơ mi Nữ 57000XL",
        "quantity" => "40",
        "price" => "650000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ],
      [
        "id" => "10",
        "category_id" => "1",
        "description" => "thiết kế đẹp",
        "name" => "Áo thun Nam 10045XL",
        "quantity" => "30",
        "price" => "150000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ],
      [
        "id" => "11",
        "category_id" => "3",
        "description" => "thiết kế đẹp",
        "name" => "Quần short Nam 7811XL",
        "quantity" => "29",
        "price" => "560000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ],
      [
        "id" => "12",
        "category_id" => "2",
        "description" => "tốt",
        "name" => "Áo sơ mi Nam 1600XL",
        "quantity" => "10",
        "price" => "100000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ],
      [
        "id" => "13",
        "category_id" => "4",
        "description" => "chất lượng tốt",
        "name" => "Quần Jean Nam 1998101",
        "quantity" => "10",
        "price" => "100000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ],
      [
        "id" => "14",
        "category_id" => "1",
        "description" => "tốt",
        "name" => "Áo thun Nam 20147XL",
        "quantity" => "10",
        "price" => "200000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ],
      [
        "id" => "15",
        "category_id" => "1",
        "description" => "Mẫu mới nhất 2018",
        "name" => "Áo thun Adidas 2018",
        "quantity" => "5",
        "price" => "500000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ],
      [
        "id" => "16",
        "category_id" => "4",
        "description" => "Loại mới nhất",
        "name" => "Quần bò Nam 2018",
        "quantity" => "13",
        "price" => "1000000",
        "img1" => "default.png",
        "img2" => "default.png",
        "img3" => "default.png",
      ]
    ];

    foreach ($datas as $data) {
      \App\Product::create($data);
    }
  }
}
