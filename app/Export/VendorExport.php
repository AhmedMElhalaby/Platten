<?php

namespace App\Export;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VendorExport implements WithMapping,WithHeadings,FromCollection
{
    protected $Objects;

    public function __construct($Objects)
    {
        $this->Objects = $Objects;
    }

    public function map($object): array
    {
        $arr['id'] = $object->id;
        $arr['country_name'] = $object->country_name;
        $arr['city_name'] = $object->city_name;
        $arr['email'] = $object->email;
        $arr['name'] = $object->name;
        $arr['mobile'] = $object->mobile;
        $arr['nickname'] = $object->nickname;
        $arr['company_name'] = $object->company_name;
        $arr['postcode'] = $object->postcode;
        $arr['snapchat'] = $object->snapchat;
        $arr['twitter'] = $object->twitter;
        $arr['instagram'] = $object->instagram;
        $arr['facebook'] = $object->facebook;
        $arr['website'] = $object->website;
        $arr['maaroof_url'] = $object->maaroof_url;
        $arr['address'] = $object->address;
        $arr['address_alt'] = $object->address_alt;
        $arr['maroof_tax_number'] = $object->maroof_tax_number;
        $arr['is_active'] = $object->is_active;
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
        array_push($heading,'Country');
        array_push($heading,'City');
        array_push($heading,'Email');
        array_push($heading,'Name');
        array_push($heading,'Mobile');
        array_push($heading,'Nickname');
        array_push($heading,'Company Name');
        array_push($heading,'Postcode');
        array_push($heading,'Snapchat');
        array_push($heading,'Twitter');
        array_push($heading,'Instagram');
        array_push($heading,'Facebook');
        array_push($heading,'Website');
        array_push($heading,'Maaroof Url');
        array_push($heading,'Address');
        array_push($heading,'Address Alt.');
        array_push($heading,'Maroof Tax Number');
        array_push($heading,'Is Active');
        array_push($heading,'Create Date');
        return $heading;
    }
}
