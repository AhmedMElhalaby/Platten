<?php

namespace App\Export;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderExport implements WithMapping,WithHeadings,FromCollection
{
    protected $Objects;

    public function __construct($Objects)
    {
        $this->Objects = $Objects;
    }

    public function map($object): array
    {
        $arr['id'] = $object->id;
        $arr['customer_name'] = $object->customer_name;
        $arr['vendor_name'] = $object->vendor_name;
        $arr['have_discount'] = $object->have_discount;
        $arr['discount_amount'] = $object->discount_amount;
        $arr['cost'] = $object->cost;
        $arr['amount'] = $object->amount;
        $arr['total_amount'] = $object->total_amount;
        $arr['recipient_name'] = $object->recipient_name;
        $arr['mobile'] = $object->mobile;
        $arr['address'] = $object->address;
        $arr['lat'] = $object->lat;
        $arr['lng'] = $object->lng;
        $arr['map_address'] = $object->map_address;
        $arr['status'] = $object->status;
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
        array_push($heading,'Customer');
        array_push($heading,'Vendor');
        array_push($heading,'Have Discount');
        array_push($heading,'Discount Amount');
        array_push($heading,'Cost');
        array_push($heading,'Amount');
        array_push($heading,'Total Amount');
        array_push($heading,'Recipient Name');
        array_push($heading,'Mobile');
        array_push($heading,'Address');
        array_push($heading,'Lat');
        array_push($heading,'Lng');
        array_push($heading,'Map Address');
        array_push($heading,'Status');
        array_push($heading,'Create Date');
        return $heading;
    }
}
