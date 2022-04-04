<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Models\SystemAudit;

class AuditController extends BackendController
{
    public function index()
    {
        $perPage = request()->per_page && (request()->per_page > 0 && request()->per_page <= 30) ? request()->per_page: 20;

        $systemAudits = SystemAudit::orderBy('updated_at', 'DESC')->paginate($perPage);

        return $this->view('system-audits.index', [
            'systemAudits' => $systemAudits,
            'perPage' => $perPage
        ]);
    }
}
