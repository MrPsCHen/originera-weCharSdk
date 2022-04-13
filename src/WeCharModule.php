<?php

namespace Originera\Wechat;

abstract class WeCharModule
{
    /** @var string|null 小程序 appId */
    public ?string $appid       = null;
    /** @var string|null 小程序 appSecret */
    public ?string $secret      = null;
    /** @var string|null 登录时获取的 code */
    public ?string $js_code     = null;
    /** @var string|null 授权类型，此处只需填写 authorization_code */
    public ?string $grant_type  = null;





    public function inject(WeCharModule $weCharModule): static
    {
        return $this;
    }

    abstract function fetch();


    function getPropertyVers(): array
    {
        $reflect = new \ReflectionClass($this);
        $props   = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE);
        $array = [];
        foreach ($props as $val){
            $val->getValue($this) !== null &&
            $array[$val->getName()] = $val->getValue($this);
        }
        return $array;
    }

    function getVers(): array
    {
        $result = array_merge(get_class_vars(get_class($this)),get_object_vars($this));
        !empty($biz_content =  $this->getPropertyVers()) && $result['biz_content'] =json_encode($biz_content);
        return $result;
    }

    function sign(array &$params): array
    {
        ksort($params);

        $out_params = urldecode(http_build_query($params));
        $params['sign'] = $this->RSA2($out_params);
        return $params;
    }

}