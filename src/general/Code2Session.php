<?php
namespace Originera\Wechat\General;
use GuzzleHttp\Client;
use Originera\Wechat\WeCharModule;
use Originera\Wechat\WechatConfig;

class Code2Session extends WeCharModule
{
    public ?string $js_code     = "";
    public ?string $grant_type  = "authorization_code";

    function fetch()
    {
        $client = new Client();
        $response = $client->get('https://api.weixin.qq.com/sns/jscode2session',["query"=>$this->getVers()]);

        var_export($response->getBody()->getContents());
    }

    /**
     * @param string|null $js_code
     */
    public function setJsCode(?string $js_code): void
    {
        $this->js_code = $js_code;
    }

    /**
     * @param string|null $grant_type
     */
    public function setGrantType(?string $grant_type): void
    {
        $this->grant_type = $grant_type;
    }


}