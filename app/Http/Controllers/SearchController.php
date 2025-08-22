<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // タグ (?tag=◯◯) と キーワード (?q=◯◯) の両対応
        $tag = trim((string) $request->query('tag', ''));
        $q   = trim((string) $request->input('q', ''));

        // 優先順位：tag > q
        $keyword  = $tag !== '' ? $tag : $q;
        $searched = $keyword !== '';

        $posts = null;

        if ($searched) {
            // 検索条件をまず組み立てる（OR 条件はクロージャでグループ化）
            $query = Post::query()
                ->where(function ($qq) use ($keyword) {
                    $qq->where('post_tag', 'like', "%{$keyword}%")
                       ->orWhere('post_content', 'like', "%{$keyword}%");
                    // ※ post_title を検索対象にする場合は下を解放（列があること前提）
                    // ->orWhere('post_title', 'like', "%{$keyword}%");
                });

            // ★画像をまとめて読み込む（N+1回避）
            $posts = $query
                ->with(['images' => function ($q) {
                    $q->orderBy('sort_order');
                }])
                ->orderByDesc('post_id')
                ->paginate(10)
                ->withQueryString(); // ページングしても tag/q を保持
        }

        // 画面に出す候補タグ
        $suggestTags = [
            'オーストラリア','日本','留学','観光','アジア','温泉','京都','東京','北海道','沖縄',
            'グルメ','ヨーロッパ','ワーホリ','ダイビング','カフェ','世界遺産','寺','歴史',
            '美術館','夜景','イベント','フェス','韓国','紅葉','花見','スキー','フィリピン','イギリス','マルタ',
        ];

        return view('search', compact('tag','q','posts','searched','keyword','suggestTags'));
    }
}
