<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Products;
use App\Models\SalesDet;
use App\Models\SalesMstr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
  public function save_products(Request $r)
  {
    return DB::transaction(function () use ($r) {
      if ($r->id == 0) {
        Products::insert([
          'desc' => $r->desc,
          'um' => $r->um,
          'stock' => $r->stock,
          'price' => $r->price,
          'image' => $r->file('image')->getClientOriginalName(),
        ]);
        $r->file('image')->move('./../assets', strtolower(str_replace(' ', '', $r->file('image')->getClientOriginalName())));
      } else {
        Products::where('id', $r->id)->update([
          'desc' => $r->desc,
          'um' => $r->um,
          'stock' => $r->stock,
          'price' => $r->price,
        ]);

        if (!empty($r->image)) {
          Products::where('id', $r->id)->update([
            'image' => $r->file('image')->getClientOriginalName(),
          ]);
          $r->file('image')->move('./../assets', strtolower(str_replace(' ', '', $r->file('image')->getClientOriginalName())));
        }
      }
    });
  }

  public function get_products()
  {
    return Products::all();
  }

  public function delete_products(Request $r)
  {
    Products::where('id', $r->id)->delete();
  }

  public function get_customers()
  {
    return Customers::all();
  }

  public function delete_customers(Request $r)
  {
    Customers::where('id', $r->id)->delete();
  }

  public function save_customers(Request $r)
  {
    return DB::transaction(function () use ($r) {
      if ($r->id == 0) {
        Customers::insert([
          'name' => $r->name,
          'phone' => $r->phone,
          'email' => $r->email,
          'address' => $r->address,
          'discount' => $r->discount,
          'discount_type' => $r->discount_type,
          'discount_value' => $r->discount_value,
          'ktp' => $r->file('ktp')->getClientOriginalName(),
        ]);
        $r->file('ktp')->move('./../assets', strtolower(str_replace(' ', '', $r->file('ktp')->getClientOriginalName())));
      } else {
        Customers::where('id', $r->id)->update([
          'name' => $r->name,
          'phone' => $r->phone,
          'email' => $r->email,
          'address' => $r->address,
          'discount' => $r->discount,
          'discount_type' => $r->discount_type,
          'discount_value' => $r->discount_value,
        ]);

        if (!empty($r->file('ktp'))) {
          Customers::where('id', $r->id)->update([
            'ktp' => $r->file('ktp')->getClientOriginalName(),
          ]);
          $r->file('ktp')->move('./../assets', strtolower(str_replace(' ', '', $r->file('ktp')->getClientOriginalName())));
        }
      }
    });
  }

  public function save_transactions(Request $r)
  {
    return DB::transaction(function () use ($r) {
      $dataHedaer = SalesMstr::create([
        // 'code' => $r->code,
        'date' => date("Y-m-d"),
        'customer' => $r->header['customer'],
        'total_discount' => $r->header['total_discount'],
        'total_amount' => $r->header['total_amount'],
        'total_pay' => $r->header['total_pay'],
      ]);

      foreach ($r->detail as $value) {
        SalesDet::create([
          'sales_idmstr' => $dataHedaer->id,
          'product' => $value['product'],
          'qty' => $value['qty'],
          'price' => $value['price'],
          'subtotal' => $value['subtotal'],
        ]);
      }
      return  $dataHedaer->id;
    });
  }

  public function check_stock_product(Request $r)
  {
    $product = Products::where('id', $r->id)->first();
    if (empty($product)) {
      return response(array('message' => 'Produk tidak ditemukan'), 406);
    }

    if ($r->qty > $product->stock) {
      return response(array('message' => 'Stok tidak mencukupi'), 406);
    }
  }
}
