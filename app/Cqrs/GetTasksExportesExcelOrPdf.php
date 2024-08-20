<?php

namespace App\Cqrs;

use App\Models\Tasks;
use Barryvdh\DomPDF\Facade\Pdf;


class GetTasksExportesExcelOrPdf
{
    public function get(int $projectId, null|string $de, null|string $ate, null|string $status, string $type): object
    {

        $querie = Tasks::select('titulo', 'id', 'status', 'data_encerramento')->where('project_id', $projectId);

        if ($status) {
            $querie->where('status', $status);
        }

        if ($de) {
            $querie->where('data_encerramento', '>=', $de);
        }

        if ($ate) {
            $querie->where('data_encerramento', '<=', $ate);
        }

        $tasks = $querie->lazy();
        $filename = uniqid('relatotio') . '.csv';
        $data = [
            ['Titulo', 'status', 'vencimento'],
        ];
        foreach ($tasks as $key => $value) {
            array_push($data, [$value->titulo, $value->status, $value->data_encerramento]);
        }

        if ($type == 'excel') {


            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            $output = fopen('php://output', 'w');

            foreach ($data as $row) {
                fputcsv($output, $row);
            }
            fclose($output);
            exit;
        }

        $pdf = Pdf::loadView('pdf.tasks', ['tasks' => $data]);
        $filename = 'relatorio_' . uniqid() . '.pdf';
        return $pdf->download($filename);
    }
}
