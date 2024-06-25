<?php

namespace Admin\Exports\Task;

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
        $data->push(['Id', 'Name', 'Status','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->name,
                $record->status == 1 ? "Encrypted":"Decrypted",
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
