<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Japan;

class JapanController extends Controller
{
    public function showKanto()
    {
        // 「関東」の求人情報を取得
        $jobs = Japan::where('district','関東')->get();

        // ビューに渡す
        return view('regions.japan.kanto', [
            'region' => '関東',
            'jobs' => $jobs
        ]);
    }

    public function showKinki()
    {
        // 「近畿」の求人情報を取得
        $jobs = Japan::where('district','近畿')->get();

        // ビューに渡す
        return view('regions.japan.kinki', [
            'region' => '近畿',
            'jobs' => $jobs
        ]);
    }

    public function showTohoku()
    {
        // 「東北」の求人情報を取得
        $jobs = Japan::where('district','東北')->get();

        // ビューに渡す
        return view('regions.japan.tohoku', [
            'region' => '東北',
            'jobs' => $jobs
        ]);
    }

    public function showChugoku()
    {
        // 「中国」の求人情報を取得
        $jobs = Japan::where('district','中国')->get();

        // ビューに渡す
        return view('regions.japan.chugoku', [
            'region' => '中国',
            'jobs' => $jobs
        ]);
    }

     public function showShikoku()
    {
        // 「四国」の求人情報を取得
        $jobs = Japan::where('district','四国')->get();

        // ビューに渡す
        return view('regions.japan.shikoku', [
            'region' => '四国',
            'jobs' => $jobs
        ]);
    }

    public function showKyushu()
    {
        // 「九州」の求人情報を取得
        $jobs = Japan::where('district','九州')->get();

        // ビューに渡す
        return view('regions.japan.kyushu', [
            'region' => '九州',
            'jobs' => $jobs
        ]);
    }

    public function showOkinawa()
    {
        // 「沖縄」の求人情報を取得
        $jobs = Japan::where('district','沖縄')->get();

        // ビューに渡す
        return view('regions.japan.okinawa', [
            'region' => '沖縄',
            'jobs' => $jobs
        ]);
    }

     public function showHokkaido()
    {
        // 「北海道」の求人情報を取得
        $jobs = Japan::where('district','北海道')->get();

        // ビューに渡す
        return view('regions.japan.hokkaido', [
            'region' => '北海道',
            'jobs' => $jobs
        ]);
    }

     public function showHokurikutokai()
    {
        // 「北陸東海」の求人情報を取得
        $jobs = Japan::where('district','北陸東海')->get();

        // ビューに渡す
        return view('regions.japan.hokuriku-tokai', [
            'region' => '北陸東海',
            'jobs' => $jobs
        ]);
    }
}