<?php

namespace App\Export;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomerExport implements WithMapping,WithHeadings,FromCollection
{
    protected $Objects;

    public function __construct($Objects)
    {
        $this->Objects = $Objects;
    }

    public function map($object): array
    {
        $arr['id'] = $object->id;
        $arr['name'] = $object->name;
        $arr['email'] = $object->email;
        $arr['mobile'] = $object->mobile;
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
        array_push($heading,'Name');
        array_push($heading,'Email');
        array_push($heading,'Mobile');
        array_push($heading,'Create Date');
        return $heading;
    }
}
