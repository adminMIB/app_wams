<?php

namespace App\Http\Controllers;

use App\Models\Opty;
use App\Models\OptyMaker;
use App\Models\ProjectMaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProjectMakerController extends Controller
{
    public function edit($id)
    {
        $pm = ProjectMaker::find($id);

        return view('dashboard.projects.modal.addEdit', compact('pm'));
    }

    public function create()
    {
        $pm = null;
        return view('dashboard.projects.modal.addEdit', compact('pm'));
    }

    public function store(Request $request)
    {
        try {
            $requestAll = $request->all();
            $requestAll['nominal'] = str_replace([".", ", "], "", $request->nominal);

            if (!empty($request->file)) {
                $requestAll['file'] = $this->saveFile($request->file('file'));
            }

            ProjectMaker::create($requestAll);

            return redirect()->back()->with([
                'message' => "Project Maker Berhasil dibuat",
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pm = ProjectMaker::find($id);
            $data = [
                "tanggal" => $request->tanggal,
                "jenis_transaksi" => $request->jenis_transaksi,
                "nama_tujuan" => $request->nama_tujuan,
                "nominal" => str_replace([".", ", "], "", $request->nominal),
                "keterangan" => $request->keterangan
            ];

            $path = public_path('uploads/projects-maker');
            if ($request->hasFile('file')) {
                $fileLama = $pm->file;

                if (!empty($fileLama)) {
                    $pathFile = $path . '/' . $fileLama;
                    if (file_exists($pathFile)) {
                        unlink($pathFile);
                    }
                }

                $data['file'] = $this->saveFile($request->file('file'));
            }

            $pm->update($data);

            return redirect()->back()->with([
                'message' => "Project Maker Berhasil diubah",
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    private function saveFile($request)
    {
        $path = public_path('uploads/projects-maker');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $file = $request;
        $file_ext = $file->extension();
        $file_name = time() . '.' . $file_ext;
        $file->move($path, $file_name);

        return $file_name;
    }

    public function moveTransaction(Request $request)
    {
        DB::beginTransaction();
        try {
            $pm = ProjectMaker::findOrFail($request->pm_id);
            $message = "";

            if ($request->type === 'opty') {
                $opty = Opty::findOrFail($request->opty);

                if (!empty($pm->file)) {
                    $source_path = public_path("uploads/projects-maker/{$pm->file}");
                    $destination = public_path("uploads/opty-maker/{$pm->file}");

                    if (File::exists($source_path)) {
                        File::move($source_path, $destination);
                    }
                }

                OptyMaker::create([
                    'opty_id' => $request->opty,
                    'date_trx' => $pm->tanggal,
                    'jenis_trx' => $pm->jenis_transaksi,
                    'nama_penerima' => $pm->nama_tujuan,
                    'nominal_trx' => $pm->nominal,
                    'keterangan' => $pm->keterangan,
                    'file' => $pm->file ?? '',
                    'created_at' => $pm->created_at ?? now(),
                    'updated_at' => $pm->updated_at ?? now()
                ]);

                $pm->delete();
                $message = "Project maker berhasil dipindahkan ke Opty {$opty->project_name}";
            }

            if ($request->type === 'project') {
                $project = DB::table('projects')
                    ->join('opties', 'projects.opty_id', '=', 'opties.id')
                    ->where('projects.id', $request->project)
                    ->select('opties.project_name')
                    ->first();
                $pm->update(['project_id' => $request->project]);
                $message = "Project maker berhasil dipindahkan ke Project {$project->project_name}";
            }

            DB::commit();
            return redirect()->back()->with('message', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
