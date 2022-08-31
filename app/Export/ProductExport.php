<?php

namespace App\Export;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements WithMapping,WithHeadings,FromCollection
{
    protected $Objects;

    public function __construct($Objects)
    {
        $this->Objects = $Objects;
    }

    public function map($object): array
    {
        $arr['id'] = $object->id;
        $arr['vendor_name'] = $object->vendor_name;
        $arr['category_name'] = $object->category_name;
        $arr['sub_category_name'] = $object->sub_category_name;
        $arr['brand_name'] = $object->brand_name;
        $arr['product_type_name'] = $object->product_type_name;
        $arr['type'] = $object->type;
        $arr['quantity'] = $object->quantity;
        $arr['cost_price'] = $object->cost_price;
        $arr['profit_rate'] = $object->profit_rate;
        $arr['sell_price'] = $object->sell_price;
        $arr['discount'] = $object->discount;
        $arr['status'] = $object->status;
        $arr['sold_quantity'] = $object->sold_quantity;
        $arr['note'] = $object->note;
        $arr['created_at'] = $object->created_at;
        return $arr;
    }

    public function collection()
    {
        return $this->Objects;
    }

    public function headings(): array
    {
        $heading = array();
        array_push($heading,'#');
        array_push($heading,'Vendor');
        array_push($heading,'Category');
        array_push($heading,'Sub Category');
        array_push($heading,'Brand');
        array_push($heading,'Product Name');
        array_push($heading,'Type');
        array_push($heading,'Quantity');
        array_push($heading,'Cost Price');
        array_push($heading,'Profit Rate');
        array_push($heading,'Sell Price');
        array_push($heading,'Discount');
        array_push($heading,'Status');
        array_push($heading,'Sold Quantity');
        array_push($heading,'Note');
        array_push($heading,'Create Date');
        return $heading;
    }
}
