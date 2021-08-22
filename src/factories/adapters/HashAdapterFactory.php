<?php

class HashAdapterFactory
{
    public static function make(): IHashAdapter
    {
        return new HashAdapter();
    }
}
