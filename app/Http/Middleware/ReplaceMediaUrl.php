<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ReplaceMediaUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Kiểm tra xem phản hồi có phải là một đối tượng Response hay không
        if ($response instanceof \Illuminate\Http\Response) {
            // Lấy domain của yêu cầu
            $domain = $request->getHttpHost();

            // Lấy nội dung của phản hồi
            $content = $response->getContent();

            // Thay thế các URL trong nội dung với domain mới
            $content = str_replace(
                'https://tubaoquanruouvang.com/media/',
                "http://$domain/images/photos/1/", // Chú ý cách sử dụng domain mới
                $content,
            );

            // Cập nhật nội dung của phản hồi
            $response->setContent($content);
        }

        return $response;
    }
}
