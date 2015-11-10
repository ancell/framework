<?php
/**
 * Application.php
 *
 * Created by Chongyi
 * Date & Time 2015/11/10 22:00
 */

namespace Ancell\Framework\Foundation;

use Illuminate\Foundation\Application as IlluminationApplication;

class Application extends IlluminationApplication
{
    /**
     * 创建一个 Ancell 实例
     *
     * @param array|null $basePath
     */
    public function __construct(array $basePath = null)
    {
        parent::__construct($basePath);
    }

    /**
     * 设置基本路径信息
     *
     * @param array $basePath
     *
     * @return $this
     */
    public function setBasePath(array $basePath)
    {
        $this->basePath = rtrim($basePath['base'], '\/');

        // TODO 后期将此处调整更灵活的路径配置
        $this->instance('path', $basePath['base'] . DIRECTORY_SEPARATOR . 'app');

        foreach (['base', 'config', 'database', 'lang', 'public', 'storage'] as $path) {
            $this->instance('path.'.$path, $basePath[$path]);
        }

        return $this;
    }

    /**
     * 获取配置文件目录
     *
     * @return string
     */
    public function configPath()
    {
        return $this['path.config'];
    }

    /**
     * 获取数据库相关文件目录
     *
     * @return string
     */
    public function databasePath()
    {
        return $this['path.database'];
    }

    /**
     * 获取语言文件目录
     *
     * @return string
     */
    public function langPath()
    {
        return $this['path.lang'];
    }

    /**
     * 获取网站公开可访问目录
     *
     * @return string
     */
    public function publicPath()
    {
        return $this['path.public'];
    }

    /**
     * 获取文件存储路径
     *
     * @return string
     */
    public function storagePath()
    {
        return $this['path.storage'];
    }
}