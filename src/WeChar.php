<?php
namespace Originera\Wechat;
final class WeChar
{
    public string $app_id;
    public string $secret;

    public function __construct(string $app_id,string $secret)
    {
        $this->app_id = $app_id;
        $this->secret = $secret;

    }

    public static WeCharModule $weCharModule;
    public function inject(WeCharModule $weCharModule): WeChar
    {
        self::$weCharModule = $weCharModule;
        self::$weCharModule->appid = $this->app_id;
        self::$weCharModule->secret= $this->secret;
        return $this;
    }

    /**
     * @return mixed
     */
    public function fetch():mixed
    {

        return self::$weCharModule->fetch();
    }


}