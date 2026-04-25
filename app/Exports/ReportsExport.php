<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $reports;

    public function __construct($reports)
    {
        $this->reports = $reports;
    }

    public function collection()
    {
        return $this->reports;
    }

    public function headings(): array
    {
        return [
            'Report ID',
            'Category',
            'Date',
            'Client Name',
            'Client Contact',
            'Case Title',
            'Status',
            'User Name',
            'Created At'
        ];
    }

    public function map($report): array
    {
        return [
            $report->report_id,
            $report->category->name ?? 'N/A',
            $report->date,
            $report->client_name,
            $report->client_contact,
            $report->case_title,
            $report->status,
            $report->user->name ?? 'N/A',
            $report->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
