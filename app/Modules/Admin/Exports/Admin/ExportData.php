<?php

namespace Admin\Exports\Admin;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportData implements FromCollection
{
    private $records;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        $records = $this->records;
        $data = collect([]);
        $data->push(['Id', 'Name', 'Email', 'Phone', 'Privilege', 'Created By', 'Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->name,
                $record->email,
                $record->phone,
                $record->privileges,
                $record->createdBy ? $record->createdBy->name :"",
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
