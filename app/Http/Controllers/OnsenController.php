<?php

namespace App\Http\Controllers;

use App\Models\Onsen;
use Illuminate\Http\Request;
use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Illuminate\Support\Facades\Log;

class OnsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('onsen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('onsen.importCsv');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // CSV ファイル保存
        $tmpName = mt_rand().".".$request->file('csv')->guessExtension(); //TMPファイル名
        $request->file('csv')->move(public_path()."/csv/tmp",$tmpName);
        $tmpPath = public_path()."/csv/tmp/".$tmpName;

        //Goodby CSVのconfig設定
        $config = new LexerConfig();
        $interpreter = new Interpreter();
        $lexer = new Lexer($config);

        //CharsetをUTF-8に変換、CSVのヘッダー行を無視
        $config->setToCharset("UTF-8");
        $config->setFromCharset("sjis-win");
        $config->setIgnoreHeaderLine(true);

        $dataList = [];

        // 新規Observerとして、$dataList配列に値を代入
        $interpreter->addObserver(function (array $row) use (&$dataList){
            // 各列のデータを取得
            $dataList[] = $row;
        });

        // CSVデータをパース
        $lexer->parse($tmpPath, $interpreter);

        // TMPファイル削除
        unlink($tmpPath);

        // 登録処理
        foreach($dataList as $row){
            if($row[0] != '普通' && $row[0] != 'その他') {
                continue;
            }
            Onsen::insert(['name' => $row[1], 'address' => $row[2], 'phone_number' => $row[4]]);
        }

        return view('onsen.importCsv');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Onsen  $onsen
     * @return \Illuminate\Http\Response
     */
    public function show(Onsen $onsen)
    {
        return view('onsen.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Onsen  $onsen
     * @return \Illuminate\Http\Response
     */
    public function edit(Onsen $onsen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Onsen  $onsen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Onsen $onsen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Onsen  $onsen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Onsen $onsen)
    {
        Onsen::truncate();
        return view('onsen.importCsv');
    }

    public function search(Request $request)
    {
        $onsens = Onsen::where('name', 'LIKE', '%'.$request->search.'%')->get();
        return view('onsen.show')->with('onsens', $onsens);
    }
}
