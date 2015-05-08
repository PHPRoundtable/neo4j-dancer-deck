<?php namespace DancerDeck\Services\View;

class JavascriptManager
{
    // Javascript vars to be included in the header
    public $js_vars = [];

    public function give($key, $value = null)
    {
        if( ! is_array($key))
        {
            $this->give([$key => $value]);
        }
        else
        {
            foreach($key as $k => $v)
            {
                $this->js_vars[] = self::encodeVar($k, $v);
            }
        }

        return $this;
    }

    public function get()
    {
        return empty($this->js_vars) ? null : 'var ' . implode(",\n\t", $this->js_vars) . ';';
    }

    public static function encodeVar($k, $v)
    {
        return $k . '=' . json_encode($v);
    }
}
