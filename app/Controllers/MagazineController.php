<?php

namespace App\Controllers;

use App\Models\MagazineModel;

class MagazineController extends BaseController
{
    public function index()
    {
        $magazineModel = new MagazineModel();
        $data['magazines'] = $magazineModel->findAll();

        return view('magazines/index', $data);
    }

    public function details($id)
    {
        $magazineModel = new MagazineModel();
        $data['magazine'] = $magazineModel->find($id);

        return view('details_page', $data);
    }
}
