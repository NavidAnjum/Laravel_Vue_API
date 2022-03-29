<?php


namespace App\Exports;

    use App\Models\User;
    use Illuminate\Contracts\View\View;
    use Maatwebsite\Excel\Concerns\FromView;

class Raw_Mat implements FromView
{
    public function view(): View
    {
        return view('layout.setting.raw_material_report', [
            'invoices' => User::all()
        ]);
    }
}
