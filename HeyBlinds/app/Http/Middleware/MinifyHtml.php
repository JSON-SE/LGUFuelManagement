<?php

namespace App\Http\Middleware;

use Closure;

class MinifyHtml
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * @var $response Response
         */
        $response = $next($request);

        $contentType = $response->headers->get('Content-Type');
        if (strpos($contentType, 'text/html') !== false) {
            $response->setContent($this->minify($response->getContent()));
        }
        return $response;
    }
    public function minify($input)
    {
        $search = [
            '/\>\s+/s', // strip whitespaces after tags, except space
            '/\s+</s', // strip whitespaces before tags, except space
        ];

        $replace = [
            '> ',
            ' <',
            "/\n([\S])/" => '$1',
            "/\r/" => '',
            "/\r/" => '',
            "/\n/" => '',
            "/\t/" => '',
            "/ +/" => ' ',

            '/<!--[^]><!\[](.*?)[^\]]-->/s' => '',
            '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\'|\")\/\/.*))/' => '',
            '/https:/' => '',
            '/http:/' => '',
            '/ src="(.\S*?)"/' => ' src=$1',
            '/ width="(.\S*?)"/' => ' width=$1',
            '/ height="(.\S*?)"/' => ' height=$1',
            '/ name="(.\S*?)"/' => ' name=$1',
            '/ charset="(.\S*?)"/' => ' charset=$1',
            '/ align="(.\S*?)"/' => ' align=$1',
            '/ border="(.\S*?)"/' => ' border=$1',
            '/ crossorigin="(.\S*?)"/' => ' crossorigin=$1',
            '/ type="(.\S*?)"/' => ' type=$1',
            '/\/>/' => '>',
            '#<head>(.*?)#' => "<head>\n",

        ];
        return preg_replace($search, $replace, $input);
    }
}
