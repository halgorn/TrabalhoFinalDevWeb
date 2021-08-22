<?php

class Redirect
{
    public static function to(string $url): void
    {
        echo "<script>window.location='$url'</script>";
    }
}
