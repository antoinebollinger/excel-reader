<?php 
namespace Abollinger\PHPStarter\Controller;

use \PhpOffice\PhpSpreadsheet\IOFactory;

class Controller extends FrontendController
{
    public function __construct(
		$params = null
	) {
		parent::__construct($params);

        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if(isset($_FILES['excel']['name']) && in_array($_FILES['excel']['type'], $file_mimes)) {
            $spreadsheet = IOFactory::load($_FILES["excel"]["tmp_name"]);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
        }

        $this->renderView("excel.twig", [
            "_files" => $_FILES ?? [],
            "excel" => $sheetData ?? []
        ]);
    }
}