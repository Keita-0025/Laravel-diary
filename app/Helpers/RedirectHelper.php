<?php
namespace App\Helpers;

use Illuminate\Http\Request;

class RedirectHelper
{
    /**
     * 前のページに戻り、ページネーション情報を保持してリダイレクトする
     */
    public static function backWithPage(Request $request, $route = null, $params = [])
    {
        $previousUrl = url()->previous();
        if ($request->query('page')) {
            $params['page'] = $request->query('page');
        }

        if ($route) {
            return redirect()->route($route, $params)->withInput();
        }

        return redirect()->to($previousUrl . (empty($params) ? '' : '?' . http_build_query($params)));
    }
}