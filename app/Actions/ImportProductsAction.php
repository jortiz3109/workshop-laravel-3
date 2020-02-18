<?php

namespace App\Actions;

use App\Exceptions\ImportException;
use App\Imports\ProductsImport;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportProductsAction
{
    private $importFile;
    public function execute(): int
    {
        $productsImport = new ProductsImport;
        $productsImport->import($this->importFile);

        return count($productsImport->toArray($this->importFile)[0]);
    }

    public function setImportFile($importFile)
    {
        $this->importFile = $importFile;

        return $this;
    }
}
