<?php
namespace App\Cqrs;

use App\Models\Tasks;

class GetTasksExportesExcel
{
    public function get(int $projectId, null|string $de, null|string $ate, null|string $status): object
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


        $filename = uniqid('relatotio').'.csv';

        $data = [
            ['Titulo', 'status', 'vencimento'],
        ];

        foreach ($tasks as $key => $value) {
            array_push($data, [$value->titulo, $value->status, $value->data_encerramento]);
        }

        // Defina os cabeçalhos para o download do arquivo
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="' . $filename . '"');

        // Crie um ponteiro para a saída PHP
        $output = fopen('php://output', 'w');

        // Escreva os dados no arquivo CSV
        foreach ($data as $row) {
            fputcsv($output, $row);
        }

        // Feche o ponteiro
        fclose($output);
        exit;
    }
}
