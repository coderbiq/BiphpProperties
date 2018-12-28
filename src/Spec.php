<?php

namespace Biphp\Properties;

/**
 * 描述属性规范
 *
 * 提供：
 *  - 是否为只读属性定义
 *  - 默认值定义
 *  - 验证规则定义
 *  - 值过滤规则定义
 *  - 修改监听定义
 */
interface Spec
{
    public function isReadOnly(): bool;
    public function readOnly(): Spec;

    public function defaultValue();
    public function setDefaultValue($v): Spec;

    /**
     * 验证输入值是否为合法属性值
     *
     * example
     *
     * ```php
     * if(($err = $spec->validate($value)) && $err != null) {
     *      echo $err;
     * }
     * ```
     */
    public function validate($value): ?string;

    /**
     * 为属性添加一个验证器
     *
     * example
     *
     * ```php
     * $validator = function($v): ?string {
     *      if($v == 'bad value) {
     *          return 'error msg';
     *      }
     *      return null;
     * }
     * $spec->addValidator($validator);
     * ```
     *
     * @param callable $validator 验证器必须是一个返回 Null 或者错误描述字符串的函数
     */
    public function addValidator(callable $validator): Spec;

    public function filter($value);
    public function addFilter(callable $filter): Spec;

    public function onChange(callable $listener): Spec;
    public function changeListener(): ?callable ;
}
