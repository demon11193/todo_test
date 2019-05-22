<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 17:29
 */

namespace App\Core;


class Route
{

    const CONTROLLER_NAMESPACE = 'App\\Controllers';

    private $pattern, $requestMethods, $controllerMethod;

    function __construct(string $pattern, string $requestMethods, string $controllerMethod) {
        $this->pattern = $pattern;
        $this->requestMethods = $requestMethods;
        $this->controllerMethod = $controllerMethod;
    }

    function run(Request $request) {
        $controller = $this->initController();
        $methodName = $this->getMethodName();
        $params = $this->getParams($request);
        call_user_func_array(
            array($controller, $methodName), $params
        );
    }

    private function getParams(Request $request) {
        preg_match_all('/{[0-9a-z]+}/i', $this->pattern, $matchesKeys);
        $params = [$request];

        $uri = substr(parse_url($request->uri(), PHP_URL_PATH), 1);
        $fullPattern = $this->pattern;
        if (!empty($matchesKeys) && !empty($matchesKeys[0])) {
            foreach ($matchesKeys[0] as $key=>$value) {
                $pos = strpos($fullPattern, '{');
                $uri = substr($uri, $pos);
                $fullPattern = substr($fullPattern, $pos + 5);

                if (strpos($uri, '/') === false) {
                    $paramValue = $uri;
                }
                else {
                    $paramValue = substr($uri, 0, strpos($uri, '/'));
                    $uri =  substr($uri, strpos($uri, '/')+1);
                }
                $paramKey = substr($value, 1, -1);
                $params[$paramKey] = $paramValue;
            }
        }
        return $params;
    }

    function hasAccess(Request $request):bool {
        $className = $this->getControllerClassName();
        return call_user_func(
            array($className, 'hasAccess'),
            $request,
            $this->getMethodName(),
            $this->getParams($request)
        );
    }

    private function getControllerClassName() : string {
        return self::CONTROLLER_NAMESPACE . '\\' . explode('@', $this->controllerMethod)[0];
    }

    private function initController(): Controller {
        $class = $this->getControllerClassName();
        return new $class();
    }

    private function getMethodName() {
        return explode('@', $this->controllerMethod)[1];
    }

    private function getRegPattern():string {
        $regPattern = str_replace('/', '\\/', $this->pattern);
        $regPattern = "/^" . preg_replace('/{[0-9a-z]+}/i', '[0-9a-z_-]+', $regPattern) . "$/i";
        return $regPattern;
    }

    /**
     * Подходит ли роут под запрос
     *
     * @param Request $request
     * @return bool
     */
    function confirm(Request $request):bool {
        if ($this->requestMethods != '*' && strpos($this->requestMethods, $request->method()) === false) {
            return false;
        }
        $regPattern = $this->getRegPattern();
        $uri = substr(parse_url($request->uri(), PHP_URL_PATH), 1);
        return !!preg_match($regPattern, $uri);
    }

}