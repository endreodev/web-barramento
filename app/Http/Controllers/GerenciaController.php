<?php

namespace App\Http\Controllers;

use App\Models\Gerencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GerenciaController extends Controller
{
    public function index()
    {
        $gerencias = Gerencia::all();
        return response()->json($gerencias);
    }

    public function show($id)
    {
        $gerencia = Gerencia::findOrFail($id);
        return response()->json($gerencia);
    }

    public function store(Request $request)
    {   
        try { 

            DB::table('gerencia')->insert([
                'payload' => json_encode( $request->all() )
            ]);

            $rest = ['success' => true, 'message' => 'Gerencia gravada com sucesso!'];

        } catch (\Throwable $th) {
            //throw $th;

        $rest = ['error' => false, 'message' => 'Contate o administrador!', /*'detalhe'=>$th->getMessage()*/];
        }

        return response()->json( $rest );
    }

    public function update(Request $request, $id)
    {
        // $gerencia = Gerencia::findOrFail($id);
        // $gerencia->payload = $request->input('payload');
        // $gerencia->leitura = "";
        // $gerencia->save();

        return response()->json(['success' => false, 'message' => 'Metodo update não implementado']);
    }

    public function destroy($id)
    {
        // $gerencia = Gerencia::findOrFail($id);
        // $gerencia->delete();

        return response()->json(['success' => false, 'message' => 'Metodo destroy não implementado']);
    }
}