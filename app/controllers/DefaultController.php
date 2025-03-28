<?php

class DefaultController extends Controller
{
  public function notFound404()
  {
    $this->renderView('404');
  }
}
