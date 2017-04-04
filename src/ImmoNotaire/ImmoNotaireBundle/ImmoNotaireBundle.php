<?php

namespace ImmoNotaire\ImmoNotaireBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ImmoNotaireBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
